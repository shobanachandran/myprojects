 <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark"  >
                <div class="navbar-header" data-logobg="skin5" style ="padding-left:0px;padding-top:none;" >
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- Logo -->
                    <a class="navbar-brand" href="index.php" style ="padding-left:0px;padding-top:none;">
                        <!-- Logo icon -->
                        <b class="logo-icon p-l-10" style ="padding-left:0px;padding-top:none;">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="assets/images/iorangelogo1.png" height="65" width="250" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                         <!-- Logo text -->
                       
                    </a>
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Last login at 12:00AM</a>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="font-24 mdi mdi-comment-processing"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="">
                                             <!-- Message -->
<a href="javascript:void(0)" class="link border-top" id="chequeReminderLink" style="display: none;">
    <div class="d-flex no-block align-items-center p-10">
        <span class="btn btn-success btn-circle"><i class="ti-calendar"></i></span>
        <div class="m-l-10">
            <h5 class="m-b-0" id="reminderTitle">Cheque Due Tomorrow</h5>
            <span class="mail-desc" id="reminderDescription"></span>
        </div>
    </div>
</a>

<script>
// Function to check if the "cheque_date" is tomorrow
function isTomorrow(dateStr) {
    const today = new Date();
    const tomorrow = new Date();
    tomorrow.setDate(today.getDate() + 1);
    const chequeDate = new Date(dateStr);

    return (
        chequeDate.getDate() === tomorrow.getDate() &&
        chequeDate.getMonth() === tomorrow.getMonth() &&
        chequeDate.getFullYear() === tomorrow.getFullYear()
    );
}

// Fetch the due cheque dates and payees using AJAX
function fetchDueChequeDates() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "fetch_cheque_date.php", true); // Create a PHP script to fetch due cheque dates

    xhr.onload = function () {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            const dueChequeDates = response.due_cheque_dates;

            if (dueChequeDates && dueChequeDates.length > 0) {
                // There are due cheque dates, update the reminder
                const payeeNames = dueChequeDates.map((cheque) => cheque.payee).join(", ");
                document.getElementById("reminderTitle").textContent = "Cheque Due Tomorrow";
                document.getElementById("reminderDescription").textContent = `Don't forget to process the cheques for ${payeeNames} tomorrow.`;
                document.getElementById("chequeReminderLink").style.display = "block";
            } else {
                // No due dates found, keep the reminder hidden
            }
        }
    };

    xhr.send();
}

// Call the function to fetch the due cheque dates when the page loads
fetchDueChequeDates();
</script>
<script>
document.getElementById('chequeReminderLink').addEventListener('click', function() {
    // Redirect to cheque_reminder.php
    window.location.href = 'cheque_reminder.php';
});
</script>

                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-info btn-circle"><i class="ti-settings"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Settings</h5> 
                                                        <span class="mail-desc">You can customize this template</span> 
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-primary btn-circle"><i class="ti-user"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Pavan kumar</h5> 
                                                        <span class="mail-desc">Just see the my admin!</span> 
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-danger btn-circle"><i class="fa fa-link"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Luanch Admin</h5> 
                                                        <span class="mail-desc">Just see the my new admin!</span> 
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!--End Messages-->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!--User profile and search-->
						
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                <!--a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a-->
								<a class="dropdown-item" href="users_add.php?userid=<?php echo $_SESSION['userid']; ?>">
    <i class="ti-user m-r-5 m-l-5"></i> My Profile
</a>

								<a class="dropdown-item" href="javascript:void(0)">
    <i class="ti-user m-r-5 m-l-5"></i> <?php
// Check if the user is logged in
if (isset($_SESSION['userid'])) {
    // Escape the user ID from the session to prevent SQL injection
    $userId = mysqli_real_escape_string($zconn, $_SESSION['userid']);
    
    // Query the database to retrieve the username
    $query = "SELECT UNAME FROM users WHERE USERID = '$userId'";
    $result = mysqli_query($zconn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $username = $row['UNAME'];
        echo $username; // Display the username
    } else {
        echo "Error fetching username from the database.";
    }
} else {
    echo "User is not logged in.";
}
?>

									
</a>

                                <!--a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i> My Balance</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i> Inbox</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a-->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                <div class="dropdown-divider"></div>
                            </div>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>