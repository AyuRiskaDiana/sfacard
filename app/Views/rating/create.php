<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.star-rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: flex-end;
    gap: 5px;
}
.star-rating input {
    display: none;
}
.star-rating label {
    cursor: pointer;
    font-size: 2rem;
    color: #ddd;
    transition: color 0.2s;
}
.star-rating label:hover,
.star-rating label:hover ~ label,
.star-rating input:checked ~ label {
    color: #ffc107;
}
</style>

<div class="container mt-4">
    <div class="card shadow border-0 rounded-4" style="max-width: 500px; margin: 0 auto;">
        <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg,#6a5af9,#3b82f6);">
            <h5 class="mb-0">
                <i class="bi bi-star-fill"></i> Beri Rating & Komentar
            </h5>
        </div>

       <form action="<?= base_url('progres/store') ?>" method="post" enctype="multipart/form-data">

    <input type="hidden" name="id_pengaduan" value="<?= $id_pengaduan ?>">


    <!-- RATING BINTANG -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Rating:</label>
                    <div class="star-rating">
                        <input type="radio" id="star5" name="rating" value="5"><label for="star5" title="5 bintang"><i class="bi bi-star-fill"></i></label>
                        <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 bintang"><i class="bi bi-star-fill"></i></label>
                        <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 bintang"><i class="bi bi-star-fill"></i></label>
                        <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 bintang"><i class="bi bi-star-fill"></i></label>
                        <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 bintang"><i class="bi bi-star-fill"></i></label>
                    </div>
                </div>

                <!-- KOMENTAR -->
                <div class="mb-3">
                    <label for="komentar" class="form-label fw-semibold">
                        Komentar (Opsional):
                    </label>
                    <textarea name="komentar" id="komentar" class="form-control" 
                              rows="4" placeholder="Tulis pengalaman dan kepuasan Anda..."></textarea>
                </div>

                <!-- BUTTONS -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success flex-grow-1">
                        <i class="bi bi-check-circle"></i> Kirim Rating
                    </button>
                    <a href="<?= base_url('pengaduan/history') ?>" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>