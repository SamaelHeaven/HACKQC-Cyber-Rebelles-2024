<?php

/*
 * bool $insideMain: If the footer is inside the main element
 */

require_once dirname($_SERVER["DOCUMENT_ROOT"]) . "/src/php/models/CurrentPage.php";

$insideMain ??= true;

?>
<?= !$insideMain ? "</main>" : "" ?>
<footer class="bg-body-tertiary shadow-lg">
    <div class="container py-3">
        <div class="d-flex footer-content">
            <div class="d-flex flex-column align-items-center">
                <div class="pt-2 footer-logos d-flex">
                    <a href="/views/home/index.php"><img src="/images/fit-quest-logo.png" alt="FitQuest"
                                                                class="footer-logo"></a>
                    <a href="https://devpost.com/software/hackqc-2024" target="_blank"><img
                                src="/images/cyber-rebelles-logo.png" alt="Cyber-Rebelles"
                                class="footer-logo"></a>
                </div>
                <div class="pt-3 copyright-text">© Cyber-Rebelles 2024</div>
            </div>

            <div class="pt-4 mx-auto d-flex flex-wrap info-footer">
                <div>
                    <h2 class="mb-4 fs-6 footer-text fw-light">NOUS JOINDRE</h2>
                    <p><em class="fa-solid fa-envelope me-2"></em>cyberrebellesinfo@gmail.com</p>
                </div>
                <div class="social-networks">
                    <h2 class="mb-3 fs-6 footer-text fw-light">NOUS SUIVRE</h2>
                    <a href="https://github.com/SamaelHeaven/HackQC-Cyber-Rebelles-2024" target="_blank"><em
                                class="fa-brands fa-github"></em></a>
                    <a href="https://devpost.com/software/hackqc-2024" target="_blank"><img
                                src="/images/devposticon.ico" alt="devpost-icon" class="devpost-icon"></a>
                </div>
            </div>
        </div>
    </div>
</footer>
<?= $insideMain ? "</main>" : "" ?>
</body>