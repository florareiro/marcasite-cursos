<div>
<h2 style="text-align: center">Usuários</h2>

    <table class="w-full whitespace-no-wrap" wire:poll.visible>
        <thead>
            <tr style="background-color: #adb5bd;">
                <th style="border: 1px solid #ccc;">ID</th>
                <th style="border: 1px solid #ccc;">Nome</th>
                <th style="border: 1px solid #ccc;">Curso</th>
                <th style="border: 1px solid #ccc;">Data de Inscrição</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr class="text-gray-700 dark:text-gray-400">
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $user->id }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $user->name }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $user->product_id }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">   {{date('d-m-Y', strtotime($user->created_at))}}</td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>