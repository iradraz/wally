<?php $session_data = $this->session->userdata();
?>
<style>
    body{
        background: -webkit-linear-gradient(left, #3931af, #00c6ff);
    }
    .emp-profile{
        padding: 3%;
        margin-top: 3%;
        margin-bottom: 3%;
        border-radius: 0.5rem;
        background: #fff;
    }
    .profile-img{
        text-align: center;
    }
    .profile-img img{
        width: 70%;
        height: 100%;
    }
    .profile-img .file {
        position: relative;
        overflow: hidden;
        margin-top: -20%;
        width: 70%;
        border: none;
        border-radius: 0;
        font-size: 15px;
        background: #212529b8;
    }
    .profile-img .file input {
        position: absolute;
        opacity: 0;
        right: 0;
        top: 0;
    }
    .profile-head h5{
        color: #333;
    }
    .profile-head h6{
        color: #0062cc;
    }
    .profile-edit-btn{
        border: none;
        border-radius: 1.5rem;
        width: 70%;
        padding: 2%;
        font-weight: 600;
        color: #6c757d;
        cursor: pointer;
    }
    .proile-rating{
        font-size: 12px;
        color: #818182;
        margin-top: 5%;
    }
    .proile-rating span{
        color: #495057;
        font-size: 15px;
        font-weight: 600;
    }
    .profile-head .nav-tabs{
        margin-bottom:5%;
    }
    .profile-head .nav-tabs .nav-link{
        font-weight:600;
        border: none;
    }
    .profile-head .nav-tabs .nav-link.active{
        border: none;
        border-bottom:2px solid #0062cc;
    }
    .profile-work{
        padding: 14%;
        margin-top: -15%;
    }
    .profile-work p{
        font-size: 12px;
        color: #818182;
        font-weight: 600;
        margin-top: 10%;
    }
    .profile-work a{
        text-decoration: none;
        color: #495057;
        font-weight: 600;
        font-size: 14px;
    }
    .profile-work ul{
        list-style: none;
    }
    .profile-tab label{
        font-weight: 600;
    }
    .profile-tab p{
        font-weight: 600;
        color: #0062cc;
    }
</style>
<script>
    $(document).ready(function () {
        $('.editBtn').on('click', function () {
            //hide edit span
            $(this).parents("div").find(".editSpan").hide();
            //show edit input
            $(this).parents("div").find(".editInput").show();
            //hide edit button
            $(this).closest("div").find(".editBtn").hide();
            //show edit button
            $(this).closest("div").find(".saveBtn").show();

        });

        $('.saveBtn').on('click', function () {
            var trObj = $(this).closest("div");
            var ID = $('p#user_id').attr('value');

            var email = $('.editInput.email').val();
            var phone = $('.editInput.phone').val();
            $.ajax({
                type: 'POST',
                url: 'client/update_settings',
                dataType: "json",
                data: 'action=edit&user_id=' + ID + '&email=' + email + '&phone=' + phone,
                success: function (response) {
                    if (response.status == 'ok') {
                        trObj.find(".editSpan.email").text(response.data.email);
                        trObj.find(".editInput.email").text(response.data.email);

                        trObj.parents("div").find(".editInput").hide();
                        trObj.find(".saveBtn").hide();
                        trObj.parents("div").find(".editSpan").show();
                        trObj.parents("div").find(".editBtn").show();
                        $('p.editSpan.email').text(email);
                        $('p.editSpan.phone').text(phone);

                    } else {
                        alert(response.msg);
                    }
                }
            });
        });
    });
</script>
<div class="container emp-profile">
    <!--<form method="post">-->
    <div class="row">
        <div class="col-md-4">
            <div class="profile-head">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Timeline</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-2">
            <div class="btn-group btn-group-sm">
                <button type="button" class="btn btn-sm btn-danger editBtn" style="float: none;"><span class="glyphicon glyphicon-pencil">Edit Profile</span></button>
                <button type="button" class="btn btn-sm btn-success saveBtn" style="float: none; display: none;">Save</button>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="tab-content profile-tab" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <label>User Id</label>
                        </div>
                        <div class="col-md-6">
                            <p id="user_id" value="<?php echo $summary[0]['user_id']; ?>"><?php echo $summary[0]['user_id']; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Name</label>
                        </div>
                        <div class="col-md-6">
                            <p><?php echo $summary[0]['user_firstname'] . ' ' . $summary[0]['user_lastname']; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Email</label>
                        </div>
                        <div class="col-md-6">
                            <p class="editSpan email"><?php echo $summary[0]['user_email']; ?></p>
                            <input class="editInput form-control input-sm email" type="text" name="email" value="<?php echo $summary[0]['user_email']; ?>" style="display: none;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Phone</label>
                        </div>
                        <div class="col-md-6">
                            <p class="editSpan phone"><?php echo $summary[0]['user_phone'] ?></p>
                            <input class="editInput form-control input-sm phone" type="text" name="user_phone" value="<?php echo $summary[0]['user_phone']; ?>" style="display: none;">

                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Registered date</label>
                        </div>
                        <div class="col-md-6">
                            <p><?php echo $summary[0]['user_registered_date'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Total Exchanges</label>
                        </div>
                        <div class="col-md-6">
                            <p><?php echo $summary[0]['exchange_count'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Total Deposits</label>
                        </div>
                        <div class="col-md-6">
                            <p><?php echo $summary[0]['deposit_count'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--</form>-->           
</div>