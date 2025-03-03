<table>
    <thead>
        <tr>
            <th>Nama Proposal</th>
            <th>SKPD</th>
            <th>Skor</th>
            <th>Tahun</th>
            <th>Bukti</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($results as $inovation)
            <tr>
                <td>{{ $inovation['proposal'] }}</td>
                <td>{{ $inovation['skpd'] }}</td>
                <td>{{ $inovation['skor'] }}</td>
                <td>{{ $inovation['tahun'] }}</td>
                <td>{!! $inovation['bukti'] !!}</td>
            </tr>
        @endforeach
    </tbody>
</table>
