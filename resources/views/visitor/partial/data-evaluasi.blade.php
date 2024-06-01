<section class="page-section bg-inovation portfolio" id="evaluasi-list">
    <div class="container">
        <h4 class="page-section-heading text-center text-uppercase text-white">Berita Riset dan Inovasi</h4>
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-atom fa-spin"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-9 p-1">
                <div class="table-responsive bg-white p-3 rounded shadow" hx-history="false">
                    <table class="table table-borderless table-hover table-striped" id="tabel-evaluasi" width="100%" cellspacing="0">
                        <tbody>
                            <!-- Server-side dataTable gan -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-3 p-1">
                <div class="p-3 bg-white rounded shadow">
                    <div class="mb-3">
                        <input type="text" id="searchInput" class="form-control" placeholder="Keywords">
                    </div>
                    <div class="mb-3">
                        <label for="yearFilter" class="form-label">Tahun:</label>
                        <select id="yearFilter" class="form-select">
                            <option value="">-- Semua Tahun --</option>
                            <!-- Dynamically populated options will go here -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="skpdFilter" class="form-label">SKPD:</label>
                        <select id="skpdFilter" class="form-select" data-searchable="true">
                            <option value="">-- Semua SKPD --</option>
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
            url: "{{url('api/riset')}}",
            dataSrc: 'data',
            processing: true,
            serverSide: true,
        },
        columns: [
            {
                render: function (data, type, row) {
                    return '<img class="overflow-hidden" width="170" src="https://inovasi-tanbu.test/storage/system/T7oio7RZj3LtEPDzj2ECrAnLnNPg835S6LXgb8iV.png" alt="logo serasi" class="d-none d-md-inline-block">';
                } 
            },
            {
                data: 'judul',
                render: function (data, type, row) {
                    var truncatedLatar = row.latar.length > 199 ? row.latar.substring(0, 199) + '...' : row.latar;
                    return '<a class="text-primary" href="' + row.url + '">' + data + '</a>' + '<p>' + truncatedLatar + '</p>' + '<small>' + row.created_at + '</small>';
                }
            },
        ],
        pageLength: 5,
        ordering: false,
        initComplete: function (settings, json) {
            htmx.process('#tabel-evaluasi');
            populateFilters(json.data);
        },
        error: function(xhr, error, thrown) {
            console.error('DataTables error:', error, thrown);
            alert('Error loading data. Please try again later.');
        },
    });

    $('.dt-search').addClass('d-none');
    $('.dt-length').addClass('d-none');

    document.body.addEventListener("reloadTable", function(evt) {
        dataTable.ajax.reload(function() {
            htmx.process('#tabel-evaluasi');
        }, false);
    });

    function populateFilters(data) {
        var years = new Set();
        var skpds = new Set();

        data.forEach(function (item) {
            years.add(item.tahun);
            skpds.add(item.skpd.nama);  // Correctly access 'skpd.nama'
        });

        years.forEach(function (year) {
            $('#yearFilter').append(new Option(year, year));
        });

        skpds.forEach(function (skpd) {
            $('#skpdFilter').append(new Option(skpd, skpd));
        });

        const skpdFilter = new UseBootstrapSelect(document.getElementById('skpdFilter'));
        const yearFilter = new UseBootstrapSelect(document.getElementById('yearFilter'));
    }

    // Event listeners for filters
    $('#yearFilter').on('change', function () {
        dataTable.column(2).search(this.value).draw();
    });

    $('#skpdFilter').on('change', function () {
        dataTable.column(1).search(this.value).draw();
    });

    $('#searchInput').on('keyup', function () {
        dataTable.search(this.value).draw();
    });
</script>