<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src=<?php echo base_url("assets/js/html2pdf.bundle.js"); ?>></script>
    
</head>
<body>

<button type="button" id="exportButton" class="btn btn-primary">Export PDF</button>

<div id="proforma">
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Societe</th>
                <th>Adresse</th>
                <th>Telephone</th>
                <th>mail</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $nom_societe; ?></td>
                <td><?php echo $adresse_societe; ?></td>
                <td><?php echo $telephone; ?></td>
                <td><?php echo $mail; ?></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Reference Proforma</th>
                            <th>Date proforma</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $ref_proforma; ?></td>
                            <td><?php echo $date_proforma; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
                
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Adresse</th>
                            <th>Telephone</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $nom_societe_demandeur; ?></td>
                            <td><?php echo $adresse_sd; ?></td>
                            <td><?php echo $telephone_sd; ?></td>
                            <td><?php echo $email_sd; ?></td>
                        </tr>                   
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Quantite</th>
                            <th>Prix Unitaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $description; ?></td>
                            <td><?php echo $quantite; ?></td>
                            <td><?php echo $prix_unitaire; ?></td>
                        </tr>                   
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    // Add click event listener to the export button
    document.addEventListener('DOMContentLoaded', function() {
        var exportPdf = html2pdf();
        var exportButton = document.getElementById('exportButton');
        var chartCanvas = document.getElementById('proforma');

        var exportToPdf = function() {
            exportPdf.set({
                margin: [10, 10, 10, 10],
                filename: 'proforma.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'paysage'}
            });

            exportPdf.from(chartCanvas).save();
        };

        exportButton.addEventListener('click', exportToPdf);
    });
</script>