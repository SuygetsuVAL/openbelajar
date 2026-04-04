<x-mail::message>
# New Contact Message

You have received a new contact message from **{{ $contactMessage->name }}**.

**Email:** {{ $contactMessage->email }}

**Message:**
<x-mail::panel>
{{ $contactMessage->message }}
</x-mail::panel>

<x-mail::button :url="route('admin.messages.index')">
View in Admin Panel
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
