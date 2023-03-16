<h2>NEW EMAIL</h2>
<div>
    Nome:
    <p class="mb-2">{{ $lead->name }}</p>
    Cognome:
    <p class="mb-2">{{ $lead->surname }}</p>
    Email:
    <p class="mb-2">{{ $lead->email }}</p>
    Telefono:
    <p class="mb-2">{{ $lead->phone }}</p>
</div>
<div>
    Contenuto:
    <p>{{ $lead->message }}</p>
</div>
