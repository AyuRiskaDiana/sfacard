<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<style>
.timeline {
    display: flex;
    justify-content: space-between;
    margin: 20px 0;
}

.timeline-step {
    text-align: center;
    flex: 1;
    position: relative;
}

.timeline-step::before {
    content: '';
    position: absolute;
    top: 15px;
    left: -50%;
    width: 100%;
    height: 3px;
    background: #ddd;
    z-index: 0;
}

.timeline-step:first-child::before {
    display: none;
}

.timeline-icon {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #ddd;
    margin: auto;
    z-index: 1;
    position: relative;
}

.timeline-step.active .timeline-icon {
    background: #28a745;
}

.timeline-step.active::before {
    background: #28a745;
}

.timeline-label {
    margin-top: 5px;
    font-size: 12px;
}
</style>

<?php
$status = $pengaduan['status'];

// tentukan step aktif
$step1 = true; // dikirim selalu aktif
$step2 = in_array($status, ['diproses', 'selesai']);
$step3 = $status == 'selesai';
$step4 = $status == 'selesai';
?>

<div class="timeline">

    <div class="timeline-step <?= $step1 ? 'active' : '' ?>">
        <div class="timeline-icon"></div>
        <div class="timeline-label">Dikirim</div>
    </div>

    <div class="timeline-step <?= $step2 ? 'active' : '' ?>">
        <div class="timeline-icon"></div>
        <div class="timeline-label">Diproses</div>
    </div>

    <div class="timeline-step <?= $step3 ? 'active' : '' ?>">
        <div class="timeline-icon"></div>
        <div class="timeline-label">Feedback</div>
    </div>

    <div class="timeline-step <?= $step4 ? 'active' : '' ?>">
        <div class="timeline-icon"></div>
        <div class="timeline-label">Selesai</div>
    </div>

</div>
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

            <!-- STATUS PENGADUAN -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Status</label>
                <div class="form-control bg-light border-0 shadow-sm">
                    <?php if (isset($feedback) && !empty($feedback)): ?>
                        <span class="badge bg-success">
                            <i class="bi bi-check-circle"></i> Feedback sudah diberikan
                        </span>
                    <?php else: ?>
                        <span class="badge bg-warning text-dark">
                            <i class="bi bi-clock"></i> Feedback belum diberikan
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (isset($feedback) && !empty($feedback)): ?>
                <!-- TAMPILKAN FEEDBACK (READ-ONLY) -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Feedback yang sudah diberikan</label>
                    <div class="form-control bg-light border-0 shadow-sm" style="min-height: 100px;">
                        <?= nl2br(htmlspecialchars($feedback['isi_feedback'])) ?>
                    </div>
                    <small class="text-muted mt-1 d-block">
                        <i class="bi bi-calendar"></i> Diberikan pada: <?= date('d-m-Y H:i', strtotime($feedback['tanggal'] ?? $pengaduan['updated_at'])) ?>
                    </small>
                </div>

                <!-- BUTTON KEMBALI SAJA -->
                <div class="d-flex justify-content-start">
                    <a href="<?= base_url('pengaduan') ?>"
                        class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

            <?php else: ?>
                <!-- FORM FEEDBACK -->
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
            <?php endif; ?>

        </div>
    </div>

</div>

<?= $this->endSection() ?>