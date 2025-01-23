@fragment('news-section')
    <section class="page-section bg-contact portfolio" id="news">
        <div class="container">
            <h4 class="page-section-heading text-center text-uppercase text-dark">News From Kemendagri</h4>
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-flag"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-12 col-md-12">
                    <div class="container" hx-history="false">
                        <div class="row g-2">
                            <div class="col-lg-7">
                                <div class="img-container large">
                                    <img src="{{ $newsData[0]['photo_url'] }}" alt="News Image" style="width: 100%; height: 100%;">
                                    <div class="text-container" data-id="{{ $newsData[0]['id'] }}">
                                        <a class="text-white" href="#" data-bs-toggle="modal" data-bs-target="#showNews">
                                            <h4>{{ $newsData[0]['title'] }}</h4>
                                        </a>
                                        <p>{{ date('F d, Y', strtotime($newsData[0]['created_at'])) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="row g-2">
                                    <div class="col-12">
                                        <div class="img-container small">
                                            <img src="{{ $newsData[1]['photo_url'] }}" alt="News Image" style="width: 100%; height: auto;">
                                            <div class="text-container" data-id="{{ $newsData[1]['id'] }}">
                                                <a class="text-white" href="#" data-bs-toggle="modal" data-bs-target="#showNews">
                                                    <h4>{{ $newsData[1]['title'] }}</h4>
                                                </a>
                                                <p>{{ date('F d, Y', strtotime($newsData[1]['created_at'])) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="img-container small">
                                            <img src="{{ $newsData[2]['photo_url'] }}" alt="News Image" style="width: 100%; height: auto;">
                                            <div class="text-container" data-id="{{ $newsData[2]['id'] }}">
                                                <a class="text-white" href="#" data-bs-toggle="modal" data-bs-target="#showNews">
                                                    <h4>{{ $newsData[2]['title'] }}</h4>
                                                </a>
                                                <p>{{ date('F d, Y', strtotime($newsData[2]['created_at'])) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div id="loadingPub"
                        class="htmx-indicator text-primary d-flex align-items-center justify-content-center mt-3">
                        <i class="fas fa-spinner fa-spin fa-2x"></i>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
    <style>
        #loadingPub {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .img-container {
            position: relative;
            background-color: #f8f9fa;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            color: white;
        }

        .large {
            height: 100%;
        }

        .small {
            height: 100%;
        }

        .text-container {
            background: rgba(0, 0, 0, 0.5);
            padding: 10px;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
@endfragment
