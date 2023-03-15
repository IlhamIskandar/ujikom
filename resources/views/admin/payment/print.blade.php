<!DOCTYPE html>
<html>
<head>
	<title>Print Laporan</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
        <img src="{{asset('storage/img/smknekat-logo.png')}}" width="100px">
		<h5>Laporan Pembayaran SPP</h5>
		<h5>SMKN 1 Katapang</h5>
	</center>
    <hr>
    <p><bold>Tanggal : </bold> {{date_format(date_create($from),'d M Y')}} - {{date_format(date_create($to),'d M Y')}}</p>
    <p>Jumlah Data Pembayaran : {{$data->count()}}</p>
	<table class='table table-bordered'>
		<thead>
            <tr>
                <th>No</th>
                <th>Petugas</th>
                <th>NISN</th>
                <th>Tanggal Bayar</th>	
                <th>SPP</th>	
                <th>Jumlah Bayar</th>	
                <th>Kode</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $row)
            <tr>
                <td style="max-width: 4px;">{{$loop->iteration}}</td>
                <td>{{$row->name}}</td>
                <td>{{$row->payer}}</td>
                <td>{{date_format(date_create($row->payment_date),'d M Y h:i:s')}}</td>
                <td>{{$row->year}}</td>
                <td>Rp. {{$row->pay_amount}}</td>
                <td>{{ $row->code }}</td>
            </tr>
            @empty
            Tidak ada data.
            @endforelse
        </tbody>
	</table>
    <script type="text/javascript">
    window.print()
    </script>
</body>
</html>