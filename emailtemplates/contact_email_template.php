<?php include '../constant.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Inquiry</title>

    <style>
    @import url('https://fonts.googleapis.com/css2?family=PT+Sans&display=swap');

    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'PT Sans', sans-serif;
        margin: 0;
        background-color: grey;
    }

    .template {
        max-width: 600px;
        margin: auto;
    }

    .template .table {
        border-collapse: collapse;
        width: 100%;
        background-color: white;
        border-radius: 20px;
        overflow: hidden;
    }

    .template .table thead {
        border-bottom: 6px solid #f0f0f0;
    }

    .template .table .mail-img {
        height: 120px;
        background-color: #579EA6;
    }

    .template .table .mail-img img {
        transform: translateY(19px);
    }

    .template .table .mail-heading h1 {
        color: #003380;
        font-size: 38px;
        line-height: 51px;
        font-weight: normal;
        text-transform: uppercase;
        margin-bottom: 0;
    }

    .template .table .sub-heading h3 {
        font-size: 16px;
        color: #003380;
        font-weight: normal;
        line-height: 19px;
        margin-top: 5px;
        margin-bottom: 0;
    }

    .template .table .date-time {
        padding-bottom: 5px;
    }

    .template .table .page-location {
        padding-bottom: 25px;
    }

    .template .table .date-time h6 , .template .table .page-location h6{
        display: inline-block;
        text-align: center;
        font-size: 14px;
        color: #003380;
        font-weight: normal;
        line-height: 19px;
        margin: 0;
    }

    .template .table tbody .dummy {
        width: 30px;
    }

    .template .table tbody .dummy-row td {
        padding: 8px;
    }

    .template .table .separator {
        height: 50px;
    }

    @media (max-width:767px) {
        .template .table .separator {
            height: 25px;
        }
    }

    .template .table tbody th.body-header h2 {
        color: #003380;
        text-align: left;
        font-size: 20px;
        font-weight: bold;
        line-height: 27px;
        text-transform: uppercase;
    }

    .template .table tbody .head th {
        text-align: left;
        font-size: 12px;
        line-height: 16px;
        color: #444444;
        text-transform: uppercase;
    }

    .template .table tbody .content td {
        text-align: left;
        color: #444444;
        font-size: 13px;
        font-weight: normal;
        line-height: 21px;
        width: 50%;
    }

    .template .table tfoot {
        height: 90px;
        background-color: #adadad;
    }

    .template .table tfoot .footer {
        padding: 0px 30px;
    }

    .template .table tfoot .footer img {
        vertical-align: middle;
    }

    .template .table tfoot .footer span {
        font-size: 16px;
        font-weight: normal;
        line-height: 21px;
        display: inline-block;
        color: #f2f7ff;
    }


    .template .table tbody tr.contain td:last-child,
    .template .table tbody tr.contain th:last-child {
        padding-right: 30px;
    }

    @media (max-width: 500px) {
        .template .table .mail-img {
            height: 65px;
        }

        .template .table .mail-heading h1 {
            font-size: 22px;
            margin: 12px 0px 4px;
            line-height: normal;
        }

        .template .table .date-time {
            padding-bottom: 18px
        }

        .template .table tbody th.body-header h2 {
            font-size: 14px;
            margin: 0px;
        }
    }
    </style>

</head>

<body>
    <div class="template">
        <table class="table" border="0">
            <thead>
                <tr>
                    <th class="mail-img" colspan="2">
                        <img src="<?php echo IMAGE_URL?>/mail-box.png" alt="Mail" style="height:100%">
                    </th>
                </tr>
                <tr>
                    <th class="mail-heading" colspan="2">
                        <h1>Contact Enquiry</h1>
                    </th>
                </tr>
                <tr>
                    <th class="date-time" colspan="2">
                        <h6><?php echo date('jS F Y  h:i A') ?></h6>
                    </th>
                </tr>
                <tr>
                    <th class="page-location" colspan="2">
                        <h6><?php echo $page_name ?? ""; ?></h6>
                    </th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td colspan="2">
                        <div style="padding-left:15px; padding-right:15px;">
                            <table style="width:100%">
                                <tr class="contain">
                                    <th class="body-header" colspan="2">
                                        <h2>
                                            Personal Information
                                        </h2>
                                    </th>
                                </tr>
                                <tr class="head contain">
                                    <th>NAME</th>
                                    <th>Email</th>
                                </tr>
                                <tr class="content contain">
                                    <td><?php echo $name ?? 'NaN'; ?></td>
                                    <td style="word-break: break-all;"><?php echo $email ?? 'NaN'; ?></td>
                                </tr>
                                <tr class="dummy-row">
                                    <td colspan="2"></td>
                                </tr>
                                <tr class="head contain">
                                    <th>Contact Number</th>
                                </tr>
                                <tr class="content contain">
                                    <td><?php echo $phone ?? 'NaN'; ?></td>
                                </tr>
                                <tr class="dummy-row">
                                    <td colspan="2"></td>
                                </tr>

                                <tr class="head contain">
                                    <th>Message</th>
                                </tr>
                                <tr class="content contain">
                                    <td colspan="2">
                                        <?php echo $user_requirement ?? "NaN"; ?>
                                    </td>
                                </tr>

                                <tr class="dummy-row">
                                    <td colspan="2"></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>

            </tbody>

            <tfoot>
                <tr>
                    <td class="footer">
                            <img src="<?php echo IMAGE_URL?>/logo/dark-480.png" alt="Mominsara Developers" width="150" height="30" style="display:inherit">
                            <span style="color:#2c2c2c;font-weight:bold;margin-top:8px;font-size:11px;">Mominsara Developers@2021</span>
                    </td>
                    <td style="font-size: 10px; text-align:left">
                        <address>
                            MOMINSARA LIVING,
                            Survey No. 586/5, FP No. 38, TP 85,
                            Nr. Amwaaj Residency,
                            12 Mtr. Road, Sarkhej,
                            Ahmedabad - 380055
                        </address>
                        <a href="tel:+919913174482" style="color:#216169;margin-top:5px;font-size:12px;display:block;">+91 9913 174482</a>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>