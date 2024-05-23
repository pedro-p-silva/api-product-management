@component("mail::message")

<h1>Olá, {{$user->name}}</h1>

<div class="message_mail">
     <p>Seja bem vindo(a), a plataforma Api Manage Products. Aqui você poderá cadastrar e gerenciar os produtos da sua empresa.</p>
</div>

@component("mail::button", ['url' => 'https://www.google.com'])
        Acessar site!
@endcomponent

@endcomponent
