<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <div class="card shadow border-0 rounded-4">

        <!-- HEADER -->
        <div class="card-header text-white rounded-top-4"
             style="background: linear-gradient(135deg,#6a5af9,#3b82f6);">
            <h5 class="mb-0">
                <i class="bi bi-chat-dots-fill"></i> Feedback Pengaduan
            </h5>
        </div>

        <div class="card-body">

            <!-- JUDUL -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Judul Pengaduan</label>
                <div class="form-control bg-light border-0 shadow-sm">
                    <?= $pengaduan['judul'] ?>
                </div>
            </div>

            <!-- FORM -->
            <form action="<?= base_url('pengaduan/feedback/save') ?>" method="post">

                <input type="hidden" name="id_pengaduan" value="<?= $pengaduan['id_pengaduan'] ?>">

                <!-- TEXTAREA -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Isi Feedback</label>
                    <textarea name="isi_feedback" 
                              class="form-control shadow-sm" 
                              rows="4"
                              placeholder="Masukkan feedback..."></textarea>
                </div>

                <!-- BUTTON -->
                <div class="d-flex justify-content-between">

                    <a href="<?= base_url('pengaduan') ?>" 
                       class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <button type="submit" 
                            class="btn text-white"
                            style="background: linear-gradient(135deg,#6a5af9,#3b82f6);">
                        <i class="bi bi-send-fill"></i> Kirim Feedback
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

<?= $this->endSection() ?>