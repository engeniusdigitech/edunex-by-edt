<x-mail::message>
# Pending Fee Reminder

Dear {{ $student->name }},

This is a gentle reminder from **{{ $student->institute->name ?? 'EduNex' }}** that your fee payment for the current month is pending. 

If you have already made the payment, please ignore this email. Otherwise, please clear your dues at your earliest convenience to maintain uninterrupted access to your classes.

<x-mail::button :url="route('student.login')">
Login to Student Portal
</x-mail::button>

If you have any questions, please contact the administration office.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
