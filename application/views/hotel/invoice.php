<style>
    .title {
        text-transform: capitalize;
    }
    .uppercase{
        text-transform: uppercase;
    }

    .nowrap {
        white-space: nowrap;
    }

    .m-b-5 {
        font-weight: bold;
        margin-bottom: 50px;
    }

    table,
    th,
    td {
        border: 1px solid #000;
        border-collapse: collapse;
    }

    th,
    td {
        width: max-content;
        height: 120px;
        width: 200px;
        text-align: center;
    }
</style>

<body>
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">

            <h3 class="title"><strong>Invoice</strong></h3>
            <p>Date : <?=date("d/m/Y")?></p>
            <p style="text-align:center"><img src="assets/images/logos/logo-l.png" alt="" width="50px"></p>
            <p class="title" style="text-align:center"><strong>JaduRide Hotel</strong></p>
            <h3 class="title" style="text-align:center"><strong><?= $hotel ?></strong></h3>

            <div class="card p-2">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table" width="100%">
                        <tbody class="text-center" id="table_details">
                            <?php
                            if (!empty($data)) {

                                if (empty($data['extra_data']->hotel->email)) $data['extra_data']->hotel->email = '-';
                                if (empty($data['driver'])) $data['driver'] = '-';
                            ?>
                                <tr>
                                    <td class="text-center title">
                                        <div>
                                            <div class="m-b-5">Guest Name</div>
                                            <?= $data['extra_data']->hotel->customerName ?>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div>
                                            <div class="m-b-5">Mobile</div>
                                            <?= $data['extra_data']->hotel->mobile ?>
                                        </div>

                                    </td>
                                    <td class="text-center nowrap">
                                        <div>
                                            <div class="m-b-5">Email</div>
                                            <?= $data['extra_data']->hotel->email ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center title">
                                        <div>
                                            <div class="m-b-5">Service</div>
                                            <?= $data['service'] ?>
                                        </div>
                                    </td>
                                    <td class="text-center uppercase nowrap">
                                        <div>
                                            <div class="m-b-5">Price</div>
                                            <?= $data['extra_data']->hotel->hotelExtraCharges ?> <?= $data['currency'] ?>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div>
                                            <div class="m-b-5">Payment By</div>
                                            <?= $data['paymentMethod'] ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center title">
                                        <div>
                                            <div class="m-b-5">Driver</div>
                                            <?= $data['driver'] ?>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div>
                                            <div class="m-b-5">Origin</div>
                                            <?= $data['locationText'][0]->startAddress ?>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div>
                                            <div class="m-b-5">Destination</div>
                                            <?= $data['locationText'][0]->endAddress ?>
                                        </div>
                                    </td>
                                </tr>

                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    </div>