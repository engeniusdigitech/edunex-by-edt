<script>
    document.addEventListener('DOMContentLoaded', function () {
        const batchSelect = document.querySelector('select[name="batch_id"]');
        const subjectSelect = document.querySelector('select[name="subject_id"]') ||
            document.querySelector('select[name="subject"]');

        if (!batchSelect || !subjectSelect) return;

        const allSubjectOptions = Array.from(subjectSelect.options).filter(opt => opt.value);
        const placeholder = subjectSelect.options[0] ? subjectSelect.options[0].textContent : '-- Choose a subject --';

        function filterSubjects() {
            const selectedBatchId = batchSelect.value;
            const previousValue = subjectSelect.value;

            // Clear current options
            subjectSelect.innerHTML = `<option value="">${placeholder}</option>`;

            allSubjectOptions.forEach(option => {
                const optionBatchId = option.getAttribute('data-batch');
                if (selectedBatchId && optionBatchId === selectedBatchId) {
                    const clone = option.cloneNode(true);
                    if (clone.value === previousValue) {
                        clone.selected = true;
                    }
                    subjectSelect.appendChild(clone);
                }
            });
        }

        batchSelect.addEventListener('change', filterSubjects);

        // Always filter on load to handle starting state
        filterSubjects();
    });
</script>