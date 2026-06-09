<?php

namespace App\Http\Controllers;

use App\Models\QuestionBank;
use App\Models\Subject;
use App\Models\Batch;
use Illuminate\Http\Request;

class QuestionBankController extends Controller
{
    public function index(Request $request)
    {
        $query = QuestionBank::with(['subject', 'batch']);

        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }
        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }
        if ($request->filled('search')) {
            $query->where('question', 'like', '%' . $request->search . '%');
        }

        $questions = $query->latest()->paginate(20);
        $subjects  = Subject::where('is_active', true)->get();
        $batches   = Batch::where('is_active', true)->get();

        return view('question-bank.index', compact('questions', 'subjects', 'batches'));
    }

    public function create()
    {
        $subjects = Subject::where('is_active', true)->get();
        $batches  = Batch::where('is_active', true)->get();
        return view('question-bank.create', compact('subjects', 'batches'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_id'     => 'required|exists:subjects,id',
            'batch_id'       => 'nullable|exists:batches,id',
            'question'       => 'required|string',
            'type'           => 'nullable|in:mcq,true_false',
            'option_a'       => 'required|string|max:500',
            'option_b'       => 'required|string|max:500',
            'option_c'       => 'nullable|string|max:500',
            'option_d'       => 'nullable|string|max:500',
            'correct_option' => 'required|in:a,b,c,d',
            'marks'          => 'required|integer|min:1|max:100',
            'difficulty'     => 'required|in:easy,medium,hard',
            'explanation'    => 'nullable|string',
        ]);

        $validated['type'] = $validated['type'] ?? 'mcq';

        QuestionBank::create($validated);

        if ($request->has('add_another')) {
            return redirect()->route('question-bank.create')
                ->with('success', 'Question added! Add another.');
        }

        return redirect()->route('question-bank.index')
            ->with('success', 'Question added to bank successfully.');
    }

    public function edit(QuestionBank $questionBank)
    {
        $subjects = Subject::where('is_active', true)->get();
        $batches  = Batch::where('is_active', true)->get();
        return view('question-bank.edit', compact('questionBank', 'subjects', 'batches'));
    }

    public function update(Request $request, QuestionBank $questionBank)
    {
        $validated = $request->validate([
            'subject_id'     => 'required|exists:subjects,id',
            'batch_id'       => 'nullable|exists:batches,id',
            'question'       => 'required|string',
            'type'           => 'nullable|in:mcq,true_false',
            'option_a'       => 'required|string|max:500',
            'option_b'       => 'required|string|max:500',
            'option_c'       => 'nullable|string|max:500',
            'option_d'       => 'nullable|string|max:500',
            'correct_option' => 'required|in:a,b,c,d',
            'marks'          => 'required|integer|min:1|max:100',
            'difficulty'     => 'required|in:easy,medium,hard',
            'explanation'    => 'nullable|string',
        ]);

        $validated['type'] = $validated['type'] ?? 'mcq';

        $questionBank->update($validated);

        return redirect()->route('question-bank.index')
            ->with('success', 'Question updated successfully.');
    }

    public function destroy(QuestionBank $questionBank)
    {
        $questionBank->delete();
        return redirect()->route('question-bank.index')
            ->with('success', 'Question deleted from bank.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'batch_id'   => 'nullable|exists:batches,id',
            'file'       => 'required|file|mimes:csv,txt|max:5120',
        ]);

        $subjectId = $request->subject_id;
        $batchId   = $request->batch_id;
        $file      = $request->file('file');
        
        $path = $file->getRealPath();
        
        if (($handle = fopen($path, 'r')) !== FALSE) {
            $header = fgetcsv($handle);
            if (!$header) {
                fclose($handle);
                return back()->withErrors(['file' => 'The uploaded file is empty or invalid.']);
            }
            
            $header = array_map(function($h) {
                $h = trim(strtolower($h));
                return preg_replace('/[\x{FEFF}\x{FFFE}]/u', '', $h);
            }, $header);
            
            $requiredColumns = ['question', 'option_a', 'option_b', 'correct_option'];
            foreach ($requiredColumns as $col) {
                if (!in_array($col, $header)) {
                    fclose($handle);
                    return back()->withErrors(['file' => "Required column '{$col}' is missing in the CSV header."]);
                }
            }

            $importedCount = 0;
            $errors = [];
            $rowNum = 1;

            \DB::beginTransaction();
            try {
                while (($row = fgetcsv($handle)) !== FALSE) {
                    $rowNum++;
                    
                    if (count($row) < count($header)) {
                        $row = array_pad($row, count($header), '');
                    }
                    
                    $rowCombined = array_combine($header, array_map('trim', array_slice($row, 0, count($header))));
                    
                    if (empty($rowCombined['question'])) {
                        continue;
                    }

                    $correct = strtolower($rowCombined['correct_option'] ?? '');
                    if (!in_array($correct, ['a', 'b', 'c', 'd'])) {
                        $errors[] = "Row {$rowNum}: Correct answer must be A, B, C, or D (got '{$correct}').";
                        continue;
                    }

                    $difficulty = strtolower($rowCombined['difficulty'] ?? 'medium');
                    if (!in_array($difficulty, ['easy', 'medium', 'hard'])) {
                        $difficulty = 'medium';
                    }

                    $marks = intval($rowCombined['marks'] ?? 1);
                    if ($marks < 1) {
                        $marks = 1;
                    }

                    QuestionBank::create([
                        'institute_id'   => auth()->user()->institute_id,
                        'subject_id'     => $subjectId,
                        'batch_id'       => $batchId,
                        'question'       => $rowCombined['question'],
                        'type'           => 'mcq',
                        'option_a'       => $rowCombined['option_a'],
                        'option_b'       => $rowCombined['option_b'],
                        'option_c'       => !empty($rowCombined['option_c']) ? $rowCombined['option_c'] : null,
                        'option_d'       => !empty($rowCombined['option_d']) ? $rowCombined['option_d'] : null,
                        'correct_option' => $correct,
                        'marks'          => $marks,
                        'difficulty'     => $difficulty,
                        'explanation'    => !empty($rowCombined['explanation']) ? $rowCombined['explanation'] : null,
                    ]);

                    $importedCount++;
                }
                
                fclose($handle);

                if (!empty($errors)) {
                    \DB::rollBack();
                    return back()->withErrors(['file' => 'Import failed: ' . implode(' | ', array_slice($errors, 0, 5))]);
                }

                \DB::commit();
                return redirect()->route('question-bank.index')
                    ->with('success', "Successfully imported {$importedCount} questions.");

            } catch (\Exception $e) {
                fclose($handle);
                \DB::rollBack();
                return back()->withErrors(['file' => 'Error importing CSV: ' . $e->getMessage()]);
            }
        }
        
        return back()->withErrors(['file' => 'Unable to open the uploaded file.']);
    }

    public function downloadTemplate()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="question_bank_template.csv"',
        ];

        $columns = ['question', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_option', 'marks', 'difficulty', 'explanation'];
        
        $callback = function() use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            fputcsv($file, [
                'What is the capital of France?',
                'Berlin',
                'Paris',
                'Rome',
                'Madrid',
                'b',
                '1',
                'easy',
                'Paris is the capital of France.'
            ]);
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
