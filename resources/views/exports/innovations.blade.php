<table>
    <thead>
        <tr>
            <th>Nama Proposal</th>
            <th>SKPD</th>
            <th>Skor</th>
            <th>Tahun</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inovations as $inovation)
            <tr>
                <td>{{ $inovation['proposal'] }}</td>
                <td>{{ $inovation['skpd'] }}</td>
                <td>{{ $inovation['skor'] }}</td>
                <td>{{ $inovation['tahun'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
