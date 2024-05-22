<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<div class="container">
		<center>
			<h4>Membuat Laporan PDF Dengan DOMPDF Laravel</h4>
		</center>
		<table class='table table-bordered'>
			<thead>
				<tr>
					<th>No</th>
					<th>Kode Akun</th>
					<th>Nama Akun</th>
					<th>Header Akun</th>
					<th>Id Perusahaan</th>
				</tr>
			</thead>
			<tbody>
				@php $i=1 @endphp
				@foreach($coa as $p)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{$p->kode_akun }}</td>
					<td>{{$p->nama_akun }}</td>
					<td>{{$p->header_akun}}</td>
					<td>{{$p->id_perusahaan}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
 
	</div>
 
</body>
</html>