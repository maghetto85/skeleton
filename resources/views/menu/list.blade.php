<div class="table-responsive" id="menus-list">
    <table class="table table-bordered table-striped table-condensed">
        <thead>
        <tr>
            <th style="width: 24px;"></th>
            <th style="width: 24px;"></th>
            <th style="width: 24px;"></th>
            <th style="width: 24px;"></th>
            <th>Lingua</th>
            <th>Titolo</th>
            <th>Destinazione</th>
        </tr>
        </thead>
        <tbody>
        @forelse($menus as $menu)
            <tr data-id="{{ $menu->id }}" data-position="{{ $menu->position }}">
                <td class="text-center success">
                    <a class="btn btn-xs btn-success" href="{{ route('menu.edit', $menu->id) }}"><i class="fa fa-fw fa-pencil"></i></a>
                </td>
                <td class="text-center warning">
                    <button class="btn btn-default btnMoveUp btn-xs"{{ $loop->first ? ' disabled' : '' }}><i class="fa fa-chevron-up"></i></button>
                </td>
                <td class="text-center warning">
                    <button class="btn btn-default btnMoveDown btn-xs"{{ $loop->last ? ' disabled' : '' }}><i class="fa fa-chevron-down"></i></button>
                </td>
                <td class="text-center danger">
                    <a class="btn btn-xs btn-danger" href="#elimina" data-toggle="modal" data-id="{{ $menu->id }}" data-name="{{ $menu->titolo }}"><i class="fa fa-fw fa-remove"></i></a>
                </td>
                <td><img src="{{ $menu->locale->flag }}" style="height: 16px;" alt="{{ $menu->locale->name }}"></td>
                <td>{{ $menu->titolo }}</td>
                <td>{{ $menu->url }}</td>
            </tr>
        @empty
            <tr>
                <td class="text-center" colspan="10">Nessun Elemento trovato</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>