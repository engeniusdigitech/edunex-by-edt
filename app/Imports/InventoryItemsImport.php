<?php

namespace App\Imports;

use App\Models\InventoryCategory;
use App\Models\InventoryItem;
use App\Models\InventoryStockLog;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithAfterImport;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class InventoryItemsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError, WithChunkReading
{
    use SkipsErrors;

    protected int $instituteId;
    protected int $userId;

    public function __construct(int $instituteId, int $userId)
    {
        $this->instituteId = $instituteId;
        $this->userId      = $userId;
    }

    public function model(array $row): ?InventoryItem
    {
        // Resolve category by name or ID
        $categoryId = null;
        if (!empty($row['category'])) {
            if (is_numeric($row['category'])) {
                $categoryId = (int) $row['category'];
            } else {
                $category = InventoryCategory::firstOrCreate(
                    ['name' => $row['category']],
                    ['institute_id' => $this->instituteId]
                );
                $categoryId = $category->id;
            }
        }

        $qty = (int) ($row['quantity'] ?? 0);

        $item = InventoryItem::create([
            'inventory_category_id' => $categoryId,
            'name'                  => $row['name'],
            'sku'                   => $row['sku'] ?? null,
            'unit'                  => $row['unit'] ?? 'pcs',
            'available_qty'         => $qty,
            'min_qty_warning'       => (int) ($row['min_qty_warning'] ?? 5),
            'unit_price'            => (float) ($row['unit_price'] ?? 0),
        ]);

        // Log initial stock
        if ($qty > 0) {
            InventoryStockLog::create([
                'inventory_item_id' => $item->id,
                'type'              => 'stock_in',
                'quantity'          => $qty,
                'reference'         => 'Imported via bulk upload',
                'logged_by'         => $this->userId,
            ]);
        }

        return null; // already created above, return null to skip double-insert
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'unit' => 'nullable|string|max:50',
        ];
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
