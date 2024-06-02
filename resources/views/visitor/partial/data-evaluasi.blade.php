<section class="page-section bg-inovation portfolio" id="evaluasi-list">
    <div class="container">
        <h4 class="page-section-heading text-center text-uppercase text-white">Berita Riset dan Inovasi</h4>
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-atom fa-spin"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-9 col-md-12 p-1">
                <div class="table-responsive bg-white p-3 rounded shadow" hx-history="false">
                    <table class="table table-borderless table-hover table-striped" id="tabel-evaluasi" width="100%"
                        cellspacing="0">
                        <tbody>
                            <!-- Server-side dataTable gan -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 p-1">
                <div class="p-3 bg-white rounded shadow">
                    <div class="mb-3">
                        <input type="text" id="searchInput" class="form-control" placeholder="Keywords">
                    </div>
                    <div class="mb-3">
                        <label for="yearFilter" class="form-label">Tahun:</label>
                        <select id="yearFilter" class="form-select" data-searchable="true">
                            <option value="">-- Semua Tahun --</option>
                            <!-- Dynamically populated options will go here -->
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    var dataTable = $('#tabel-evaluasi').DataTable({
        ajax: {
            url: "{{url('api/evaluasi')}}",
            dataSrc: 'data',
            processing: true,
            serverSide: true,
        },
        columns: [
            {
                data: 'combined_column',
                orderable: false,
                render: function (data, type, row) {
                    var truncatedDesc = row.deskripsi.length > 199 ? row.deskripsi.substring(0, 199) + '...' : row.deskripsi;
                    var imageUrl = row.foto ? "{{ asset('storage/') }}/" + row.foto : "{{ asset('img/image.svg') }}"; // Ganti 'default-image.jpg' dengan path gambar default kamu
                    return '<div class="row">' +
                        '<div class="col-auto">' +
                        '<img class="overflow-hidden" width="170" src="' + imageUrl + '" alt="foto evaluasi">' +
                        '</div>' +
                        '<div class="col">' +
                        '<h5><a class="text-primary" href="{{ url('evaluasi') }}/'+ row.slug +'">' + row.judul + '</a></h5>' +
                        '<p>' + truncatedDesc + '</p>' +
                        '<small>' + row.created_at + '</small>' +
                        '</div>' +
                        '</div>';
                }
            },
            {
                data: 'id',
                visible:false
            }
        ],
        pageLength: 5,
        order: [[1, 'desc']],
        initComplete: function (settings, json) {
            htmx.process('#tabel-evaluasi');
            populateFilters(json.data);
        },
        error: function (xhr, error, thrown) {
            console.error('DataTables error:', error, thrown);
            alert('Error loading data. Please try again later.');
        },
    });

    $('.dt-search').addClass('d-none');
    $('.dt-length').addClass('d-none');

    document.body.addEventListener("reloadTable", function (evt) {
        dataTable.ajax.reload(function () {
            htmx.process('#tabel-evaluasi');
        }, false);
    });

    function populateFilters(data) {
        var years = new Set();

        data.forEach(function (item) {
            var year = new Date(item.created_at).getFullYear();
            years.add(year);
        });

        years.forEach(function (year) {
            $('#yearFilter').append(new Option(year, year));
        });

        const yearFilter = new UseBootstrapSelect(document.getElementById('yearFilter'));
    }

    // Event listeners for filters
    $('#yearFilter').on('change', function () {
        dataTable.column(0).search(this.value).draw(); // Adjust column index if necessary
    });

    $('#searchInput').on('keyup', function () {
        dataTable.search(this.value).draw();
    });
</script>