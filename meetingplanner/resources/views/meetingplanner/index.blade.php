{{-- //////////// control promission  //////////// --}}

{{-- //////////// control promission  //////////// --}}

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Kanit:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap' rel='stylesheet'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="icon" href="{{ URL::asset('http://192.169.1.12:8888/meetingplanner/public/meeting.png') }}" sizes="196x196"> 
    <link rel="stylesheet" href="{{ URL::asset('http://192.169.1.12:8888/meetingplanner/public/css/style.css?mndnd') }}">
    <script type="text/javascript" src="{{URL::asset('http://192.169.1.12:8888/meetingplanner/public/js/component/renderContentChart.js?mndnd')}}"></script>

    {{-- //////////// PAGE CHART renderPageChartXHeatMap()  //////////// --}}
    {{-- <script type="text/javascript" src="{{asset('http://192.169.1.12:8888/meetingplanner/public/js/component/renderContentChart.js?f')}}"></script> --}}
    {{-- //////////// PAGE CHART renderPageChartXHeatMap()  //////////// --}}

    <title>Meeting Planner</title>
 
    <script>
        let userAcc = 0;
        let admin = false;
        let empno = '' 
    </script>
</head>
<body>
   
    <div class="container">
        {{-- ////// alert content ////// --}}
        <div class="alert-massage-func">
            <div class="title-alert">title</div>
            <div class="content-alert">massage</div>
        </div>
        {{-- ////// alert content ////// --}}
        
        {{-- ////// control page DisplayNone ////// --}} 
        <div class='nav-right'>
            <i class='bx bx-calendar-event active' id="pageCalendar"></i>
            <i class='bx bx-grid-horizontal ' id="pageHeatMap"   > </i>
        </div>
        {{-- ////// control page  ////// --}}
        

        {{-- ////// topbar content  ////// --}}
        <div class="topnav">

            
            <div class="box-top-l">
                <label class="pj-name-logo">
                    MEETING PLANNER  
                </label>
                <label class="pj-name-logo-mobile">
                    MP  
                </label>

                    {{-- ////// login content  //////    method="post" autocomplete="off"--}}
               
                            <form  class="content-login" id="content-login" action="meetingplanner/main/login" method="post" autocomplete="off">
                                @csrf
                                <div class="title">
                                    user account 
                                </div>

                                <div class="user-input-login">
                                    <div class="account box-input">
                                        <p class="title">account</p>
                                        <div>
                                            <input type="text" name="account" id="planner_account" autofocus placeholder="ชื่อผู้ใช้ . . ."  required>
                                        </div>
                                        <span class="alert-input account-login" id="account-login">กรุณาระบุชื่อ Account</span>
                                    </div>
                                    <div class="password box-input">
                                        <p class="title">password</p>
                                        <div>
                                            <input type="password" name="password" id="planner_password" placeholder="รหัสผ่าน . . ."  required>
                                            <i class='bx bx-show-alt planner'></i>
                                            <i class='bx bx-low-vision planner'></i>
                                        </div>
                                        <span class="alert-input password-login" id="password-login">กรุณาระกรอกรหัสผ่าน</span>
                                    </div>
                                </div>
                                <div class="user-btn-login">
                                    <a href="http://192.169.1.12:8888/meetingplanner/register">มีบัญชี ? สร้างบัญชีใหม่</a>
                                    <div class="box-button">
                                        <input type="submit" value="เข้าใช้งาน"  >
                                    </div>
                                </div>
                            </form>
                    {{-- ////// login content  ////// --}}


                <div class="meeting-room">
                    <i class='bx bx-chevron-left roomPrev' onclick="prevRoom()"></i>
                    <i class='bx bx-chevron-right roomNext' onclick="nextRoom()"></i>
                    <div class="room" type="button" onclick="roomDropdownMenu()" ><label id="room-input-label">Meeting Room 1</label><div class="room-status"></div></div>
                    <input type="text" name="room-input-name" id="room-input" class="DisplayNone">
                    <span class="room-dropdown dropdown">
                        <ul></ul>
                    </span>
                </div>
            </div>

            <div class="box-top-c"></div>
            <div class="box-top-r">
                <div class="menu-profile">
                    <label> {{session('account')}} </label>
                </div>
                
                    @if (session()->has('account'))
                    
                        <a class='bx bx-log-out' href="meetingplanner/main/logout"></a>
                        @if( session('level') != 'Preuser') 
                            <script>
                                userAcc = 1
                                empno = '<?php echo session('empno');?>'
                                 
                            </script> 
                        @else
                            <script>
                                userAcc = 0
                                empno = '<?php echo session('empno');?>'
                                document.querySelector('.menu-profile').innerHTML +=  '<label class="waitAppove">รออนุมัติการใช้งาน</label>'
                                 // console.log(empno)
                            </script> 
                        @endif

                        @if( session('level') == 'Admin') 
                            <script>
                                // document.querySelector('.menu-profile').style.cursor = "pointer";
                                admin = true;

                                document.querySelector('.menu-profile').addEventListener("dblclick", (e) => {
                                   window.location.href='admin';

                                })

                            </script>
                        @endif

                    @else

                        <label class="label-log-in">login</label>
                        <i class='bx bx-log-in' onclick="login()"></i>
                        <script>
                            userAcc = 0
                        </script>

                    @endif

                </div>


        </div>
        {{-- ////// topbar content  ////// --}}


        <div class="main">
            <div class="backdrop-sidebar"></div>

            <div class="btn-sidebar-show">

            </div>
            <script>
                const btnSidebar = document.querySelector('.btn-sidebar-show');
                const backdrop = document.querySelector('.backdrop-sidebar');

                btnSidebar.addEventListener("click", (e) => {
                    document.querySelector('.sidebar').style.left = '0px'
                    backdrop.style.display = 'flex'
                })

                backdrop.addEventListener("click", (e) => {
                    backdrop.style.display = 'none'
                    document.querySelector('.sidebar').style.removeProperty("left");
 
                })
 
            </script>
            {{-- ////// sidebar content  ////// --}}
                        <div class="sidebar">
                            <div class="content-menu-dept">
                                <div class="header">
                                    <div class="title">แท็ก</div>
                                 
                                </div>
                                <div class="btn-all-dept" onclick="togglecheckAll()">
                                    <i class='dept-reg'></i>
                                    แท็กทั้งหมด
                                </div>
                                <div class="nav-content">
                                     
                                </div>
                            </div>
                               
                            <div class="footer">@hv-fila</div>
                        </div>
            {{-- ////// sidebar content  ////// --}}


            {{-- ////// main content  ////// --}}
                        <div class="content"></div>
            {{-- ////// main content  ////// --}}


            {{-- ////// planner content ////// --}}
                        <div class="event-dialog">
                            <form id="form" class="event" method="post" autocomplete="off">
                                <i class='bx bx-x' onclick="inactiveDialog()"></i>
                                <div class="header">
                                    <div class="content-name">Schedule</div>
                                </div>
                                <div class="content-input">
                                    <div class="input-step-1 ">
                                        <div class="title-selectroom box-input">
                                            <p class="title">ห้องประชุม</p>
                                            <span class="selectroom" onclick="selectRoomDropdownMenu()" ><label id="selectroom-input-label">เลือกห้องประชุม</label></span>
                                            <input type="text" name="mrid" id="selectroom-input" class="DisplayNone">
                                            <nav class="alert-input mrid" id="mrid">กรุณาระบุส่วนงาน</nav>
                                            <nav class="selectroom-dropdown dropdown">
                                                <ul>
                                                    <!-- <li class="selectroom-input" name="Meeting Room 1">Meeting Room 1</li>
                                                    <li class="selectroom-input" name="Meeting Room 2">Meeting Room 2</li>
                                                    <li class="selectroom-input" name="Meeting Room 3">Meeting Room 3</li>
                                                    <li class="selectroom-input" name="Meeting Room 4">Meeting Room 4</li>
                                                    <li class="selectroom-input" name="Meeting Room 5">Meeting Room 5</li>
                                                    <li class="selectroom-input" name="Meeting Room 6">Meeting Room 6</li>
                                                    <li class="selectroom-input" name="Meeting Room 7">Meeting Room 7</li> -->
                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="title-selectdept box-input">
                                            <p class="title">ส่วนงาน</p>
                                            <span class="selectdept" onclick="selectDeptDropdownMenu()"><label id="selectdept-input-label" >เลือกส่วนงาน</label></span>
                                            <input type="text" name="deptid" id="selectdept-input" class="DisplayNone">
                                            <nav class="alert-input deptid" id="deptid">กรุณาระบุส่วนงาน</nav>
                                            <nav class="selectdept-dropdown dropdown">  
                                                <ul>
                                                    <!-- <li class="selectdept-input" name="Meeting Room 1">Meeting Room 1</li>
                                                    <li class="selectdept-input" name="Meeting Room 2">Meeting Room 2</li>
                                                    <li class="selectdept-input" name="Meeting Room 3">Meeting Room 3</li>
                                                    <li class="selectdept-input" name="Meeting Room 4">Meeting Room 4</li>
                                                    <li class="selectdept-input" name="Meeting Room 5">Meeting Room 5</li>
                                                    <li class="selectdept-input" name="Meeting Room 6">Meeting Room 6</li>
                                                    <li class="selectdept-input" name="Meeting Room 7">Meeting Room 7</li> -->
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="input-step-2">
                                        <div class="planner box-input">
                                            <p class="title">ผู้นัดหมาย</p>
                                            <div>

                                                @if (session()->has('account'))

                                                    @if( session('level') == 'Admin') 

                                                        <input type="text" name="planner" pattern="[ก-๏a-zA-Z ]{3,25}" placeholder="กรอกข้อมูล . . .">

                                                    @else

                                                        {{session('name')}}
                                                        <input type="text" name="planner" pattern="[ก-๏a-zA-Z ]{3,25}" value="{{session('empno')}}" placeholder="กรอกข้อมูล . . ." class="DisplayNone">

                                                    @endif

                                                @endif
                                               
                                            </div>
                                            <span class="alert-input" id="planner">กรุณาระบุชื่อผู้นัดหมาย</span>
                                        </div>
                                        <div class="tag-meet box-input">
                                            <p class="title"># Tag</p>
                                            <div onclick="selectTagsDropdownMenu()">
                                                #<span><label id="tag-input-label" ></label></span>
                                                <input type="text" name="tag-id" id="tag-input" placeholder=" . . ." class="DisplayNone"  >
                                                {{-- <input type="text" name="tag-id" id="tag-input" class="DisplayNone" placeholder=" . . ."> --}}
                                            </div>
                                            <span class="alert-input tag-id" id="tag-id" >กรุณาระบุ #</span>
                                            <nav class="tags-list">
                                                <ul>
                                                    {{-- <li># xxxxxxxxxxxxx</li>
                                                    <li># xxxxxxxxxxxxx</li> --}}
                                        
                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="title-meet box-input">
                                            <p class="title">หัวข้อการประชุม</p>
                                            <div>
                                                <input type="text"  pattern=".{3,60}" name="title" placeholder="กรอกข้อมูล . . .">
                                            </div>
                                            <span class="alert-input title" id="title">กรุณาระบุหัวข้อการประชุม</span>

                                        </div>
                                        <div class="detail box-input">
                                            <p class="title">รายละเอียดการประชุม</p>
                                            <div>
                                                <textarea name="detail" rows="3" cols="65" maxlength="1000" placeholder=" . . ."></textarea>
                                            </div>
                                        </div>
                                        <div class="timeleng box-input">
                                            <p class="text-startdate">วัน/เดือน/ปี</p>
                                            <input type="text" name="date" id="date" class="DisplayNone">
                                            <input type="text" name="datef" id="datef" class="DisplayNone" value="">

                                            <p class="title">ระยะเวลา</p>
                                            <div class="leng">
                                                <div class="startdate"><i class=""></i>
                                                    <div>
                                                        <label>เริ่มประชุม</label><input type="time" value="10:00"  name="startdate" id="startdate" >
                                                    </div>
                                                </div> 
                                                <div class="enddate"><i class=""></i> 
                                                    <div>
                                                        <label>สิ้นสุด</label><input type="time" value="17:00"  name="enddate" id="enddate">
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="alert-input enddate">กรุณาระบุระยะเวลาการประชุม</span>

                                            <!-- <div class="allday"></div> -->
                                        </div>
                                        <!-- <div class="addlist box-input">
                                            <p class="title">รายชื่อผู้เข้าร่วมประชุม</p>
                                            <div>
                                                <input type="text">
                                            </div>
                                        </div> -->
                                        <div class="accessories box-input">
                                            <p class="title">รายการอุปกรณ์เสริม</p>
                                            <div>
                                                {{-- <nav>
                                                    <input type="checkbox" id="item1" name="item1" value="Bike">
                                                    <label for="item1">item 1</label><br>
                                                </nav>
                                                <nav>
                                                    <input type="checkbox" id="item2" name="item2" value="Car">
                                                    <label for="item2">item 2</label><br>
                                                </nav>
                                                <nav>
                                                    <input type="checkbox" id="item3" name="item3" value="Boat">
                                                    <label for="item3">item 3</label><br><br>
                                                </nav> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <div class="box-button">
                                        <!-- <button type="submit">submit</button> -->
                                        <input type="submit" value="ยืนยัน">
                                    </div>
                                </div>
                            </form>
                        </div>
                    
                        {{-- <div class="content-edit-dialogMove "> --}}
                            <form id="form-edit" class="content-edit" method="post" autocomplete="off">
                                <i class='bx bx-x' onclick="inactiveDialogEdit()"></i>
                                <div class="header">
                                    <div class="content-name-edit">Schedule</div>
                                </div>
                                <input type="text" name="planid" id="planid" class="DisplayNone">
                                {{-- <input type="text" name="appointid" id="appointid" class="DisplayNone"> --}}
                                <input type="text" name="planner-edit" id="planner-edit" class="DisplayNone">

                                <div class="content-detail-edit">
                                    <div class="input-step-1">
                                        <div class="title-selectroom box-input"> 
                                            <p class="title">ห้องประชุม</p>
                                            <span class="selectroom-edit"  onclick="selectRoomDropdownMenuEdit()" ><label id="selectroom-input-edit-label">เลือกห้องประชุม</label></span>
                                            <input type="text" name="mrid-edit" id="selectroom-input-edit" class="DisplayNone">
                                            <nav class="alert-input mrid-edit">กรุณาระบุห้องประชุม</nav>
                                            <nav class="selectroom-dropdown-edit dropdown">
                                                <ul>
                                                    <!-- <li class="selectroom-input-edit" name="Meeting Room 1">Meeting Room 1</li>
                                                    <li class="selectroom-input-edit" name="Meeting Room 2">Meeting Room 2</li>
                                                    <li class="selectroom-input-edit" name="Meeting Room 3">Meeting Room 3</li>
                                                    <li class="selectroom-input-edit" name="Meeting Room 4">Meeting Room 4</li>
                                                    <li class="selectroom-input-edit" name="Meeting Room 5">Meeting Room 5</li>
                                                    <li class="selectroom-input-edit" name="Meeting Room 6">Meeting Room 6</li>
                                                    <li class="selectroom-input-edit" name="Meeting Room 7">Meeting Room 7</li> -->
                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="title-selectdept box-input">
                                            <p class="title">ส่วนงาน</p>
                                            <span class="selectdept-edit"  onclick="selectDeptDropdownMenuEdit()"><label id="selectdept-input-edit-label" >เลือกส่วนงาน</label></span>
                                            <input type="text" name="deptid-edit" id="selectdept-input-edit" class="DisplayNone">
                                            <nav class="alert-input deptid-edit">กรุณาระบุส่วนงาน</nav>
                                            <nav class="selectdept-dropdown-edit dropdown">  
                                                <ul>
                                                    <!-- <li class="selectdept-input-edit" name="Meeting Room 1">Meeting Room 1</li>
                                                    <li class="selectdept-input-edit" name="Meeting Room 2">Meeting Room 2</li>
                                                    <li class="selectdept-input-edit" name="Meeting Room 3">Meeting Room 3</li>
                                                    <li class="selectdept-input-edit" name="Meeting Room 4">Meeting Room 4</li>
                                                    <li class="selectdept-input-edit" name="Meeting Room 5">Meeting Room 5</li>
                                                    <li class="selectdept-input-edit" name="Meeting Room 6">Meeting Room 6</li>
                                                    <li class="selectdept-input-edit" name="Meeting Room 7">Meeting Room 7</li> -->
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="input-step-2">
                                        <div class="tag-meet box-input">
                                            {{-- <p class="title"># Tag</p>
                                            <div>
                                                #<input type="text" name="tag-edit"  id="tag-edit" placeholder=" . . .">
                                            </div>
                                            <span class="alert-input tag-edit">กรุณาระบุ #</span> --}}

                                            <p class="title"># Tag</p>
                                            <div  onclick="selectTagsDropdownMenuEdit()">
                                                #<span><label id="tag-input-edit-label" ></label></span>
                                                <input type="text" name="tag-id-edit" id="tag-input-edit" class="DisplayNone" placeholder=" . . .">
                                                {{-- <input type="text" name="tag-name-edit" id="tag-input-edit" class="DisplayNone" placeholder=" . . ."> --}}
                                             </div>
                                            <span class="alert-input tag-id-edit" id="tag-id-edit" >กรุณาระบุ #</span>
                                            <nav class="tags-list-edit">
                                                <ul>
                                                    {{-- <li># xxxxxxxxxxxxx</li>
                                                    <li># xxxxxxxxxxxxx</li> --}}
                                        
                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="title-meet box-input">
                                            <p class="title">หัวข้อการประชุม</p>
                                            <div>
                                                <input type="text" name="title-edit" pattern=".{3,60}"  id="title-edit" placeholder="กรอกข้อมูล . . .">
                                            </div>
                                            <span class="alert-input title-edit">กรุณาระบุหัวข้อการประชุม</span>
                    
                                        </div>
                                        <div class="detail box-input">
                                            <p class="title">รายละเอียดการประชุม</p>
                                            <div>
                                                <textarea name="detail-edit" id="detail-edit" rows="3" cols="65" maxlength="1000" placeholder=" . . ."></textarea>
                                            </div>
                                        </div>
                                        <div class="detail box-input">
                                            <p class="title">วันที่</p>
                                            <div>
                                                <input type="date" name="date-edit" id="date-edit"  >
                                            </div>
                                            <span class="alert-input date-edit">กรุณาระบุวันที่</span>

                                        </div>
                                        <div class="timeleng box-input">
                                        
                                            <p class="title">ระยะเวลา</p>
                                            <div class="leng">
                                                <div class="startdate"><i class=""></i>
                                                    <div>
                                                        <label>เริ่มประชุม</label><input type="time"  name="startdate-edit" id="startdate-edit">
                                                    </div>
                                                </div> 
                                                <div class="enddate"><i class=""></i> 
                                                    <div>
                                                        <label>สิ้นสุด</label><input type="time"  name="enddate-edit" id="enddate-edit" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="alert-input enddate-edit">กรุณาระบุระยะเวลาการประชุม</span>

                                            
                                            <!-- <div class="allday"></div> -->
                                        </div>
                                        
                                        <div class="accessories edit box-input">
                                            <p class="title">รายการอุปกรณ์เสริม</p>
                                            <div>
                                                {{-- <nav>
                                                    <input type="checkbox" id="item1-edit" name="item1-edit" value="Bike">
                                                    <label for="item1-edit">item 1</label><br>
                                                </nav>
                                                <nav>
                                                    <input type="checkbox" id="item2-edit" name="item2-edit" value="Car">
                                                    <label for="item2-edit">item 2</label><br>
                                                </nav>
                                                <nav>
                                                    <input type="checkbox" id="item3-edit" name="item3-edit" value="Boat">
                                                    <label for="item3-edit">item 3</label><br><br>
                                                </nav> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <div class="box-button">
                                        <input type="submit" value="บันทึก">
                                    </div>
                                </div>
                            </form>
                        {{-- </div> --}}


                        <div class="content-views-dialogMove">
                            <div class="content-views">
                                <i class='bx bx-x' onclick="inactiveDialogView()"></i>
                                <div class="header">
                                    <div class="content-name-edit">View</div>
                                </div>
                                <div class="data-view-event">
                                    {{-- <div class="detail-view">
                                        <div class="title">Xxxx</div>
                                        <div class="field">sssss</div>
                                    </div>
                                    <div class="detail-view">
                                        <div class="title">Xxxx</div>
                                        <div class="field">sssss</div>
                                    </div>
                                    <div class="detail-view">
                                        <div class="title">Xxxx</div>
                                        <div class="field">sssss</div>
                                    </div>
                                    <div class="detail-view">
                                        <div class="title">Xxxx</div>
                                        <div class="field">sssss</div>
                                    </div>
                                    <div class="detail-view">
                                        <div class="title">Xxxx</div>
                                        <div class="field">sssss</div>
                                    </div>
                                    <div class="detail-view">
                                        <div class="title">Xxxx</div>
                                        <div class="field">sssss</div>
                                    </div>
                                    <div class="detail-view">
                                        <div class="title">Xxxx</div>
                                        <div class="field">sssss</div>
                                    </div> --}}
                                </div>
                               
                            </div>
                        </div>
                        
                        <div class="backdrop-manage-tag">
                            <form id="tag-color-change" class="tag-color-change" method="post" autocomplete="off">
                                <input type="text" name="tagname" id="tagname" class="DisplayNone">
                                <input type="color" class="tag-color-change-input" id="favcolor" style="width: 50px; height:30px; border: 2px solid rgb(236, 236, 236)" name="favcolor" > 
                                <input type="submit" value="เปลี่ยน">
                            </form>
                            <div class="tag-color-change-after"></div>
                            <div class="dialog-manage-tag">
                                <div class="head">My tag</div>
                                <form id="box-create-tag" class="box-create-tag" method="post" autocomplete="off">
                                    <div class="title">สร้างแท็กใหม่</div>
                                    #<input type="text" id="createMyTag" name="MyTagName" pattern="[ก-๏a-zA-Z0-9.=$%&@?]{3,30}" placeholder="ชื่อแท็ก . . ."> 
                                    <input type="submit" value="สร้าง">
                                </form>
                                <div class="box-show-tags-me" >
                                    <ul>
                                        <li class="header">
                                            <div class="no-elem">No.</div>
                                            <div class="name-elem">tag</div>
                                            <div class="count">event</div>
                                            <div class="manage-elem"> </div>
                                        </li>
                                        <br>
                                        {{-- <li>
                                            <div class="no-elem">1s</div>
                                            <div class="name-elem">tag</div>
                                            <div class="count">1</div>
                                            <div class="manage-elem">
                                                <i class='bx bxs-brush' title="สีแท็ก"></i>
                                                <i class='bx bxs-lock-alt' title="การเปิดใช้งาน"></i>
                                                <i class='bx bxs-trash' title="ลบแท็ก"></i>
                                            </div>
                                        </li> --}}
                                       
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="backdrop-alert"></div>
            {{-- ////// planner content ////// --}}


           

            {{-- ////// planner content ////// --}}

        </div>

        <div class="event-tool">
            {{-- <i class='bx bx-expand-alt'></i> --}}
            <div class="room"><label>&nbsp;&nbsp;&nbsp;</label></div>
            <div class="datetime"><label>&nbsp;&nbsp;&nbsp;</label>&nbsp;&nbsp;&nbsp;<label>&nbsp;&nbsp;&nbsp;</label></div>
            <div class="planner"><label>&nbsp;&nbsp;&nbsp;</label></div>
            <div class="dept"><label>&nbsp;&nbsp;&nbsp;</label></div>
            <div class="content-btn">
                {{-- <input type="button" class="event-edit" value="ปรับเปลี่ยน"> </input>
                <input type="button" class="event-cancel" value="ยกเลิก"> </input> --}}
            </div>
        </div>

        <div class="event-tool-after"></div>
    </div>
   
       
    <script>

        //////////// config path ///////////////
        const pathMain = '/meetingplanner/main/';
        //////////// config path ///////////////


        //////////// main data ///////////////
                    let dataJson = [];
                    let roomCurrent = {roomid: "", index: 0}

                    let pageActive = {
                        "pageCalendar" : true,
                        "pageHeatMap" : false
                    }

                    let dataEvents = [];
        //////////// main data ///////////////


        ////////// func all page //////////
                    const changeTypeInput = (idElement, type) => {
                        document.getElementById(idElement).type = type;
                    }

                    const planner_password =  document.querySelector('.bx-show-alt.planner');
                    const planner_Inpassword =  document.querySelector('.bx-low-vision.planner');
            
                    const content_login =  document.querySelector('.content-login');

                    planner_password.style.display = 'none'
                    planner_Inpassword.style.display = 'block'

                    planner_password.addEventListener('click', () => {

                        changeTypeInput('planner_password','password')
                        planner_password.style.display = 'none'
                        planner_Inpassword.style.display = 'block'
                        
                    })

                    planner_Inpassword.addEventListener('click', () => {

                        changeTypeInput('planner_password','text')
                        planner_password.style.display = 'block'
                        planner_Inpassword.style.display = 'none'

                    })

                    // planner_password.addEventListener('mouseup', () => {
                       
                    // })

                    const login = () => {
                         content_login.classList.toggle('active')
                         document.querySelector(".backdrop-alert").style.display = "block"

                    }

                    const logout = () => {
                        //localStorage.clear();
                        location.reload();

                    }

                    const roomDropdownMenu = () => {
                        document.querySelector(".room-dropdown").classList.toggle('active')
                    }

                    const recheck = () => {
                        let deptRadio = document.querySelectorAll(".btn-nav-dept");

                        deptRadio.forEach((radio) => {
                            document.querySelector(".radio-dept-" + radio.id).classList.remove("disable");
                            document.querySelector(".radio-dept-" + radio.id).style.backgroundColor = radio.getAttribute("name")
                        });
                        document.querySelector(".btn-all-dept").classList.add('active')
                        
                        deptRadio = null;
                    }

                    const togglecheckAll = () => {
                        let deptRadio = document.querySelectorAll(".btn-nav-dept");

                        if(document.querySelector(".btn-all-dept").classList.contains('active')) {
                            deptRadio.forEach((radio) => {
                                document.querySelector(".radio-dept-" + radio.id).classList.add("disable");
                                document.querySelector(".radio-dept-" + radio.id).style.backgroundColor = "#dbdbdb"

                                if(pageActive.pageCalendar) {
                                    document.querySelectorAll(".event-day." + radio.id).forEach((eventdept) => {
                                        eventdept.style.display = "none";
                                    })
                                }

                                if(pageActive.pageHeatMap) {
                                    setTimeout(function() {
                                        document.querySelector(".content-heatmap."+ radio.id).classList.add('displayNone')
                                    }, 400)
                                    document.querySelector(".content-heatmap."+ radio.id).classList.add('active')
                                }
                                
                            });

                        } else {
                            deptRadio.forEach((radio) => {
                                document.querySelector(".radio-dept-" + radio.id).classList.remove("disable");
                                document.querySelector(".radio-dept-" + radio.id).style.backgroundColor = radio.getAttribute("name")

                                if(pageActive.pageCalendar) {
                                    document.querySelectorAll(".event-day." + radio.id).forEach((eventdept) => {
                                        eventdept.style.display = "block";
                                    })
                                }

                                if(pageActive.pageHeatMap) {
                                    document.querySelector(".content-heatmap."+ radio.id).classList.remove('displayNone')
                                    setTimeout(function() {
                                        document.querySelector(".content-heatmap."+ radio.id).classList.remove('active')
                                    }, 400)
                                }
                            });
                        }

                        document.querySelector(".btn-all-dept").classList.toggle('active')

                        deptRadio = null;
                    }

                    const addListenerNav = () => {

                        const deptRadio = document.querySelectorAll(".btn-nav-dept");

                        let ebuff

                        deptRadio.forEach((dept) => {
                            dept.addEventListener("click", (e) => {
                                ebuff = document.querySelector(".radio-dept-" + e.target.id);

                                if(ebuff.classList.contains('disable')) {                 

                                    ebuff.style.backgroundColor = e.target.getAttribute("name")

                                    if(pageActive.pageCalendar) {
                                        document.querySelectorAll(".event-day." + e.target.id).forEach((eventdept) => {
                                            eventdept.style.display = "block";
                                        })
                                    }

                                    if(pageActive.pageHeatMap) {
                                        document.querySelector(".content-heatmap."+ e.target.id).classList.remove('displayNone')
                                        setTimeout(function() {
                                            document.querySelector(".content-heatmap."+ e.target.id).classList.remove('active')
                                        }, 400)
                                    }
                            

                                } else {                    

                                    ebuff.style.backgroundColor = "#dbdbdb"

                                    if(pageActive.pageCalendar) {
                                        document.querySelectorAll(".event-day." + e.target.id).forEach((eventdept) => {
                                            eventdept.style.display = "none";
                                        })
                                    }

                                    if(pageActive.pageHeatMap) {
                                        setTimeout(function() {
                                            document.querySelector(".content-heatmap."+ e.target.id).classList.add('displayNone')
                                        }, 400)
                                        document.querySelector(".content-heatmap."+ e.target.id).classList.add('active')
                                    }
                                

                                }

                                
                                ebuff.classList.toggle('disable');


                            })
                        })

                        ebuff = null;
                    }

                    const renderNavbar = ( ) => {
                        let content = "";

                        var rootStyle = document.querySelector(':root');
                        // let styleDeptColor = "";

                        if(dataJson != []) {
                            // dataJson.Dept.forEach((e, index) => {

                            //     // styleDeptColor += "--color-" + e.id + ":" + e.color + ";" 9e5fff75  9e5fffad 9e5fffcc #9e5fff
                            //     rootStyle.style.setProperty("--color-" + e.id, e.color);
                            //     rootStyle.style.setProperty("--color-map-" + e.id, '#e6e6e6' + ',' + e.color + '75,' + e.color + 'ad ,' + e.color + 'cc,' + e.color + '' );

                            //     if(e.active) {
                            //         content += "<div id=" + e.id + " name="+ e.color +" class='btn-nav-dept'>\
                            //                         <div id=" + e.id + "  name="+ e.color +" class='btn-nav-dept-icon'>\
                            //                             <i id=" + e.id + "  name="+ e.color +" style='background-color: " + e.color + ";' class='dept-radio radio-dept-" + e.id + "'></i>\
                            //                         </div>\
                            //                         <div id=" + e.id + " name="+ e.color +" class='btn-nav-dept-name'>" + e.name + "</div>\
                            //                     </div>" 
                            //     }      
                                
                            // });

                            dataJson.tags.forEach((e, index) => {

                                 // styleDeptColor += "--color-" + e.id + ":" + e.color + ";" 9e5fff75  9e5fffad 9e5fffcc #9e5fff
                                rootStyle.style.setProperty("--color-" + e.name, e.color);
                                rootStyle.style.setProperty("--color-map-" + e.name, '#e6e6e6' + ',' + e.color + '75,' + e.color + 'ad ,' + e.color + 'cc,' + e.color + '' );

                                if(e.active) {
                                    content += "<div id=" + e.name + " name="+ e.color +" class='btn-nav-dept' style='justify-content: space-between;'>\
                                                    <div id=" + e.name + "  name="+ e.color +" class='btn-nav-dept-icon'>\
                                                        <i id=" + e.name + "  name="+ e.color +" style='background-color: " + e.color + ";' class='dept-radio radio-dept-" + e.name + "'></i>\
                                                        <div id=" + e.name + " name="+ e.color +" class='btn-nav-dept-name'>#" + e.name + "</div>\
                                                    </div>\
                                                    <div id=" + e.name + " name="+ e.color +" class='tagfollows'>#follow " + e.tagcount + "</div>\
                                                </div>" 
                                }      

                            });

                            document.querySelector(".nav-content").innerHTML = content
                            addListenerNav()
                        }

                        content = null;
                    }

        ////////// func all page //////////

        ////////// content  page Calendar //////////

        ////////// func plannerCalendar //////////
                    const formatDatetime = (date,time) => {
                        let dateFormat = new Date(date);

                        if(time != "") {
                            dateFormat.setHours(time.split(':')[0]);
                            dateFormat.setMinutes(time.split(':')[1]);
                            dateFormat.setSeconds(0);
                        }
                    
                        return  String(dateFormat.getFullYear()).padStart(2, '0')+
                                    "-"+ String((dateFormat.getMonth()+1)).padStart(2, '0')+
                                    "-"+ String(dateFormat.getDate()).padStart(2, '0')+
                                    " "+ String(dateFormat.getHours()).padStart(2, '0')+
                                    ":"+ String(dateFormat.getMinutes()).padStart(2, '0')+
                                    ":"+ String(dateFormat.getSeconds()).padStart(2, '0');

                        dateFormat = null;
                    }
                    
                    const dateRangeOverlaps = (a_start, a_end, b_start, b_end) =>  {
                        if (a_start <= b_start && b_start < a_end) return true; 
                        if (a_start < b_end   && b_end  < a_end) return true; 
                        if (b_start <  a_start && a_end  <  b_end) return true; 
                        return false;
                    }

                    const str00 = (num, strV) => {
                        return String(num).padStart(strV, '0')
                    }
        ////////// func plannerCalendar //////////


        ////////// func render data element //////////
                    const selectRoomDropdownMenu = () => {
                        // document.querySelector(".selectroom-dropdown").classList.toggle('active')
                    }
                    const selectDeptDropdownMenu = () => {
                        document.querySelector(".selectdept-dropdown").classList.toggle('active')
                    }
                    const selectRoomDropdownMenuEdit = () => {
                        document.querySelector(".selectroom-dropdown-edit").classList.toggle('active')
                    }
                    const selectDeptDropdownMenuEdit = () => {
                        document.querySelector(".selectdept-dropdown-edit").classList.toggle('active')
                    }

                    const selectTagsDropdownMenu = () => {
                        document.querySelector(".event-dialog .tags-list").classList.toggle('active')
                    }

                    const selectTagsDropdownMenuEdit = () => {
                        document.querySelector(".content-edit .tags-list-edit").classList.toggle('active')
                    }

                    const renderDropdownTagsMeetings = (content_class, content_class_add) => {

                        if(dataJson != []) {
                            dataJson.tags.forEach((e, index) => {  
                                if(e.active) {

                                    let li = document.createElement("li");
                                    li.classList.add(content_class);
                                    li.innerHTML ='#' + e.name;
                                    li.setAttribute("name",  e.name);
                                    li.setAttribute("id",  e.id);
                                    li.setAttribute("key",  index);
                                    li.addEventListener('click', () => { 

                                        document.getElementById(content_class+'-label').innerHTML = e.name
                                        document.getElementById(content_class).value =  e.name
                                        document.querySelector(".event-dialog .tags-list").classList.remove('active')
                                        document.querySelector(".content-edit .tags-list-edit").classList.remove('active')
                                    });
                                    

                                    document.querySelector("." + content_class_add +" ul").appendChild(li)
                                    
                                }      
                                
                            });

                        }
                    }

                    const renderDropdownMeetingRooms = (content_class, content_class_add) => {

                        if(dataJson != []) {
                            dataJson.meetingRoom.forEach((e, index) => {  
                                if(e.isopen) {

                                    let li = document.createElement("li");
                                    li.classList.add(content_class);
                                    li.innerHTML = e.mrname;
                                    li.setAttribute("name",  e.mrname);
                                    li.setAttribute("id",  e.mrid);
                                    li.setAttribute("key",  index);
                                    li.addEventListener('click', () => { 

                                        document.getElementById(content_class+'-label').innerHTML = e.mrname
                                        document.getElementById(content_class).value =  e.mrid

                                         if(content_class == 'room-input') {
                                            renderEventsPlanningReset(roomCurrent.roomid)
                                            renderEventsPlanning(e.mrid)

                                            roomCurrent.roomid =  e.mrid
                                            roomCurrent.index =  index

                                            renderSelectAccessories(e.mrid)

                                            document.getElementById("selectroom-input-label").innerHTML = e.mrname
                                            document.getElementById("selectroom-input").value = e.mrid
                                            
                                        } else if(content_class == 'selectroom-input-edit') {

                                            document.getElementById(content_class+'-label').innerHTML = e.mrname
                                            document.getElementById(content_class).value =  e.mrid

                                            renderSelectAccessoriesEdit(e.mrid, 'null');
                                        
                                        } 
                                        
                                    });
                                    
 
                                    document.querySelector("." + content_class_add +" ul").appendChild(li)
                                    
                                }      
                                
                            });

                        
                        }
                    }
                    const renderDropdownDepts = (content_class, content_class_add) => {

                        if(dataJson != []) {
                            dataJson.Dept.forEach((e, index) => {  
                                if(e.active) {
            
                                    let li = document.createElement("li");
                                    li.classList = (content_class + ' ' + e.id); 
                                    // li.style = '--color-dept: '+ e.color ;7d7d7d 05afff
                                    li.innerHTML = e.name;
                                    li.setAttribute("name",  e.name);
                                    li.setAttribute("id",  e.id);
                                    li.setAttribute("key",  index);
                                    li.addEventListener('click', () => { 

                                        // console.log(li)
                                        if(document.getElementById(content_class+'-label').textContent.search("เลือกส่วนงาน") != -1 ) {
                                            document.getElementById(content_class+'-label').innerHTML = ''
                                        }

                                        let EditLabel = document.getElementById(content_class+'-label').textContent != ''? (document.getElementById(content_class+'-label').textContent).split(' , ') : []
                                        let EditV = document.getElementById(content_class).value != ''? (document.getElementById(content_class).value).split(',') : []
                                         

                                        if(!li.classList.contains('active')) {

                                            EditLabel.push(e.name)
                                            EditV.push(e.id)

                                            document.getElementById(content_class+'-label').innerHTML = (EditLabel.toString()).replace(',',' , ')
                                            document.getElementById(content_class).value =(EditV.toString())

                                        } else {

                              

                                            EditLabel = EditLabel.filter(v => v != e.name);
                                            EditV = EditV.filter(v => v != e.id);
                                            
                                            // console.log(EditLabel)
                                            // console.log(EditV)

                                            document.getElementById(content_class+'-label').innerHTML = (EditLabel.toString()).replace(',',' , ')
                                            document.getElementById(content_class).value =(EditV.toString())
                                        }

                                        // if(document.getElementById(content_class+'-label').textContent.search("เลือกแผนก") != -1 ) {
                                        //     document.getElementById(content_class+'-label').innerHTML = ''
                                            
                                        // } else {
                                        //     document.getElementById(content_class+'-label').innerHTML += ' , '
                                        //     document.getElementById(content_class).value += ','
                                        // }

                                        // if(!li.classList.contains('active')) {

                                        //     document.getElementById(content_class+'-label').innerHTML += e.name
                                        //     document.getElementById(content_class).value += e.id

                                        // } else {
                                          

                                            // if(EditLabel.search(",") != -1) {

                                            //     document.getElementById(content_class+'-label').innerHTML = EditLabel.replace((' , ' + e.name),'')
                                            //     document.getElementById(content_class).value = EditV.replace((',' + e.id),'')
                                                
                                            // } else {

                                            //     document.getElementById(content_class+'-label').innerHTML = EditLabel.replace((e.name),'')
                                            //     document.getElementById(content_class).value = EditV.replace((e.id),'')

                                            // }
                                           
                                        //}

                                        li.classList.toggle('active')
                                     
                                    });

                                    document.querySelector("." + content_class_add +" ul").appendChild(li)
                                    
                                }      
                                
                            });
                        
                        }
                    }
                    const renderSelectAccessories = (mrid) => {
                        let content = "";
                        let acc = [];
                        let addDetail = "";

                        $.ajax({
            
                            url: pathMain + 'show/?id=' + mrid + '&content=' + "room_acc" ,
                            type: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(room_acc) {
                                if(room_acc.length != 0 ) {
                                    room_acc.forEach((e, index) => {  

                                        acc = (dataJson.accessories[dataJson.accessories.findIndex(obj => { return obj.accid == e.accid })])

                                        // console.log(e.accid)
                                        if( e.accid == 'acc-B2iaW-26072023-its' ) {
                                            
                                            addDetail = '<nav class="comment-acc">\
                                                            <label  >'+ acc.accname +'</label><br>\
                                                            <textarea title='+ acc.detail +' id="' + acc.accid + '" name="item-c" rows="4" cols="65" maxlength="255" style="resize: none; width: 100%;"></textarea>\
                                                        </nav>'
                                            
                                        } else if( acc.stock != 0  ) {
                                            content +=  "<nav>\
                                                            <input type='checkbox' id="+ acc.accid +" name="+ 'item-' + index +"  value='"+ acc.accid +"'>\
                                                            <label for="+ 'item-' + index +" title="+ acc.detail +" >"+ acc.accname +"</label><br>\
                                                        </nav>";

                                        } 

                                    });

                                    
                                } else {
                                    content = "<nav>ไม่พบรายการอุปกรณ์</nav>"
                                }

                                document.querySelector(".accessories div").innerHTML = content + addDetail
                                content = null;
                                acc = null;
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                            
                        });

                        //console.log( {{ session()->get('message') }})
                            // <div class="alert alert-success">
                               
                            // </div>

                        

                    }

                    const renderSelectAccessoriesEdit = (mrid, planid) => {
                        let content = "";
                        // let meeting_acc = [];
                        let acc = [];
                        let addDetail = ""

                        $.ajax({
            
                            url: pathMain + 'show/?id=' + mrid + '&id2=' +  planid + '&content=' + "meeting_acc" ,
                            type: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(meeting_acc) {

                                if(  meeting_acc != [] && meeting_acc.roomacc.length != 0 ) {

                                    meeting_acc.roomacc.forEach((e, index) => {  
                                        
                                        acc = (dataJson.accessories[dataJson.accessories.findIndex(obj => { return obj.accid == e.accid })])
                                        
                                        if( e.accid == 'acc-B2iaW-26072023-its') {
                                             addDetail = '<nav class="comment-acc">\
                                                            <label >'+ acc.accname +'</label><br>\
                                                            <textarea  title='+ acc.detail +' id="' + acc.accid + '" name="item-c" rows="4" cols="65" maxlength="255" style="resize: none; width: 100%;">'
                                                                +
                                                                   ( meeting_acc.meetingacc.findIndex( obj => { return obj.accid == e.accid }) != -1 ?    
                                                                        
                                                                        meeting_acc.meetingacc[meeting_acc.meetingacc.findIndex( obj => { return obj.accid == e.accid })].comment
                                                                    :
                                                                        '')
                                                                +
                                                            '</textarea>\
                                                        </nav>'
                                            
                                        } else if(acc.stock != 0) {
                                            content +=  "<nav>\
                                                            <input type='checkbox' id="+ acc.accid +" name="+ 'item-' + index +"  value='"+ acc.accid + "' " + ( meeting_acc.meetingacc.length > 0 && (meeting_acc.meetingacc.findIndex( obj => { return obj.accid == e.accid }) != -1) ? 'checked' : '' ) + ">\
                                                            <label for="+ 'item-' + index +" title="+ acc.detail +" >"+ acc.accname +"</label><br>\
                                                        </nav>";
                                        } 
                                    });

                                } else {
                                    content = "<nav>ไม่พบรายการอุปกรณ์</nav>"
                                }

                                document.querySelector(".accessories.edit div").innerHTML = content + addDetail
                                
                                content = null;
                                acc = null;

                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        });
                    
                    }

                    const renderSelectAccessoriesView = (mrid, planid) => {
                        let content = '<div class="detail-view"><div class="title">รายการอุปกรณ์เสริม</div>';
                        let acc = [];
                        let addDetail = ''

                        $.ajax({
            
                            url: pathMain + 'show/?id=' + mrid + '&id2=' +  planid + '&content=' + "meeting_accview" ,
                            type: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(meeting_acc) {

                                if( meeting_acc != [] && meeting_acc.meetingacc.length != 0 ) {

                                    meeting_acc.meetingacc.forEach((e, index) => {  
            
                                        acc = (dataJson.accessories[dataJson.accessories.findIndex(obj => { return obj.accid == e.accid })])

                                        if( meeting_acc.meetingacc.length > 0 && e.accid == 'acc-B2iaW-26072023-its') {
                                            
                                            addDetail = '<div class="field">อื่นๆ ... /  ' + e.comment + '</div>'
                                            
                                        } else if( meeting_acc.meetingacc.length > 0 && (meeting_acc.meetingacc.findIndex( obj => { return obj.accid == e.accid }) != -1) ) {
                                            content +=  "<div class='field'>"
                                                           + acc.accname +
                                                        "</div>";
                                        }
                                       
                                    });

                                } else {
                                    content += "<div class='field'>ไม่มีรายการ</div>"

                                }

                                
                                document.querySelector(".content-views .data-view-event").innerHTML += content + addDetail + '</div>'
                                
                                addDetail = null;
                                content = null;
                                acc = null;

                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        });
                    
                    }


                    
                    const renderMyTag = () => {
                        let content = '<li class="header">\
                                            <div class="no-elem">No.</div>\
                                            <div class="name-elem">tags</div>\
                                            <div class="count">events</div>\
                                            <div class="manage-elem"> </div>\
                                        </li>\
                                        <br>';
                        
                        $.ajax({
                            url: pathMain + 'show/?id=' + empno + '&content=' + "mytagmeeting" ,
                            type: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(mytag) {

                                if( mytag.length != 0 ) {

                                    mytag.forEach((e, index) => {  
                                        //  <i class="bx bxs-lock-alt" title="การเปิดใช้งาน"></i>\ 
                                        content += '<li id="ref-tag-' + (e.name) + '">\
                                                        <div class="no-elem">' + (index+1) + '</div>\
                                                        <div class="name-elem">#' + (e.name) + '</div>\
                                                        <div class="count">' + (e.tagcount) + '</div>\
                                                        <div class="manage-elem">\
                                                            <i class="bx bxs-brush ref-brush-' + e.name + '" id="color-' + e.name + '-' +  e.color + '" title="สีแท็ก" style="color:'+ e.color +';" onClick="printMousePosChangeTagColor(this)"></i>\
                                                            <i class="bx bxs-trash" id="' + e.name + '" title="ลบแท็ก" onClick="deleteDataConfirm(this)" ></i>\
                                                        </div>\
                                                    </li>'
                                    });

                                } else {

                                    content += ""

                                }

                                document.querySelector(".box-show-tags-me ul").innerHTML = content

                                content = null;
                                 
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        });
                    
                    }

        ////////// func render data element //////////

   

                        // readJson("../test/dept-data-render.json", function(obj){
                        //     dataJson = JSON.parse(obj);
                        //     renderNavbar()
                        //     renderDropdownMeetingRooms('room-input', 'room-dropdown')

                        //     renderDropdownMeetingRooms('selectroom-input', 'selectroom-dropdown')
                        //     renderDropdownDepts('selectdept-input', 'selectdept-dropdown')

                        //     renderDropdownMeetingRooms('selectroom-input-edit', 'selectroom-dropdown-edit')
                        //     renderDropdownDepts('selectdept-input-edit', 'selectdept-dropdown-edit')

                        // });


        ////////// control data //////////
                    const callData = ( ) => {
                        //dataJson.meetingRoom
                        //dataJson.Dept[

                      
                        dataJson.meetingRoom = ({!! json_encode($data['meetingroom']) !!});
                        dataJson.Dept = ({!! json_encode($data['dept']) !!});
                        dataJson.accessories = ({!! json_encode($data['accessories']) !!});
                        dataJson.tags = ({!! json_encode($data['tags']) !!});

                        //dataEvents = dataSchedules

                        renderNavbar()
                        renderDropdownMeetingRooms('room-input', 'room-dropdown')

                        renderDropdownMeetingRooms('selectroom-input', 'selectroom-dropdown')
                        renderDropdownDepts('selectdept-input', 'selectdept-dropdown')

                        renderDropdownMeetingRooms('selectroom-input-edit', 'selectroom-dropdown-edit')
                        renderDropdownDepts('selectdept-input-edit', 'selectdept-dropdown-edit')

                        roomCurrent.roomid = dataJson.meetingRoom[0].mrid
                        document.getElementById("selectroom-input-label").innerHTML = dataJson.meetingRoom[0].mrname
                        document.getElementById("selectroom-input").value = dataJson.meetingRoom[0].mrid

                        renderDropdownTagsMeetings('tag-input', 'tags-list') 
                        renderDropdownTagsMeetings('tag-input-edit', 'tags-list-edit') 

                    }

                    callData()
        ////////// control data //////////


        ////////// control page //////////
                    const navRight = document.querySelectorAll('.nav-right i')
                    navRight.forEach(btn => {
                        btn.addEventListener('click', function (e) {
                            navRight.forEach((i) => {  i.classList.remove('active') });
                            e.target.classList.add('active')

                            if(e.target.id == "pageCalendar") {
                                renderPageCalendar()

                            } else if(e.target.id == "pageHeatMap") {

                                /// js script req in header //
                                renderPageChartXHeatMap({ Objs:dataJson.tags, rooms:dataJson.meetingRoom })
                                //renderPageChartXHeatMap({Dept:dataJson.tags, rooms:dataJson.meetingRoom})
                                /// js script req in header //

                            }
                        })
                    })

                    const resetPageCalendar = () => {
                        roomCurrent.roomid = dataJson.meetingRoom[0].mrid
                        renderSelectAccessories(roomCurrent.roomid)

                        roomCurrent.index = 0
                        document.getElementById("room-input-label").innerHTML = dataJson.meetingRoom[0].mrname
                        document.getElementById("selectroom-input-label").innerHTML = dataJson.meetingRoom[0].mrname
                        document.getElementById("selectroom-input").value = dataJson.meetingRoom[0].mrid
                    }
                    
        ////////// control page //////////


        ////////// func plannerCalendar //////////
                    function containsNumbers(str) {
                        return /\d/.test(str);
                    }

                    const convertTime = (time) => {
                        let timeArr = time.split(":");
                        let timeHour = timeArr[0];
                        let timeMin = timeArr[1];
                        // let timeFormat = timeHour >= 12 ? "PM" : "AM";
                        // timeHour = timeHour % 12 || 12;
                        time = timeHour + ":" + timeMin + " " //+ timeFormat;
                        return time;
                    }

                    const renderBtnEvent = (passData,funcEvent,className,nameBtn) => {

                        let input = document.createElement("input");
                        input.classList.add(className)
                        input.setAttribute("type", "button");
                        input.setAttribute("value", nameBtn);
                        input.addEventListener('click', () => { 
                            funcEvent(passData);
                        });

                        document.querySelector('.event-tool .content-btn').appendChild(input)
                    }


                    const getUser = (classInsert, id, message) => {
                       
                        $.ajax({
            
                            url: pathMain + 'show/?id=' + id + '&content=' + "get_user" ,
                            type: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(user) {
                 
                                // console.log(user)
                                if(user.length > 0 ) {
                                    document.querySelector('.event-tool .planner').classList.remove('skeleton')
                                    //console.log(document.querySelector(classInsert))
                                }

                                return document.querySelector(classInsert).innerHTML =  message + user[0].name + ' ' + user[0].surname
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        });
                    
                    }

                    //////////// permission event ////////////
                    const renderEventTool = (e) => { 
                        // console.log(e)
                        if(document.querySelector('.event-tool .bx-expand-alt')) {
                            document.querySelector('.event-tool .bx-expand-alt').remove()
                        }

                        document.querySelector('.event-tool .room label').innerHTML = e.room
                        document.querySelector('.event-tool .datetime').innerHTML = "<label>" + e.date + "</label>&nbsp;&nbsp;&nbsp;<label>" + e.time + "</label></div>"
                        document.querySelector('.event-tool .planner label').innerHTML =  "By " 
                        document.querySelector('.event-tool .planner').classList.add('skeleton')
                        document.querySelector('.event-tool .dept label').innerHTML = e.dept

                        let i = document.createElement("i");
                        i.classList = 'bx bx-expand-alt';
                        i.addEventListener('click', () => { 
                            activeDialogView(e)
                            console.log('555')
                        });

                        document.querySelector('.event-tool').appendChild(i)
   
                        if(admin) {

                            renderBtnEvent( e, activeDialogEdit, 'event-edit', 'ปรับเปลี่ยน' )
                            renderBtnEvent( { id: e.planid, message: 'ยกเลิกการประชุม : ', objDetail: e.room + ' &nbsp;&nbsp;' + e.date + ' &nbsp;&nbsp;' + e.time , callFunc: 'funcEventCancel' }, actionConfirm, 'event-cancel', 'ยกเลิก' )

                        } else if (new Date(e.fulldateEnd) > new Date() && ( empno == e.planner )) {
 
                            renderBtnEvent( e, activeDialogEdit, 'event-edit', 'ปรับเปลี่ยน' )
                            renderBtnEvent( { id: e.planid, message: 'ยกเลิกการประชุม : ', objDetail: e.room + ' &nbsp;&nbsp;' + e.date + ' &nbsp;&nbsp;' + e.time , callFunc: 'funcEventCancel' }, actionConfirm, 'event-cancel', 'ยกเลิก' )

                          
                        } else {
                            
                            renderBtnEvent( e, activeDialogView, 'event-view', 'ดูรายละเอียด' )
                             
                        } 
                        containsNumbers(e.planner)? 
                            getUser('.event-tool .planner label', e.planner, "By ") 
                        : 
                            document.querySelector('.event-tool .planner label').innerHTML = "By " + e.planner; 
                            document.querySelector('.event-tool .planner').classList.remove('skeleton');
                        

                    }
                    //////////// permission event ////////////

                    const renderEventEdit = (e) => { 
                        // console.log(e)
                        let dataThisEvent = dataEvents[dataEvents.findIndex(obj => { return obj.planid === e.planid })]
                        // console.log(dataThisEvent)

                        let labelDept = ''
                        dataThisEvent.deptid.split(',').forEach((e, index) => {
                            document.querySelector('.selectdept-input-edit.' + e).classList.add('active')
                
                        })

                        document.getElementById("planid").value = dataThisEvent.planid
                        // document.getElementById("appointid").value = dataThisEvent.appointid
                        document.getElementById("planner-edit").value = dataThisEvent.planner
                        document.getElementById("tag-input-edit-label").innerHTML = dataThisEvent.tag
                        document.getElementById("tag-input-edit").value = dataThisEvent.tag

                        document.getElementById("selectroom-input-edit-label").innerHTML = e.room
                        document.getElementById("selectroom-input-edit").value = dataThisEvent.mrid

                        document.getElementById("selectdept-input-edit-label").innerHTML = e.dept
                        document.getElementById("selectdept-input-edit").value = dataThisEvent.deptid

                        document.getElementById("title-edit").value =  dataThisEvent.title
                        document.getElementById("detail-edit").value =  dataThisEvent.detail

                        //document.getElementById("date-edit").value =  //
                         document.getElementById("date-edit").value =  dataThisEvent.startdate.split(' ')[0]
                        

                        document.getElementById("startdate-edit").value = dataThisEvent.startdate.split(' ')[1].slice(0,5)
                        document.getElementById("enddate-edit").value = dataThisEvent.enddate.split(' ')[1].slice(0,5)

                        renderSelectAccessoriesEdit(roomCurrent.roomid, dataThisEvent.planid)

                        dataThisEvent = null;
                    }

                    const renderEventView = (e) => { 
                        let dataThisEvent = dataEvents[dataEvents.findIndex(obj => { return obj.planid === e.planid })]
                        let fDate = dataThisEvent.startdate.split(' ')[0].split('-');

                        // console.log(e)
                        // console.log(dataThisEvent)

                        let viewData = {
                            "ห้องประชุม" : e.room ,
                            "ส่วนงาน" : e.dept ,
                            "ผู้นัดหมาย" : '',
                            "แท็ก" : '#' + dataThisEvent.tag,
                            "หัวข้อการประชุม" : dataThisEvent.title ,
                            "วันที่" : fDate[2] + ' / ' + fDate[1] + ' / ' + fDate[0] + '&nbsp;&nbsp; | &nbsp;&nbsp;' + dataThisEvent.startdate.split(' ')[1].slice(0,5) + ' - ' + dataThisEvent.enddate.split(' ')[1].slice(0,5),
                            "รายละเอียดการประชุม" : dataThisEvent.detail? dataThisEvent.detail : '... '
                            // "ระยะเวลา" : dataThisEvent.startdate.split(' ')[1].slice(0,5) + ' - ' + dataThisEvent.enddate.split(' ')[1].slice(0,5),
                         }

                        let content = ''
                        for (const [key, value] of Object.entries(viewData)) {
                            // console.log(key + ' ' + value);
                           key == 'รายละเอียดการประชุม'?
                                content += '<div class="detail-view">\
                                                <div class="title">' + key + '</div>\
                                                <div class="field">' + value + '</div>\
                                            </div>'
                            :
                                key == 'ผู้นัดหมาย'?
                                    content += '<div class="detail-view">\
                                                    <div class="title">' + key + '&nbsp;:&nbsp;<div class="field plannerName">' + value + '</div></div>\
                                                </div>'
                                :
                                                
                                    key == 'แท็ก'?
                                        content += '<div class="detail-view">\
                                                        <div class="title">' + key + '&nbsp;:&nbsp;<div class="field tagEvent">' + value + '</div></div>\
                                                    </div>'
                                    :
                                                    
                                        content += '<div class="detail-view">\
                                                        <div class="title">' + key + '&nbsp;:&nbsp;<div class="field">' + value + '</div></div>\
                                                    </div>'
                        }


                       

                        document.querySelector('.data-view-event').innerHTML = content;
                        document.querySelector(".content-views").style = '--color-dialog-view: ' + e.color
                        document.querySelector(".content-views .tagEvent").style = 'color: ' + e.color

                        containsNumbers(e.planner)?  getUser('.field.plannerName', dataThisEvent.planner, '') : document.querySelector('.field.plannerName').innerHTML = e.planner

                        renderSelectAccessoriesView(roomCurrent.roomid, dataThisEvent.planid)
  
                        dataThisEvent = null;
                        content = null;
                    }

                    const ePositionXY = ( xdif , ydif , Afterxdif , Afterydif ) => {
                        document.querySelector(".event-tool").style.top = ( event.pageY-ydif ) + "px"
                        document.querySelector(".event-tool").style.left = ( event.clientX-xdif ) + "px"
                        document.querySelector(".event-tool-after").style.top = ( event.pageY-Afterydif ) + "px"
                        document.querySelector(".event-tool-after").style.left = ( event.clientX-Afterxdif) + "px"
                    }

                    const printMousePos = (event) => {
                        let box = document.querySelector('.calendar');
                        
                        if(event.pageY < (box.offsetHeight-45)/2 && event.clientX < box.offsetWidth/2 ) {
                            //console.log('top left')
                            ePositionXY(20, -21, 0, -14)

                        } else if(event.pageY <(box.offsetHeight-45)/2 && event.clientX > box.offsetWidth/2 ) {
                            //console.log('top rigth')
                            ePositionXY(190, -21, 0, -14)
                        
                        } else if(event.pageY > (box.offsetHeight-45)/2 && event.clientX < box.offsetWidth/2 ) {
                            //console.log('buttom left')
                            ePositionXY(20, 165, 0, 19)

                        } else if(event.pageY > (box.offsetHeight-45)/2 && event.clientX > box.offsetWidth/2 ) {
                           //('buttom rigth')
                            ePositionXY(190, 165, 0, 19)
                         
                        }

                        document.querySelector(".event-tool").style.display = "flex"
                        document.querySelector(".event-tool-after").style.display = "flex"

                        event.pageY >(box.offsetHeight-45)/2? document.querySelector(".event-tool-after").style.transform = "rotate(3.142rad)" : document.querySelector(".event-tool-after").style.transform = "rotate(0)"

                    }

                    const actionConfirmFunc = (e) => {
 
                        document.querySelector(".backdrop-alert").style.display = "flex"
                        document.querySelector(".backdrop-alert").innerHTML =  "<div class='alert-message'>\
                                                                                    <div class='header'><label>!</label> <i class='bx bx-x' onclick='actionConfirmClose()'></i></div>\
                                                                                    <div class='detail'>\
                                                                                        กด 'ยืนยัน' เพื่อดำเนินการ " + ( e.message? e.message : "" ) + " " + (  e.objDetail? e.objDetail : "" ) + "\
                                                                                    </div>\
                                                                                    <div class='content-btn'>\
                                                                                        <input type='button' value='ยืนยัน' class='event-confirm'> </input>\
                                                                                    </div>\
                                                                                </div>"

                        document.querySelector(".alert-message").classList.add('boom')
                        setTimeout(function() {
                            try {
                                document.querySelector(".alert-message").classList.remove('boom')

                            } catch {}

                        }, 300)

                        var inputElementEventConfirm = document.querySelector(".backdrop-alert .content-btn .event-confirm");
                        inputElementEventConfirm.addEventListener('click', () => {
                            actionConfirmClose()
                            e.callFunc(e)

                        });     

                    }

                    const callDelDataDb = (e) => {
                        console.log(e.data)
                         $.ajax({
                            url: pathMain + e.data + '+' + 'deltag',
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                alertStatus('แจ้งเตือน', 'ยกเลิกแล้ว', 'success')
                                document.getElementById("ref-tag-" + e.data ).remove()
                            },
                            error: function(xhr, status, error) {
                                //alertStatus('แจ้งเตือน', 'ยกเลิกการนัดหมายไม่สำเร็จ', 'error')
                            }
        
                        });
                    }

                    const deleteDataConfirm = (e) => 
                    {
                      
                        actionConfirmFunc( { data:e.id, message: 'ลบหรือปิด : ', objDetail: '# แท็ก : &nbsp;' + e.id , callFunc: callDelDataDb })
        
                    }

                    const printMousePosChangeTagColor = (event) => {
                         
                        let EObj = event.id.split('-')
                        event = document.getElementById(event.id)
                        let rect = event.getBoundingClientRect();
 
                        let x = rect.left + window.scrollX;
                        let y = rect.top + window.scrollY;
                        
                 
                        document.querySelector(".tag-color-change").style.top = ( y-85 ) + "px"
                        document.querySelector(".tag-color-change").style.left = ( x-25 ) + "px"
                        document.querySelector(".tag-color-change-after").style.top = ( y-10 ) + "px"
                        document.querySelector(".tag-color-change-after").style.left = ( x+5 ) + "px"

                        document.getElementById('tagname').value = EObj[1]
                        document.getElementById('favcolor').value = EObj[2]
                        document.querySelector(".tag-color-change").style.display = "flex"
                        document.querySelector(".tag-color-change-after").style.display = "flex"

                        //manage-elem  bxs-brush
                    }

                    const addListenerEvens = () => {

                        const events = document.querySelectorAll(".event-day");

                        events.forEach((event) => {
                            event.addEventListener("click", (e) => {

                                if( document.querySelector('.event-tool .content-btn .event-edit')) {
                                    document.querySelector('.event-tool .content-btn .event-edit').remove();
                                    document.querySelector('.event-tool .content-btn .event-cancel').remove();

                                } else if(document.querySelector('.event-tool .content-btn .event-view')) {
                                    document.querySelector('.event-tool .content-btn .event-view').remove();

                                }
                            
                                printMousePos(e)

                                let dataTool1 = e.target.id.split('//')
                                let dataTool2 = e.target.classList.value.split(' ')

                                let labelDept = ''
                                dataTool2[1].split(',').forEach((e, index) => {

                                    if(index != 0) {
                                        labelDept += ' , '
                                    }

                                    labelDept += dataJson.Dept[dataJson.Dept.findIndex(obj => { return obj.id == e })].name

                                    
                                })

                                renderEventTool(
                                    {
                                        planid: dataTool2[3],
                                        room: dataJson.meetingRoom[dataJson.meetingRoom.findIndex(obj => { return obj.mrid === dataTool2[2] })].mrname,
                                        date: new Date(dataTool1[1]).getDate() + '/' + String(new Date(dataTool1[1]).getMonth()+1).padStart(2, '0') + '/' + new Date(dataTool1[1]).getFullYear(),
                                        time: convertTime(dataTool1[1].split(' ')[4]) + ' - ' + convertTime(dataTool1[2].split(' ')[4]),
                                        planner: dataTool1[3],
                                        dept:  labelDept,
                                        color: dataJson.tags[dataJson.tags.findIndex(obj => { return obj.name === dataTool2[4] })].color,
                                        fulldateEnd:  new Date(dataTool1[2])
                                    }
                                )
                            });
                        })
                    }

                    //render event day
                    let main_month;
                    let main_year;

                    const renderEventsPlanning = (roomId) => {

                        document.querySelector('.room-status').classList.remove('active')

                        try {
                            document.querySelectorAll(".event-day." + roomCurrent.roomid).forEach((eventdept) => {
                                eventdept.remove();

                            })
                
                        } catch (error) {
                            console.log(error);
                        }

                        $.ajax({
            
                            url: pathMain + 'show/?room=' + roomId + '&month=' + main_month + '&year=' + main_year + '&content=' + "schedulesOfRoomXMonth" ,
                            type: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(events) {
                                dataEvents = events

                                if(events) {
                                    events.forEach((e, index) => {  
                                        if(e.mrid == roomId) {

                                            if( dateRangeOverlaps(new Date(e.startdate), new Date(e.enddate), new Date(), new Date()) ) {
                                                document.querySelector('.room-status').classList.add('active')

                                            }
                                            
        
                                            if(document.getElementById(new Date(e.startdate.split(' ')[0] + ' 00:00:00'))) {
                                            
                                                let spanEvent = document.createElement('span')
                                                spanEvent.classList = 'event-day ' + e.deptid + ' ' + e.mrid + ' ' + e.planid + ' ' + e.tag + ( new Date(e.enddate) < new Date( )? ' event-end' : '' ) 
                                                if(document.querySelector(".radio-dept-" + e.tag)) {
                                                    spanEvent.style = "--eventSize: 1;--color-event:var(--color-"+ e.tag + ");" + ( document.querySelector(".radio-dept-" + e.tag).classList.contains('disable')? "display: none;" : "" )+ ");"

                                                } else {
                                                    //console.log(".radio-dept-" + e.tag)
                                                    spanEvent.style = "--eventSize: 1;--color-event:var(--color-"+ e.tag + ");" + '' + ");"

                                                }
                                                spanEvent.title = e.title;
                                                spanEvent.textContent =  convertTime(e.startdate.split(' ')[1])  + " - " + convertTime(e.enddate.split(' ')[1]) + " | " + e.title;
                                                // spanEvent.id = "event-day//" + new Date(new Date(e.startdate.split(' ')[0] + ' 00:00:00'))
                                                spanEvent.id = "event-day//" + new Date(e.startdate) + "//" + new Date(e.enddate) + "//" + e.planner

                                                document.getElementById(new Date(e.startdate.split(' ')[0] + ' 00:00:00')).appendChild(spanEvent) 

                                            }
                                        }
                                    });

                                    addListenerEvens()

                                }
                                
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                            
                        });

                                                            
                        // if(dataEvents) {
                        //     dataEvents.forEach((e, index) => {  
                        //         if(e.mrid == roomId) {

                        //             if( dateRangeOverlaps(new Date(e.startdate), new Date(e.enddate), new Date(), new Date()) ) {
                        //                 document.querySelector('.room-status').classList.add('active')

                        //             }
                                    
 
                        //             if(document.getElementById(new Date(e.startdate.split(' ')[0] + ' 00:00:00'))) {
                                    
                        //                 let spanEvent = document.createElement('span')
                        //                 spanEvent.classList = 'event-day ' + e.deptid + ' ' + e.mrid + ' ' + e.planid + ' ' + e.tag + ( new Date(e.enddate) < new Date( )? ' event-end' : '' ) 
                        //                 if(document.querySelector(".radio-dept-" + e.tag)) {
                        //                     spanEvent.style = "--eventSize: 1;--color-event:var(--color-"+ e.tag + ");" + ( document.querySelector(".radio-dept-" + e.tag).classList.contains('disable')? "display: none;" : "" )+ ");"

                        //                 } else {
                        //                     //console.log(".radio-dept-" + e.tag)
                        //                     spanEvent.style = "--eventSize: 1;--color-event:var(--color-"+ e.tag + ");" + '' + ");"

                        //                 }
                        //                 spanEvent.title = e.title;
                        //                 spanEvent.textContent =  convertTime(e.startdate.split(' ')[1])  + " - " + convertTime(e.enddate.split(' ')[1]) + " | " + e.title;
                        //                 // spanEvent.id = "event-day//" + new Date(new Date(e.startdate.split(' ')[0] + ' 00:00:00'))
                        //                 spanEvent.id = "event-day//" + new Date(e.startdate) + "//" + new Date(e.enddate) + "//" + e.planner

                        //                 document.getElementById(new Date(e.startdate.split(' ')[0] + ' 00:00:00')).appendChild(spanEvent) 

                        //             }
                        //         }
                        //     });
                        //     addListenerEvens()

                        // }
            
                    }

                    const renderEventsPlanningReset = () => {
                        document.querySelectorAll(".event-day." + roomCurrent.roomid).forEach((eventdept) => {
                            eventdept.remove();

                        })
                    }

                    const actionEventCancel = (e) => {

                        if(e) {

                            dataEvents = dataEvents.filter((event) => ( event.planid != e.id) )
                            $.ajax({
                                        url: pathMain + e.id + '+' + 'delevent',
                                        type: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        success: function(response) {
                                             alertStatus('แจ้งเตือน', 'ยกเลิกการนัดหมายแล้ว', 'success')
                                        },
                                        error: function(xhr, status, error) {
                                            //alertStatus('แจ้งเตือน', 'ยกเลิกการนัดหมายไม่สำเร็จ', 'error')
                                        }

                                    });
                        }

                        renderEventsPlanning(roomCurrent.roomid)
                    }

                    const actionConfirm = (e) => {

                        // document.querySelector('.event-tool .content-btn .event-edit').remove();
                        // document.querySelector('.event-tool .content-btn .event-cancel').remove();

                        document.querySelector(".backdrop-alert").style.display = "flex"
                        document.querySelector(".backdrop-alert").innerHTML =  "<div class='alert-message'>\
                                                                                    <div class='header'><label>!</label> <i class='bx bx-x' onclick='actionConfirmClose()'></i></div>\
                                                                                    <div class='detail'>\
                                                                                        กด 'ยืนยัน' เพื่อดำเนินการ " + ( e.message? e.message : "" ) + " " + (  e.objDetail? e.objDetail : "" ) + "\
                                                                                    </div>\
                                                                                    <div class='content-btn'>\
                                                                                        <input type='button' value='ยืนยัน' class='event-confirm'> </input>\
                                                                                    </div>\
                                                                                </div>"

                        var inputElementEventConfirm = document.querySelector(".backdrop-alert .content-btn .event-confirm");
                        inputElementEventConfirm.addEventListener('click', () => {
                            if(e.callFunc &&  e.callFunc == "funcEventCancel") {
                                actionEventCancel({id: e.id? e.id : ""})
                            }

                            actionConfirmClose()
                        });     
                        
                                                                    
                    }

                    const actionConfirmClose = () => {
                        document.querySelector(".backdrop-alert").style.display = "none"

                    }
                    
                    const nextRoom = () => {
                        
                        
                        if(roomCurrent.index + 1 < dataJson.meetingRoom.length) { 

                            renderEventsPlanningReset(roomCurrent.roomid)

                            roomCurrent.roomid =  dataJson.meetingRoom[roomCurrent.index + 1].mrid
                            renderSelectAccessories(roomCurrent.roomid)

                            document.getElementById("room-input-label").innerHTML = dataJson.meetingRoom[roomCurrent.index + 1].mrname
                            document.getElementById("selectroom-input-label").innerHTML = dataJson.meetingRoom[roomCurrent.index + 1].mrname
                            document.getElementById("selectroom-input").value = dataJson.meetingRoom[roomCurrent.index + 1].mrid

                            roomCurrent.index ++

                            renderEventsPlanning(roomCurrent.roomid)
                        }
                    }

                    const prevRoom = () => {
                    
                        if(roomCurrent.index - 1 >= 0) {

                            renderEventsPlanningReset(roomCurrent.roomid)

                            roomCurrent.roomid =  dataJson.meetingRoom[roomCurrent.index - 1].mrid
                            renderSelectAccessories(roomCurrent.roomid)

                            document.getElementById("room-input-label").innerHTML = dataJson.meetingRoom[roomCurrent.index - 1].mrname
                            document.getElementById("selectroom-input-label").innerHTML = dataJson.meetingRoom[roomCurrent.index - 1].mrname
                            document.getElementById("selectroom-input").value = dataJson.meetingRoom[roomCurrent.index - 1].mrid

                            roomCurrent.index --

                            renderEventsPlanning(roomCurrent.roomid)
                        }
                    }

                    const renderPageCalendar = ( ) => {

                        pageActive = {
                            "pageCalendar" : true,
                            "pageHeatMap" : false
                        }

                        document.querySelector(".meeting-room").classList.add('active') 
                        setTimeout(function() {
                            document.querySelector(".room-dropdown").classList.add('enable')
                        }, 400)

                        recheck();

                        document.querySelector(".content").innerHTML = ""
                        document.querySelector(".content").innerHTML = "<div class='container-calendar'>\
                                                                            <div class='calendar'>\
                                                                                <div class='head-calendar'>\
                                                                                    <div class='nav-left'>\
                                                                                        <button class='today-btn-a'>Today</button>\
                                                                                        <i class='bx bx-chevron-left prev'></i>\
                                                                                        <i class='bx bx-chevron-right next'></i>\
                                                                                        <div class='date'>december 2015</div>"
                                                                                            +
                                                                                                (userAcc == 1 ? "<i class='bx bxs-purchase-tag btn-manage-tag' title='My tags' onClick='activeDialogTag()'></i>" :  '')
                                                                                            +
                                                                                    "</div>\
                                                                                </div>\
                                                                                <div class='weekdays'>\
                                                                                    <div>Sun</div>\
                                                                                    <div>Mon</div>\
                                                                                    <div>Tue</div>\
                                                                                    <div>Wed</div>\
                                                                                    <div>Thu</div>\
                                                                                    <div>Fri</div>\
                                                                                    <div>Sat</div>\
                                                                                </div>\
                                                                                <div class='days'> </div>\
                                                                                <div class='events'> </div>\
                                                                            </div>\
                                                                        </div>";
                                                                        

                        const calendar = document.querySelector(".calendar"),
                        date = document.querySelector(".date"),
                        daysContainer = document.querySelector(".days"),
                        prev = document.querySelector(".prev"),
                        next = document.querySelector(".next"),
                        todayBtn = document.querySelector(".today-btn-a");

                        let today = new Date();
                        let activeDay;
                        let month = today.getMonth();
                        let year = today.getFullYear();

                        const months = [
                            "January",
                            "February",
                            "March",
                            "April",
                            "May",
                            "June",
                            "July",
                            "August",
                            "September",
                            "October",
                            "November",
                            "December",
                        ];

                        let selecting, start, end;

                        function initCalendar() {
                            const firstDay = new Date(year, month, 1);
                            const lastDay = new Date(year, month + 1, 0);
                            const prevLastDay = new Date(year, month, 0);
                            const prevDays = prevLastDay.getDate();
                            const lastDate = lastDay.getDate();
                            const day = firstDay.getDay();
                            const nextDays = 7 - lastDay.getDay() - 1;

                            daysContainer.innerHTML = "";
                            selecting = false;
                            

                            date.innerHTML = months[month] + " " + year;
                            date.title = (month+1) + "/" + year;

                            let element_day;

                            for (let x = day; x > 0; x--) {
                                element_day = document.createElement('div');
                                element_day.classList += "day prev-date ";
                                element_day.textContent = prevDays - x + 1;
                            
                                daysContainer.appendChild(element_day);
                            }

                            for (let i = 1; i <= lastDate; i++) {
                                element_day = document.createElement('div');

                                if (
                                    i === new Date().getDate() &&
                                    year === new Date().getFullYear() &&
                                    month === new Date().getMonth()
                                ) {
                                    activeDay = i;


                                    element_day.classList += "day today active ";
                                    element_day.innerHTML = '<div class="todayNumber">'+ i +'</div>';
                                    element_day.name = i + day;
                                    element_day.id = new Date(year, month, i)

                                    daysContainer.appendChild(element_day);

                                } else {
                            
                                    element_day.classList += "day " + ( (new Date(year, month, i) < new Date()) && !admin ? ' old' : '' );
                                    element_day.textContent = i;
                                    element_day.name = i + day;
                                    element_day.id = new Date(year, month, i)

                                    daysContainer.appendChild(element_day);
            
                                }
                            }

                            for (let j = 1; j <= nextDays; j++) {
                                element_day = document.createElement('div');
                                element_day.classList += "day next-date ";
                                element_day.textContent = j;
                                element_day.id = new Date(year, month, j)
                            
                                daysContainer.appendChild(element_day)
                            }
                            
                            
                            if(userAcc) {
                                 addListner();
                            }
                            
                           

                            if(roomCurrent.roomid != "") {
                                // console.log("roomCurrent.roomid : "+ roomCurrent.roomid)
                                renderEventsPlanningReset()
                                main_year = year
                                main_month = month
                                renderEventsPlanning(roomCurrent.roomid);
                                // renderSelectAccessories(roomCurrent.roomid)

                            }

                        }

                        function prevMonth() {
                            month--;
                            if (month < 0) {
                                month = 11;
                                year--;
                            }
                            
                            start = undefined;
                            end = undefined;
                            initCalendar();
                        }

                        function nextMonth() {
                            month++;
                            if (month > 11) {
                                month = 0;
                                year++;
                            }

                            start = undefined;
                            end = undefined;
                            initCalendar();
                        }

                        prev.addEventListener("click", prevMonth);
                        next.addEventListener("click", nextMonth);

                        initCalendar();

                        let element_fclick;
                        let arr = document.querySelectorAll('div .day.selected');

                        const beginSelection = (i) => {
                            selecting = true;
                            start = i;

                            updateSelection(i);
                        };

                        const endSelection = (i = end) => {
                            updateSelection(i);
                            selecting = false;
                            arr = document.querySelectorAll('div .day.selected');                
                            document.querySelectorAll(".day").forEach((day) => {
                                        day.classList.remove("last-selected");
                                        day.classList.remove("first-selected");
                            });

                            if(!(arr.length <= 1)) {
                                arr[0].classList.add('first-selected');
                                arr[arr.length - 1].classList.add('last-selected');
                            }
                        };


                        const updateSelection = i => {
                            
                            if (selecting)
                                end = i;
                            [...document.querySelectorAll('div .day')].forEach((div, i) => {
                                div.classList.toggle('selected', i >= start && i <= end || i >= end && i <= start)
                            });

                        };

                        function addListner() {
                            
                            const days = document.querySelectorAll(".day");
                            selecting = false;
                            start = undefined;
                            end = undefined;

                            days.forEach((day) => {
                                day.addEventListener("mousedown", (e) => {
            
                                    selecting = false;
                                    activeDay = Number(e.target.innerHTML);
                                    
                                    days.forEach((day) => {
                                        day.classList.remove("active");
                                        day.classList.remove("last-selected");
                                        day.classList.remove("first-selected");
                                    });

                                    if (e.target.classList.contains("prev-date")) {
                                        prevMonth();
                                        setTimeout(() => {
                                        const days = document.querySelectorAll(".day");
                                        days.forEach((day) => {
                                            if (
                                                !day.classList.contains("prev-date") &&
                                                day.innerHTML === e.target.innerHTML
                                            ) {
                                                day.classList.add("active");
                                            }
                                        });
                                        }, 100);

                                    } else if (e.target.classList.contains("next-date")) {
                                        nextMonth();

                                        setTimeout(() => {
                                            const days = document.querySelectorAll(".day");
                                            days.forEach((day) => {
                                                if (
                                                    !day.classList.contains("next-date") &&
                                                    day.innerHTML === e.target.innerHTML
                                                ) {
                                                    day.classList.add("active");
                                                }
                                            });

                                        }, 100);

                                    } else {
                                        if(e.target.classList.contains("day")) {
                                            e.target.classList.add("active");
                                            beginSelection(e.target.name - 1)
                                        }

                                    }
                                });

                                day.addEventListener("mousemove", (e) => {
                                    if (selecting && !( e.target.classList.contains("prev-date") || e.target.classList.contains("next-date") ) ) {
                                        updateSelection(e.target.name - 1);
                                    }                
                                });

                                day.addEventListener("mouseup", (e) => {
                                    if (selecting && !( e.target.classList.contains("prev-date") || e.target.classList.contains("next-date") ) ) {
                                        endSelection(e.target.name - 1);

                                        
                                        
                                        let date = e.target.getAttribute("id").split(" ")
                                        document.querySelector('.event-dialog').classList.add('active');
                                        document.querySelectorAll('.selectdept-input.active').forEach((e) => {
                                            e.classList.remove('active');

                                        })
                                        document.querySelector('.event').name = e.target.getAttribute("id")

                                        if(document.querySelectorAll('div .day.selected').length == 1) {
                                            document.querySelector('.event .text-startdate').innerHTML = date[2] + " " + date[1] + " " + date[3]  

                                        } else {
                                            let datef = document.querySelector('.first-selected').getAttribute("id").split(" ")
                                            let datel = document.querySelector('.last-selected').getAttribute("id").split(" ")
                                            document.querySelector('.event .text-startdate').innerHTML = datef[2] + " " + datef[1] + " " + datef[3] + " &nbsp; - &nbsp; " + datel[2] + " " + datel[1] + " " + datel[3]
                                            document.getElementById('datef').value = document.querySelector('.first-selected').getAttribute("id")

                                        }

                                        document.getElementById('date').value = e.target.getAttribute("id")
                                        document.getElementById("selectroom-input").value = roomCurrent.roomid

                                        setTimeout(function() {
                                            document.querySelector('.event').classList.add('active');

                                        }, 100)

                                        setTimeout(function() {
                                            document.querySelector('.selectroom-dropdown').classList.add('enable');
                                            document.querySelector('.selectdept-dropdown').classList.add('enable');

                                        },500)
                                    
                                    }
                                    

                                });

                            });
                            
                        }

                        todayBtn.addEventListener("click", () => {
                            today = new Date();
                            month = today.getMonth();
                            year = today.getFullYear();
                            initCalendar();
                        });

                        // function gotoDate() {
                        //     console.log("here");
                        //     const dateArr = dateInput.value.split("/");
                        //     if (dateArr.length === 2) {
                        //         if (dateArr[0] > 0 && dateArr[0] < 13 && dateArr[1].length === 4) {
                        //         month = dateArr[0] - 1;
                        //         year = dateArr[1];
                        //         initCalendar();
                        //         return;
                        //         }
                        //     }
                        //     alert("Invalid Date");
                        // }

                        function convertTime(time) {
                            let timeArr = time.split(":");
                            let timeHour = timeArr[0];
                            let timeMin = timeArr[1];
                            let timeFormat = timeHour >= 12 ? "PM" : "AM";
                            timeHour = timeHour % 12 || 12;
                            time = timeHour + ":" + timeMin + " " + timeFormat;
                            return time;
                        }

                        setTimeout(() => {
                            resetPageCalendar()
                            renderEventsPlanningReset()
                            // console.log("roomCurrent.roomid : "+ roomCurrent.roomid)
                            main_year = year
                            main_month = month
                            renderEventsPlanning(roomCurrent.roomid);
                            // renderSelectAccessories(roomCurrent.roomid)

                        }, 100);

                        document.addEventListener('mouseup', () => endSelection());
                    };
        ////////// func plannerCalendar //////////


         // renderPageHeatMap()
        renderPageCalendar()
 
        ////////// func plannerCalendar //////////
                    const activeDialogTag = () => {
                        renderMyTag()

                        document.querySelector('.backdrop-manage-tag').classList.add('active')
                        
                        setTimeout(() => {
                            document.querySelector('.dialog-manage-tag').classList.add('active')
                            
                        }, 100);

                        

                       
                    }

                    const InactiveDialogTag = () => {
                        
                        document.querySelector('.dialog-manage-tag').classList.remove('active')
                        document.getElementById('box-create-tag').reset()

                        setTimeout(() => {
                            document.querySelector('.backdrop-manage-tag').classList.remove('active')
                        }, 100);

                        document.querySelector(".tag-color-change").style.display = "none"
                        document.querySelector(".tag-color-change-after").style.display = "none"
                    }

                    const inactiveDialog = () => {
                        const days = document.querySelectorAll(".day");

                        days.forEach((day) => {
                            day.classList.remove("active");
                            day.classList.remove("selected");
                            day.classList.remove("last-selected");
                            day.classList.remove("first-selected");
                        });

                        document.querySelector('.event').classList.remove('active');
                        document.getElementById("form").reset()
                        document.getElementById('selectdept-input-label').innerHTML= "เลือกส่วนงาน"
                        document.getElementById('tag-input-label').innerHTML= ""
                        document.getElementById('planner').classList.remove('active')
                        document.getElementById('title').classList.remove('active')
                        document.getElementById('deptid').classList.remove('active')

                        setTimeout(() => {
                            document.querySelector('.event-dialog').classList.remove('active')
                            document.querySelector('.selectroom-dropdown').classList.remove('enable');
                            document.querySelector('.selectdept-dropdown').classList.remove('enable');

                        }, 100);

                    }

                    const inactiveDialogEdit = () => {
                        let eEdit = document.querySelector('.content-edit')
                        eEdit.classList.remove('active'); 
                  
                        setTimeout(() => {
                        
                            // document.querySelector('.content-edit-dialogMove').classList.remove('active')
                            document.querySelector('.selectroom-dropdown-edit').classList.remove('enable');
                            document.querySelector('.selectdept-dropdown-edit').classList.remove('enable');

                        }, 100);

                              
                        setTimeout(() => {
                            eEdit.style.top = '3%'
                       
                            if(document.querySelector('.calendar').offsetWidth > 450) {
                                eEdit.style.left = '35%'
                            }

                        }, 500);
                    }

                    const activeDialogEdit = (e) => {
                        
 
                        document.querySelectorAll('.selectdept-input-edit.active').forEach((e) => {
                            e.classList.remove('active');

                        })

                        renderEventEdit(e)

                        document.querySelector('.event-tool .content-btn .event-edit').remove();
                        document.querySelector('.event-tool .content-btn .event-cancel').remove();

                        
                        // document.querySelector('.content-edit-dialogMove').classList.add('active');
                        setTimeout(function() {
                            let e = document.querySelector('.content-edit')
                            e.classList.add('active');
                            

                        }, 100)

                        setTimeout(function() {
                            document.querySelector('.selectroom-dropdown-edit').classList.add('enable');
                            document.querySelector('.selectdept-dropdown-edit').classList.add('enable');

                        }, 500)
                    }

                    const inactiveDialogView = () => {
                        document.querySelector('.content-views').classList.remove('active'); 
                   

                        setTimeout(() => {
                            document.querySelector('.content-views-dialogMove').classList.remove('active') 
                            document.querySelector(".content-views").style.top = '100px'
                            document.querySelector(".content-views").style.left = 'unset'

                         }, 100);

                    }

                    const activeDialogView = (e) => {
                         
                        renderEventView(e)

                        try {
                            document.querySelector('.event-tool .content-btn .event-view').remove();

                        } catch {

                        }
                        
                        document.querySelector('.content-views-dialogMove').classList.add('active');
                        setTimeout(function() {
                            document.querySelector('.content-views').classList.add('active');

                        }, 100)

                    }

                    
                    const dragElement = (elmnt, elmntClick) => {
                        var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;

                        const elementDrag = (e) => {

                            pos1 = pos3 - e.clientX;
                            pos2 = pos4 - e.clientY;
                            pos3 = e.clientX;
                            pos4 = e.clientY;
                            elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
                            elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";

                        }

                        const closeDragElement = () => {

                            document.onmouseup = null;
                            document.onmousemove = null;

                        }

                        const dragMouseDown = (e) => {
        
                            pos3 = e.clientX;
                            pos4 = e.clientY;
                            document.onmouseup = closeDragElement;
                            document.onmousemove = elementDrag;

                        }
                        
                        if(elmntClick != '') {
                            elmntClick.onmousedown = dragMouseDown;

                        } else {
                            elmnt.onmousedown = dragMouseDown;

                        }
                        
                    }

                    dragElement(document.querySelector(".content-views"), '');
                    dragElement(document.querySelector(".content-edit"), document.querySelector(".content-edit .header"));

                    document.querySelectorAll('div').forEach(ac => {
                        ac.addEventListener('click', function (e) { 
                            // manage-elem bxs-brush  tag-color-change-input
                             if(!(e.target.classList.contains('bxs-brush')) && !(e.target.classList.contains('tag-color-change')) && !(e.target.classList.contains('tag-color-change-input'))) {
                                document.querySelector(".tag-color-change").style.display = "none"
                                document.querySelector(".tag-color-change-after").style.display = "none"
                            }

                            if(!(e.target.classList.contains('room') || e.target.classList.contains('room-dropdown'))) {
                                document.querySelector(".room-dropdown").classList.remove("active")
                                // console.log(e.target)
                            } 

                            if( !e.target.classList.contains('event-day') ) {
                                document.querySelector(".event-tool").style.display = 'none'
                                document.querySelector(".event-tool-after").style.display = 'none'
                            } 

                            if( e.target.classList.contains('backdrop-alert') && document.querySelector(".content-login").classList.contains('active') ) {
                                document.querySelector('.content-login').classList.remove('active')
                                document.querySelector('.backdrop-alert').style.display = 'none'
                                document.getElementById("content-login").reset();
                            }

                            if(pageActive.pageCalendar) {

                                if(!(e.target.classList.contains('day') || e.target.classList.contains('days'))) {

                                    if( !document.querySelector(".event-dialog").classList.contains('active') ) {
                                        const days = document.querySelectorAll(".day");

                                        days.forEach((day) => {
                                            day.classList.remove("active");
                                            day.classList.remove("selected");
                                            day.classList.remove("last-selected");
                                            day.classList.remove("first-selected");
                                        });
                                    }

                                } 
                        
                                if(!(e.target.classList.contains('selectroom') || e.target.classList.contains('selectroom-dropdown'))) {
                                    document.querySelector(".selectroom-dropdown").classList.remove("active")

                                }
                                
                                
                                if(!(e.target.classList.contains('selectdept') || e.target.classList.contains('selectdept-dropdown'))) {
                                    document.querySelector(".selectdept-dropdown").classList.remove("active")

                                } 

                                if( e.target.classList.contains('event-dialog')) {
                                
                                    inactiveDialog()
                                }

                                if( e.target.classList.contains('backdrop-manage-tag')) {
                                
                                    InactiveDialogTag()
                                }


                                if(!(e.target.classList.contains('selectroom-edit') || e.target.classList.contains('selectroom-dropdown-edit'))) {
                                    document.querySelector(".selectroom-dropdown-edit").classList.remove("active")

                                }
                                
                                if(!(e.target.classList.contains('selectdept-edit') || e.target.classList.contains('selectdept-dropdown-edit'))) {
                                    document.querySelector(".selectdept-dropdown-edit").classList.remove("active")

                                } 

                                // if( e.target.classList.contains('content-edit-dialogMove')) {
                                //     inactiveDialogEdit()
                                // }

                            } else if(pageActive.pageHeatMap) {

                                 if(!(e.target.classList.contains('chartroom') || e.target.classList.contains('chart-room-dropdown'))) {
                                    try {
                                        document.querySelector(".chart-room-dropdown").classList.remove("active")

                                    }catch {
                                    
                                    }
                                } 
                            }
                        })
                    }) 

                    const makeCodeId = (length) => {
                        let result = '';
                        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                        const charactersLength = characters.length;
                        let counter = 0;

                        while (counter < length) {
                            result += characters.charAt(Math.floor(Math.random() * charactersLength));
                            counter += 1;
                        }

                        return result;
                    }

                    const generate = (idN, deptName) => {
                        let currentDate = new Date()
                        return idN + "-" + makeCodeId(5) + "-" + ( str00(currentDate.getDate(),2)  + str00((currentDate.getMonth()+1),2) + currentDate.getFullYear() )  + "-" + 'smr'
                    }

                    const alertStatus = (title, message, status) => {
                        document.querySelector(".alert-massage-func").classList.add('active')
                        document.querySelector(".alert-massage-func .title-alert").innerHTML = title
                        document.querySelector(".alert-massage-func .content-alert").innerHTML = message

                        setTimeout(function() {
                            document.querySelector(".alert-massage-func").classList.remove('active')

                        }, 3000)
                    }

                    const addPlanEvent = (obj, acclist) => {
                        
                        // console.log(obj)
                        // console.log(acclist)
                        // return

                        obj.forEach((e,index) => { 

                            if( dateRangeOverlaps(new Date(formatDatetime(new Date(e.date), e.startdate)), new Date(formatDatetime(new Date(e.date), e.enddate)), new Date(), new Date()) ) {
                                document.querySelector('.room-status').classList.add('active')
                                // console.log("active status")
                            } else {
                                // console.log("inactive status")
                            }


                            let spanEvent = document.createElement('span')
                            spanEvent.classList = 'event-day ' + e.deptid + ' ' + e.mrid + ' ' + e.planid + ' ' + e.tag +  ( new Date(formatDatetime(new Date(e.date), e.enddate)) < new Date( )? ' event-end' : '' )
                            spanEvent.style = "--eventSize: 1;--color-event:var(--color-"+ e.tag + ");" + ( document.querySelector(".radio-dept-" + e.tag).classList.contains('disable')? "display: none;" : "" ) +");"
                            spanEvent.title = e.title;
                            spanEvent.textContent = convertTime(e.startdate) + " - " + convertTime(e.enddate) + " | " + e.title;
                            spanEvent.id = "event-day//" + new Date(formatDatetime(new Date(e.date), e.startdate)) + "//" + new Date(formatDatetime(new Date(e.date), e.enddate)) + "//" + e.planner

                            document.getElementById(e.date).appendChild(spanEvent)

                            dataEvents.push(
                                                {
                                                    "planid" : e.planid,
                                                    "tag" : e.tag,
                                                    "title" : e.title,
                                                    "detail" : e.detail,
                                                    "mrid" : e.mrid,
                                                    "deptid" : e.deptid ,
                                                    "planner" : e.planner,
                                                    "startdate" : formatDatetime(new Date(e.date), e.startdate),
                                                    "enddate" : formatDatetime(new Date(e.date), e.enddate)
                                                }
                                            )

                            $.ajax({
            
                                        url: "{{ route('main.store') }}",
                                        type: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        data:{ 
                                                "content" : 'schedule',
                                                "planid" : e.planid,
                                                "tag" : e.tag,
                                                "title" : e.title,
                                                "detail" : e.detail,
                                                "mrid" : e.mrid,
                                                "deptid" : e.deptid ,
                                                "planner" : e.planner,
                                                "startdate" : formatDatetime(new Date(e.date), e.startdate),
                                                "enddate" : formatDatetime(new Date(e.date), e.enddate),
                                                "items" : acclist,
                                                "id" : 'tag-' + makeCodeId(10),
                                                "count" : obj.length,
                                                "create_by" : '<?php echo session("empno");?>' 

                                        },
                                        success: function(response) {
                                            //console.log(response)

                                            // alertStatus('แจ้งเตือน', e.planner + ', เพิ่มการนัดหมายแล้ว', 'success')
                                        },
                                        error: function(xhr, status, error) {
                                            // alertStatus('แจ้งเตือน', e.planner + ', เพิ่มการนัดหมายไม่สำเร็จ', 'error')
                                        }

                                    });


                            // $.ajax({
            
                            //             url: "{{ route('main.store') }}",
                            //             type: 'POST',
                            //             headers: {
                            //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            //             },
                            //             data:{ 
                            //                     "content" : 'createtag',
                            //                     "id" : 'tag-' + makeCodeId(10),
                            //                     "name" : e.tag,
                            //                     "create_by" : '<?php echo session("empno");?>' 
                                            
                            //             },
                            //             success: function(response) {
                            //                 //console.log(response)

                            //                 // alertStatus('แจ้งเตือน', e.planner + ', เพิ่มการนัดหมายแล้ว', 'success')
                            //             },
                            //             error: function(xhr, status, error) {
                            //                 // alertStatus('แจ้งเตือน', e.planner + ', เพิ่มการนัดหมายไม่สำเร็จ', 'error')
                            //             }

                            //         });

                            alertStatus('แจ้งเตือน', 'เพิ่มการนัดหมาย , ' + e.title , 'success')


                        })

                        addListenerEvens()
                
                    }

                    const updatePlanEvent = (e, acclist) => {
            
                        document.querySelector(".event-day."+ e.planid).remove()

                        if( roomCurrent.roomid ==  e.mrid ) {

                            let spanEvent = document.createElement('span')
                            
                            spanEvent.classList = 'event-day ' + e.deptid + ' ' + e.mrid + ' ' + e.planid + ' ' + e.tag +  ( new Date(formatDatetime(new Date(e.date), e.enddate)) < new Date( )? ' event-end' : '' )
                            spanEvent.style = "--eventSize: 1;--color-event:var(--color-"+ e.tag + ");" + ( document.querySelector(".radio-dept-" + e.tag).classList.contains('disable')? "display: none;" : "" ) +");"
                            spanEvent.title = e.title;
                            spanEvent.textContent = convertTime(e.startdate) + " - " + convertTime(e.enddate) + " | " + e.title;
                            spanEvent.id = "event-day//" + new Date(formatDatetime(new Date(e.date), e.startdate)) + "//" + new Date(formatDatetime(new Date(e.date), e.enddate)) + "//" + e.planner

                            try {
                                document.getElementById(e.date).appendChild(spanEvent)

                            } catch {

                            }
                        }
                    
                       

                        dataEvents[dataEvents.findIndex(obj => { return obj.planid === e.planid })] = (
                            {
                                "planid" : e.planid,
                                "mrid" : e.mrid,
                                "deptid" : e.deptid,
                                "planner" : e.planner,
                                "tag" : e.tag ,
                                "title" : e.title ,
                                "detail" : e.detail,
                                "date" : e.date,
                                "startdate" : formatDatetime(new Date(e.date), e.startdate),
                                "enddate" : formatDatetime(new Date(e.date), e.enddate)
                            
                            }
                        
                        )
                        // console.log(dataEvents)

                        $.ajax({
            
                                    url: pathMain + e.planid,
                                    type: 'PUT',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    data:{ 
                                            "content" : 'updatetag',
                                            "id" : 'tag-' + makeCodeId(10),
                                            "name" : e.tag,
                                            "create_by" : '<?php echo session("empno");?>'
                                        
                                    },
                                    success: function(response) {
                                        //console.log(response)

                                        // alertStatus('แจ้งเตือน', e.planner + ', เพิ่มการนัดหมายแล้ว', 'success')
                                    },
                                    error: function(xhr, status, error) {
                                        // alertStatus('แจ้งเตือน', e.planner + ', เพิ่มการนัดหมายไม่สำเร็จ', 'error')
                                    }

                                });

                        $.ajax({
            
                            url: pathMain + e.planid,
                            type: 'PUT',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data:{ 
                                    "content" : 'updateschedule',
                                    "planid" : e.planid,
                                    "mrid" : e.mrid,
                                    "deptid" : e.deptid,
                                    "planner" : e.planner,
                                    "tag" : e.tag,
                                    "title" : e.title ,
                                    "detail" : e.detail,
                                    "date" : new Date(e.date),
                                    "startdate" : formatDatetime(new Date(e.date), e.startdate),
                                    "enddate" : formatDatetime(new Date(e.date), e.enddate),
                                    "items" : acclist
                            },
                            success: function(response) {
                                //console.log(response)
                                // alertStatus('แจ้งเตือน', e.planner + ', อัพเดตการนัดหมายแล้ว', 'success')
                            },
                            error: function(xhr, status, error) {
                                // alertStatus('แจ้งเตือน', e.planner + ', อัพเดตการนัดหมายไม่สำเร็จ', 'error')
                            }

                        });

                       
                        alertStatus('แจ้งเตือน', e.title + ', อัพเดตการนัดหมายแล้ว', 'success')


 
                        addListenerEvens()
                        inactiveDialogEdit()

                    }

                    const form = document.getElementById('form')

                    form.addEventListener('submit', (event) => {
                        event.preventDefault()
                        const data = new FormData(event.currentTarget)
                        let itemlist = [];

                        let checkInputNull = false;
                        for (var pair of data.entries()) {
                            if(pair[1] == '' && ( pair[0] == "tag-id" || pair[0] == "planner" || pair[0] == "title" || pair[0] == "deptid")) {
                                checkInputNull = true;
                                document.getElementById(pair[0]).classList.add('active')

                            }

                            if(pair[1] == '' && ( pair[0] == "tag-id" || pair[0] == "mrid" ||  pair[0] == "title" || pair[0] == "deptid" || pair[0] == "date" || pair[0] == "startdate" || pair[0] == "enddate" )) {
                                checkInputNull = true;
                                 
                                if(pair[0] == "enddate") {document.querySelector(".alert-input.startdate").classList.add('active')}  else {document.querySelector(".alert-input."+pair[0]).classList.add('active')}
                                
                            } else if(pair[0] == "tag-id" || pair[0] == "mrid" ||  pair[0] == "title" || pair[0] == "deptid" || pair[0] == "date" || pair[0] == "startdate" || pair[0] == "enddate" ) {

                                     try {
                                        if(pair[0] == "enddate" && document.querySelector(".alert-input.startdate").classList.contains('active')) {
                                            document.querySelector(".alert-input.startdate").classList.remove('active')

                                        }  else if(pair[0] != "enddate" && document.querySelector(".alert-input."+pair[0]).classList.contains('active')) {
                                            document.querySelector(".alert-input."+pair[0]).classList.remove('active')

                                        }
                                    } catch {

                                    }
                                   
                            
                            }

                            if (pair[0].split('-')[0] == 'item') {

                                if(pair[0] == 'item-c') {
                                    if(pair[1] != '') {
                                        itemlist.push('acc-B2iaW-26072023-its+/-*' +  pair[1])
                                    }  
                                    

                                } else {
                                    itemlist.push(pair[1])

                                }

                            }

                            // if(pair[0] == "tag-id" && pair[1] == '') {
                            //     console.log( pair[1] )
                            // }

                            // if(pair[0] == "tag-id" && pair[1] != '') {
                            //     console.log( pair[1] )
                            // }

                            //console.log(pair[0] + ", " + pair[1])
                        }        

            
                        if(checkInputNull) {
                                return;
                        }

            
                        let newPlanId;
                        let newobj = [];

                        var datef = data.get('datef') != ""? new Date(data.get('datef')) : new Date(data.get('date'));
                        var datel = new Date(data.get('date'));

                        for (var d = new Date(datef.getFullYear(), datef.getMonth(), datef.getDate()); d <= datel; d.setDate(d.getDate() + 1)) {

                            //console.log(data.get('tag-id'))
                            newPlanId = generate('plan', data.get('deptid'))
                            newobj.push(
                                            {
                                                "planid" : newPlanId,
                                                "mrid" : data.get('mrid'),
                                                "deptid" : data.get('deptid'),
                                                "planner" : data.get('planner'),
                                                "tag" : data.get('tag-id'),
                                                "title" : data.get('title'),
                                                "detail" : data.get('detail'),
                                                "date" : new Date(d),
                                                "startdate" : data.get('startdate'),
                                                "enddate" : data.get('enddate')
                                            }
                                        )

                        }
                        console.log(itemlist)

                        addPlanEvent(newobj, itemlist);
                        newobj = []
                        itemlist = []
                        inactiveDialog()
                        
                    })

                    const formEdit = document.getElementById('form-edit')

                    formEdit.addEventListener('submit', (event) => {
                        event.preventDefault()
                        const data = new FormData(event.currentTarget)
                        let itemlist = [];
                        let checkInputNull = false;

                        for (var pair of data.entries()) {

                            if(pair[0] == "date-edit" || pair[0] == "startdate-edit") {
                               // console.log(new Date(pair[1]))
                            }

                            if(!admin && ( pair[0] == "date-edit" && new Date(formatDatetime(new Date(pair[1]), data.get('enddate-edit'))) < new Date() )) {
                                // console.log( new Date(formatDatetime(new Date(pair[1]), data.get('enddate-edit')))  )
                                // console.log( new Date() )

                                alertStatus('แจ้งเตือน', ' เพิ่มการนัดหมายไม่สำเร็จ, เนื่อจากวันเวลาที่กำหนดไม่อยู่ในช่วงเวลาที่สามารถนัดหมายได้', 'error')
                                return;
                            }
                            
                            if(pair[1] == '' && ( pair[0] == "tag-edit" || pair[0] == "mrid-edit" ||  pair[0] == "title-edit" || pair[0] == "deptid-edit" || pair[0] == "date-edit" || pair[0] == "startdate-edit" || pair[0] == "enddate-edit" )) {
                                checkInputNull = true;

                                if(pair[0] == "enddate-edit") {document.querySelector(".alert-input.startdate-edit").classList.add('active')}  else {document.querySelector(".alert-input."+pair[0]).classList.add('active')}
                                
                            } else if(pair[0] == "tag-edit" || pair[0] == "mrid-edit" ||  pair[0] == "title-edit" || pair[0] == "deptid-edit" || pair[0] == "date-edit" || pair[0] == "startdate-edit" || pair[0] == "enddate-edit" ) {

                                    try {
                                        if(pair[0] == "enddate-edit" && document.querySelector(".alert-input.startdate-edit").classList.contains('active')) {
                                        document.querySelector(".alert-input.startdate-edit").classList.remove('active')

                                        }  else if(pair[0] != "enddate-edit" && document.querySelector(".alert-input."+pair[0]).classList.contains('active')) {
                                            document.querySelector(".alert-input."+pair[0]).classList.remove('active')

                                        }
                                    } catch {

                                    }

                                    
                            
                            }

                            if (pair[0].split('-')[0] == 'item') {

                                if(pair[0] == 'item-c') {
                                    if(pair[1] != '') {
                                        itemlist.push('acc-B2iaW-26072023-its+/-*' +  pair[1])
                                    }  
                                    

                                } else {
                                    itemlist.push(pair[1])

                                }

                            }
                            // console.log(pair[0] + ", " + pair[1])
                        }  
                        
                        if(checkInputNull) {
                                return;
                        }

                        updatePlanEvent(
                                            {
                                                "planid" : data.get('planid'),
                                                // "appointid" : data.get('appointid'),
                                                "mrid" : data.get('mrid-edit'),
                                                "deptid" : data.get('deptid-edit'),
                                                "planner" : data.get('planner-edit'),
                                                "tag" : data.get('tag-id-edit'),
                                                "title" : data.get('title-edit'),
                                                "detail" : data.get('detail-edit'),
                                                "date" :  new Date(data.get('date-edit').replace('-','/')),
                                                "startdate" : data.get('startdate-edit'),
                                                "enddate" : data.get('enddate-edit')
                                            },

                                            itemlist

                                        )

 
                        itemlist = []


                    })

                    const createTag = (e) => {
                        $.ajax({
            
                            url: "{{ route('main.store') }}",
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data:{ 
                                    "content" : 'createtagOnly',
                                    "id" : 'tag-' + makeCodeId(10),
                                    "name" : e,
                                    "create_by" : '<?php echo session("empno");?>' 
                                
                            },
                            success: function(response) {
                                
                                
                                if(response == 'meyuu') {
                                    alertStatus('แจ้งเตือน', '# Tag ' + '\"'+ e +'\"' + ' , ขื่อนี้ถูกใช้งานแล้ว', 'success')

                                } else {
                                    renderMyTag()
                                    document.getElementById("box-create-tag").reset();
                                }

                                //console.log(response)

                                // alertStatus('แจ้งเตือน', e.planner + ', เพิ่มการนัดหมายแล้ว', 'success')
                            },
                            error: function(xhr, status, error) {
                                // alertStatus('แจ้งเตือน', e.planner + ', เพิ่มการนัดหมายไม่สำเร็จ', 'error')
                            }

                        });
                    }
                    
                    const formMytag = document.getElementById('box-create-tag')

                    formMytag.addEventListener('submit', (event) => {
                        event.preventDefault()
                        const data = new FormData(event.currentTarget)

                        let checkInputNull = false;

                        for (var pair of data.entries()) {

                            if(pair[1]  == '') {
                                checkInputNull = true
                                
                            } else {
                                // console.log(pair[0] + ", " + pair[1])
                                createTag(pair[1])
                            }
                            // console.log(pair[0] + ", " + pair[1])
                        }  

                        if(checkInputNull) {
                            return
                        }
                   
                    })

                    const updateMyTagColor = (e) => {

                        $.ajax({
                            url: pathMain + e.name,
                            type: 'PUT',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data:{ 
                                    "content" : 'updatetagcolor',
                                    "name" : e.name,
                                    "color" : e.color
                            },
                            success: function(response) {
                                document.querySelector('.ref-brush-' + e.name).style.color = e.color
                                 //console.log(response)
                                // alertStatus('แจ้งเตือน', e.planner + ', อัพเดตการนัดหมายแล้ว', 'success')
                            },
                            error: function(xhr, status, error) {
                                // alertStatus('แจ้งเตือน', e.planner + ', อัพเดตการนัดหมายไม่สำเร็จ', 'error')
                            }

                        });

                    }

                    const formChangeColorMytag = document.getElementById('tag-color-change')

                    formChangeColorMytag.addEventListener('submit', (event) => {
                        event.preventDefault()
                        const data = new FormData(event.currentTarget)
             
                        updateMyTagColor({name: data.get('tagname'), color: data.get('favcolor')})
                        
                    })
 


        ////////// func plannerCalendar //////////
        //document.querySelector('.menu-profile').innerHTML = localStorage.getItem("account")

   </script>

    @if (session()->has('erroraccount'))
        <script>  
             alertStatus('แจ้งเตือน', ' การเข้าสู้ระบบล้มเหลว, ตรวจสอบ account และ รหัสผ่านให้ถูกต้อง', 'error')
        </script>
    @endif 

    @if (session()->has('account'))
    <script>  
        alertStatus('แจ้งเตือน', ' Hello !! , เริ่มสร้างการนัดหมายได้แล้ว', 'success')
    </script>
@endif 

    {{ session()->pull('erroraccount')}}
</body>
</html>
 