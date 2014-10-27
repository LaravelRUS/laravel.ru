@extends("_layout.admin.leftsidebar")

@section("title")
    Админка
@stop

@section("content")

<h1>Список пользователей</h1>
<table class="table table-bordered">
    <tr>
        <th rowspan="2"></th>
        <th rowspan="2">Никнейм</th>
        <th rowspan="2">Email</th>
        <th colspan="<?= count($roles) ?>">Права</th>
    </tr>
    <tr>
        <?foreach($roles as $role){?>
            <th><?= $role->name ?></th>
        <?}?>
    </tr>
    <?foreach($users as $user){?>
        <tr>
            <td><?= $user->id ?></td>
            <td><?= $user->name ?></td>
            <td><?= $user->email ?></td>
            <?foreach($roles as $role){?>
                <td>
                    <?if($user->hasRole($role->name)){?>
                        <?= Form::open(['url'=>route("admin.remove_role")]) ?>
                        <input type="hidden" name="user_id" value="<?= $user->id ?>">
                        <input type="hidden" name="role_id" value="<?= $role->id ?>">
                        <button class="btn btn-success btn-xs" type="submit"> </button>
                        <?= Form::close() ?>
                    <?}else{?>
                        <?= Form::open(['url'=>route("admin.add_role")]) ?>
                        <input type="hidden" name="user_id" value="<?= $user->id ?>">
                        <input type="hidden" name="role_id" value="<?= $role->id ?>">
                        <button class="btn btn-default btn-xs" type="submit"> </button>
                        <?= Form::close() ?>
                    <?}?>
                </td>
            <?}?>
        </tr>

    <?}?>
</table>

@stop