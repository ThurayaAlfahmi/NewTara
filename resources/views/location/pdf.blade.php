<table class="text-center" cellspacing="0" cellpadding="5" border="1">
    <thead>
        <tr>
            <th class="tbg text-center" width="16.7%"><b>الرقم</b></th>
            <th class="tbg text-center" width="16.7%"><b>المدينة</b></th>
            <th class="tbg text-center" width="16.7%"><b>اسم الفرع</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($listings as $location)
        <tr>
            <td class="text-center">{{ $location->id }}</td>
            <td class="text-center">{{ $location->city }}</td>
            <td class="text-center">{{ $location->branch_name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>