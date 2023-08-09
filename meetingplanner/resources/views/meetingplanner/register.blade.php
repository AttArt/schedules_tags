<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Kanit:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap' rel='stylesheet'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ URL::asset('http://192.169.1.12:8888/meetingplanner/public/meeting.png') }}" sizes="196x196"> 
    <link rel="stylesheet" href="{{ URL::asset('http://192.169.1.12:8888/meetingplanner/public/css/registor.css?cschtr') }}">

    <title>Meeting Planner</title>
</head>

<body>
    <div class="container">
        <form class="content-register active" id="content-register" action=" " method="post" autocomplete="off">
             
            <div class="waviy head-title">
                <span style="--i:1">W</span>
                <span style="--i:2">e</span>
                <span style="--i:3">b</span>&nbsp;&nbsp;
                <span style="--i:4">M</span>
                <span style="--i:5">e</span>
                <span style="--i:6">e</span>
                <span style="--i:7">t</span>
                <span style="--i:8">i</span>
                <span style="--i:9">n</span>
                <span style="--i:10">g</span>&nbsp;&nbsp;
                <span style="--i:11">P</span>
                <span style="--i:12">l</span>
                <span style="--i:13">a</span>
                <span style="--i:14">n</span>
                <span style="--i:15">n</span>
                <span style="--i:16">e</span>
                <span style="--i:17">r</span>
            </div>

            <div class="head-title-b">
                Register 
            </div>
            <hr>
            <div class="register-box-input">
                <div class=" box-input">
                    <p class="title">emp ID.</p>
                    <div>
                        <input type="text" name="userno" pattern="[a-zA-Z0-9]{3,20}" id="userno" autofocus
                            placeholder="รหัสพนักงาน / Emp ID.  . . .">  
                    </div>
                    <span class="alert-input userno" id="userno">กรุณาระบุรหัสพนักงาน</span>
                </div>
                <div class=" box-input" onclick="deptDropdownMenu()">
                    <p class="title">แผนก</p>
                    <div class="dept">
                        <input disabled class="dept" type="text" name="dept" id="dept"
                            placeholder="แผนก / Department.  . . .">  
                        <input hidden='' class="dept" type="text" name="dept_id" id="dept_id">  
                    </div>
                    <span class="dept-dropdown dropdown">
                        <ul>
                            
                        </ul>
                    </span>
                    <span class="alert-input dept_id" id="dept_id">กรุณาระบุแผนก</span> 
                </div>
                <div class=" box-input">
                    <p class="title">first name</p>
                    <div>
                        <input type="text" name="firstN" pattern="[ก-๏a-zA-Z]{3,20}" id="firstN" 
                            placeholder="ชื่อ / First name. . .">
                    </div>
                    <span class="alert-input firstN" id="firstN">กรุณาระบุชื่อ</span>
                 </div>
                 <div class=" box-input">
                    <p class="title">last name</p>
                    <div>
                        <input type="text" name="lastN" pattern="[ก-๏a-zA-Z]{3,20}" id="lastN"
                            placeholder=" นามสกุล / Last name . . .">
                    </div>
                    <span class="alert-input lastN" id="lastN">กรุณาระบุนามสกุล</span>
                 </div>
                 <hr>
                 <div class=" box-input">
                    <p class="title">username</p>
                    <div>
                        <input type="text" name="username" pattern="[a-zA-Z0-9]{5,30}" id="username"
                            placeholder="ชื่อผู้ใช้ / Username (ชื่อภาษาอังกฤษ ห้ามเว้นช่องว่าง) . . .">
                    </div>
                    <span class="alert-input username" id="username">กรุณาระบุชื่อผู้ใช้</span>
                 </div>
                <div class="password box-input">
                    <p class="title">password</p>
                    <div>
                        <input type="password" name="password"  pattern="[a-zA-Z0-9]{6,20}" id="password" placeholder="รหัสผ่าน / Password. . .">
                        <i class="bx bx-show-alt password"></i>
                        <i class='bx bx-low-vision password'></i>
                    </div>
                    <span class="alert-input password" id="password">กรุณาระบุรหัสผ่าน</span>
                 </div>
                 <div class="password box-input">
                    <p class="title">confirm password</p>
                    <div>
                        <input type="password" name="Cpassword"  pattern="[a-zA-Z0-9]{6,20}" id="Cpassword" placeholder="ยืนยันรหัสผ่าน / Confirm password . . .">
                        <i class="bx bx-show-alt Cpassword"></i>
                        <i class='bx bx-low-vision Cpassword'></i>
                    </div>
                    <span class="alert-input Cpassword" id="Cpassword">กรุณายืนยันรหัสผ่าน</span>
                    <span class="alert-input InCorrectCpassword" id="InCorrectCpassword">การยืนยันรหัสผ่านไม่ถูกต้อง</span>
                 </div>
            </div>
        
            <div class="user-btn-register">
                <a href="http://192.169.1.12:8888/meetingplanner/main">Go to Website</a>
                <div class="box-button">
                    <input type="submit" value="ยืนยัน">
                </div>
            </div>

        </form>
    </div>
    <script>
        const password =  document.querySelector('.bx-show-alt.password');
        const Inpassword =  document.querySelector('.bx-low-vision.password');

        const Cpassword =  document.querySelector('.bx-show-alt.Cpassword');
        const InCpassword =  document.querySelector('.bx-low-vision.Cpassword');

        const changeTypeInput = (idElement, type) => {
            document.getElementById(idElement).type = type;
        }

        password.style.display = 'none'
        Inpassword.style.display = 'block'

        password.addEventListener('click', () => {

            changeTypeInput('password','password')
            password.style.display = 'none'
            Inpassword.style.display = 'block'
            
        })

        Inpassword.addEventListener('click', () => {

            changeTypeInput('password','text')
            password.style.display = 'block'
            Inpassword.style.display = 'none'

        })

        Cpassword.style.display = 'none'
        InCpassword.style.display = 'block'

        Cpassword.addEventListener('click', () => {

            changeTypeInput('Cpassword','password')
            Cpassword.style.display = 'none'
            InCpassword.style.display = 'block'
            
        })

        InCpassword.addEventListener('click', () => {

            changeTypeInput('Cpassword','text')
            Cpassword.style.display = 'block'
            InCpassword.style.display = 'none'

        })

        ////////////////////////////////////////////////////////////////////////////
        let dataDept = [];
        dataDept = ({!! json_encode($data['dept']) !!});

        const renderDropdownMeetingdepts = (content_id, content_class_add) => {

            if(dataDept != []) {
                dataDept.forEach((e, index) => {  
                  
                    let li = document.createElement("li");
                    li.classList.add(content_id);
                    li.innerHTML = e.department_name;
                    li.setAttribute("name",  e.department_name);
                    li.setAttribute("id",  e.did);
                    li.setAttribute("key",  index);
                    li.addEventListener('click', () => { 

                        document.getElementById(content_id).value = e.department_name
                        document.getElementById(content_id+'_id').value = e.did

                    });
                    

                    document.querySelector("." + content_class_add +" ul").appendChild(li)
                        
                    
                });


            }
        }

        renderDropdownMeetingdepts('dept', 'dept-dropdown')

        const deptDropdownMenu = () => {
            console.log('dropdown')
            document.querySelector(".dept-dropdown").classList.toggle('active')
        }

        document.querySelectorAll('div').forEach(ac => {
            ac.addEventListener('click', function (e) { 
                console.log(e.target)
                if(!(e.target.classList.contains('dept') || e.target.classList.contains('dept-dropdown'))) {
                    document.querySelector(".dept-dropdown").classList.remove("active")
                 } 
            })
        })

        ////////////////////////////////////////////////////////////////////////////

        const formContentRegister = document.getElementById('content-register')

        formContentRegister.addEventListener('submit', (event) => {
            event.preventDefault()
            const data = new FormData(event.currentTarget)
            
            if(data.get('password') != data.get('Cpassword')) {
                document.querySelector(".alert-input.InCorrectCpassword").classList.add('active')
                return

            } else if( document.querySelector(".alert-input.InCorrectCpassword").classList.contains('active') ) {
                document.querySelector(".alert-input.InCorrectCpassword").classList.remove('active')

            }

            for (var pair of data.entries()) {
                console.log(pair[0] + ", " + pair[1])
 
                if( pair[1] == '' ) {

                    document.querySelector(".alert-input." + pair[0]).classList.add('active')

                } else if( document.querySelector(".alert-input." + pair[0]).classList.contains('active') ) {

                    document.querySelector(".alert-input." + pair[0]).classList.remove('active')

                }
            }

            $.ajax({
                        
                        url: "{{ route('register.store') }}",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{ 
                                "content" : 'register',
                                "userno" : data.get('userno'),
                                "dept" : data.get('dept_id'),
                                "firstN" : data.get('firstN'),
                                "lastN" : data.get('lastN'),
                                "username" : data.get('username'),
                                "password" : data.get('password')
                        },
                        success: function(response) {
                            location.href = 'http://192.169.1.12:8888/meetingplanner/main';
                        },
                        error: function(xhr, status, error) {
                            
                        }

                    });
                        
        })

    </script>

</body>

</html>