<table class="text-center" cellspacing="0" cellpadding="5" border="1">
    <thead>
        <tr>
            <th class="tbg text-center" width="11.1%">الرقم</th>
            <th class="tbg text-center" width="11.1%">الاسم</th>
            <th class="tbg text-center" width="11.1%">البراند</th>
            <th class="tbg text-center" width="11.1%">الموديل</th>
            <th class="tbg text-center" width="11.1%">السنة</th>
            <th class="tbg text-center" width="11.1%">السعر اليومي</th>
            <th class="tbg text-center" width="11.1%">التوفر</th>
            <th class="tbg text-center" width="11.1%">الموقع</th>
            <th class="tbg text-center" width="11.1%">نوع السيارة</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($listings as $car)
        <tr>
            <td class="text-center">{{ $car->id }}</td>
            <td class="text-center">{{ $car->name }}</td>
            <td class="text-center">{{ $car->brand }}</td>
            <td class="text-center">{{ $car->model }}</td>
            <td class="text-center">{{ $car->year }}</td>
            <td class="text-center">{{ $car->daily_rate }}</td>
            <td class="text-center">{{ $car->availability ? 'متاح' : 'غير متاح' }}</td>
            <td class="text-center">{{ $car->location->city }} - {{ $car->location->branch_name }}</td>
            <td class="text-center">
               
                    <?php echo get_carType($car->car_type); ?> </td>
        </tr>
        @endforeach
    </tbody>
</table>
