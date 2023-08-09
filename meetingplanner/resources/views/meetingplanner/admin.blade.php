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

    <link rel="icon" href="{{ URL::asset('http://192.169.1.12:8888/meetingplanner/public/meeting.png') }}" sizes="196x196">  
    <link rel="stylesheet" href="{{ URL::asset('http://192.169.1.12:8888/meetingplanner/public/css/table.css?bfdh') }}">
    <link rel="stylesheet" href="{{ URL::asset('http://192.169.1.12:8888/meetingplanner/public/css/style.css?bfdh') }}">
    <script type="text/javascript" src="{{URL::asset('http://192.169.1.12:8888/meetingplanner/public/js/component/renderTable.js?bfdh')}}"></script>
     
    <title>Meeting Planner</title>
 </head>
<body>
    
    @if (session()->has('account'))
        @if( session('level') == 'Admin') 
           
        @else
            <script>window.location.href='main';</script>
        @endif
    @else
        <script>window.location.href='main';</script>
    @endif

    <div class="container">
         {{-- ////// alert content ////// --}}
         <div class="alert-massage-func">
            <div class="title-alert">title</div>
            <div class="content-alert">massage</div>
        </div>
        {{-- ////// alert content ////// --}}
        
        
        {{-- ////// topbar content  ////// --}}
        <div class="topnav">

            <div class="box-top-l">
                <label class="pj-name-logo">
                    MEETING PLANNER Admin
                </label>
                <label class="pj-name-logo-mobile">
                    MP  
                </label>
            </div>

            <div class="box-top-c"></div>
            <div class="box-top-r">
                <div class="menu-profile">
                    <label>{{session('account')}}</label>
                </div>
            </div>

        </div>

        <script>
            document.querySelector('.topnav .box-top-l').addEventListener("click", (e) => {
              window.location.href='main';
            })
       </script>

        <div class="main admin">
            <div class="backdrop-alert"></div>
            <div class="backdrop-sidebar"></div>

            {{-- ////// sidebar content  ////// --}}
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

            <div class="sidebar">
               
                <div class="content-menu-dept admin">
                    <div class="header">
                        <div class="title">Menu</div>
                     
                    </div>
                    <div class="nav-content">
                        <div id="" name="" class='btn-nav-dept active' onclick="renderTableTagsMeetings()">
                            <div class='btn-nav-dept-icon' style="pointer-events: none">
                                <i class='bx bxs-purchase-tag'style="pointer-events: none"></i>
                             </div>
                            <div id="" name="" class='btn-nav-dept-name'style="pointer-events: none"># Tag Meeting</div>
                        </div>

                        <div id="" name="" class='btn-nav-dept' onclick="renderTableMeetingRooms()">
                            <div class='btn-nav-dept-icon' style="pointer-events: none">
                                <i class='bx bxs-video'style="pointer-events: none"></i>
                            </div>
                            <div id="" name="" class='btn-nav-dept-name'style="pointer-events: none">Meeting Rooms</div>
                        </div>

                        <div id="" name="" class='btn-nav-dept'  onclick="renderTableAccessories()">
                            <div class='btn-nav-dept-icon'style="pointer-events: none">
                                <i class='bx bxl-dropbox'style="pointer-events: none"></i>
                            </div>
                            <div id="" name="" class='btn-nav-dept-name'style="pointer-events: none">Accessories</div>
                        </div>

                        <div id="" name="" class='btn-nav-dept' onclick="renderTableRoomsAccessories()">
                            <div class='btn-nav-dept-icon'style="pointer-events: none">
                                <i class='bx bx-cabinet'style="pointer-events: none"></i>
                            </div>
                            <div id="" name="" class='btn-nav-dept-name' style="pointer-events: none">Room Accessories</div>
                        </div>

                        <div id="" name="" class='btn-nav-dept' onclick="renderTableDept()">
                            <div class='btn-nav-dept-icon' style="pointer-events: none">
                                <i class='bx bxs-group' style="pointer-events: none"></i>
                            </div>
                            <div id="" name="" class='btn-nav-dept-name' style="pointer-events: none">Meeting Department</div>
                        </div>
                    </div>
                </div>

                {{-- ////// alert content ////// --}}
                    <div class="alert-massage-func">
                        <div class="title-alert">title</div>
                        <div class="content-alert">massage</div>
                    </div>
                {{-- ////// alert content ////// --}}

                <div class="footer">@hv-fila</div>
            </div>
            {{-- ////// sidebar content  ////// --}}


            {{-- ////// main content  ////// --}}
            <div class="content">
                
            </div>

            
            {{-- ////// main content  ////// --}}
            {{-- <div class="backdrop-alert addRoom">
                 <form class="dialog-room" id="form-addRoom" method="post" autocomplete="off">
                    <i class='bx bx-x' onclick="dialogAddRoomInActive()"></i>
                    <label>เพิ่มห้องประชุม</label>
                    <input type="text" placeholder="ชื่อห้องประชุม . . ." >
                    <input  type="submit" value="เพิ่ม">
                </form>
            </div> --}}


            {{-- <div class="addAcc">
                <form class="dialog-acc" id="form-addAcc" method="post" autocomplete="off">
                     <i class='bx bx-x' onclick="dialogAddAccInActive()"></i>
                    <label>เพิ่มอุปกรณ์</label>
                    <input type="text" placeholder="ชื่อห้องประชุม . . ." >
                    <input  type="submit" value="เพิ่ม">
                </div>
            </div>  --}}

           
        </div>

        <script>
            //////////// config path ///////////////
            const pathAdmin = '/meetingplanner/admin/';
            //////////// config path ///////////////

            //////////// main data /////////////// = ({!! json_encode($data['meetingroom']) !!});
            let meetingRoom = [];
            let roomsAccessorie = [];
            let currentroomId = "";

            meetingRoom = ({!! json_encode($data['meetingroom']) !!});
            //////////// main data ///////////////

            const savingAuto = () => {
                 
                 document.querySelector('.savingAuto').innerHTML = '<div class="waviy">\
                                                                         <span style="--i:1">S</span>\
                                                                         <span style="--i:2">a</span>\
                                                                         <span style="--i:3">v</span>\
                                                                         <span style="--i:4">i</span>\
                                                                         <span style="--i:5">n</span>\
                                                                         <span style="--i:6">g</span>\
                                                                         <span style="--i:7">.</span>\
                                                                         <span style="--i:8"></span>\
                                                                         <span style="--i:9">.</span>\
                                                                         <span style="--i:10"></span>\
                                                                         <span style="--i:11">.</span>\
                                                                         <span style="--i:12"></span>\
                                                                     </div>'
 
                 setTimeout(() => {
                     document.querySelector('.savingAuto').innerHTML = ""                  
                 }, 2500);
             }
 
             const actionConfirm = (e) => {
 
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

            const actionConfirmClose = () => {
                 document.querySelector(".backdrop-alert").style.display = "none"
                 document.querySelector(".backdrop-alert").innerHTML = ""
            }
 
             const alertStatus = (title, message, status) => {
                 document.querySelector(".alert-massage-func").classList.add('active')
                 document.querySelector(".alert-massage-func .title-alert").innerHTML = title
                 document.querySelector(".alert-massage-func .content-alert").innerHTML = message
 
                 setTimeout(function() {
                     document.querySelector(".alert-massage-func").classList.remove('active')
 
                 }, 3000)
             }
 
             const str00 = (num, strV) => {
                 return String(num).padStart(strV, '0')
             }
 
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
 
             const generateRoom = (idN, deptName) => {
                 let currentDate = new Date()
                 return idN + "-" + makeCodeId(5)
             }
 
 
             const closeDialog = (item, index) => {
  
                 try {
                     document.querySelector(".backdrop-alert").style.display = "none"
                     document.querySelector(".backdrop-alert").innerHTML = ""
                 } catch {
 
                 }
                 
             }
 
             let currentTable = 'mroom';
 
             const autoSaveInput = (e) => { 
                 
                 
                 let Dbuff = {id:'', name:'', value:''};
 
                 if(e.type == "checkbox") {
 
                     Dbuff.id = e.id.slice(2)
                     Dbuff.name = e.name.slice(0,2) == 'sw'? 'isopen' : 'st'? 'active' : ''
                     Dbuff.value = e.checked ? 1 : 0
 
                     document.querySelector('.' + e.id).innerHTML = e.checked? 'เปิดใช้งาน' : 'ปิดใช้งาน'
 
                 } else {
 
                     Dbuff.id = e.id
                     Dbuff.name = e.name
                     Dbuff.value = e.value
                 }
 
                //  console.log(Dbuff)
                //  return

                 $.ajax({
             
                     url: pathAdmin + currentTable,
                     type: 'PUT',
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     data:{ 
                             "id" : Dbuff.id,
                             "name" : Dbuff.name,
                             "value" : Dbuff.value
                            
                     },
                     success: function(response) {
                         savingAuto()
                         //console.log(response)
                         // alertStatus('แจ้งเตือน', e.planner + ', อัพเดตการนัดหมายแล้ว', 'success')
                     },
                     error: function(xhr, status, error) {
                         // alertStatus('แจ้งเตือน', e.planner + ', อัพเดตการนัดหมายไม่สำเร็จ', 'error')
                     }
 
                 });
 
                 Dbuff = null
 
             }
 
            
 
             const enterSaveInput = (e) => { 
                  //console.log(e)
                 // $.ajax({
             
                 //     url: pathAdmin + e.planid,
                 //     type: 'PUT',
                 //     headers: {
                 //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 //     },
                 //     data:{ 
                 //             "planid" : e.planid,
                 //             "mrid" : e.mrid,
                 //             "deptid" : e.deptid,
                 //             "planner" : e.planner,
                 //             "title" : e.title ,
                 //             "detail" : e.detail,
                 //             "date" : new Date(e.date),
                 //             "startdate" : formatDatetime(new Date(e.date), e.startdate),
                 //             "enddate" : formatDatetime(new Date(e.date), e.enddate),
                 //             "items" : acclist
                 //     },
                 //     success: function(response) {
                 //         //console.log(response)
                 //         // alertStatus('แจ้งเตือน', e.planner + ', อัพเดตการนัดหมายแล้ว', 'success')
                 //     },
                 //     error: function(xhr, status, error) {
                 //         // alertStatus('แจ้งเตือน', e.planner + ', อัพเดตการนัดหมายไม่สำเร็จ', 'error')
                 //     }
 
                 // });
             }
 
             const callDelDataDb = (e) => {
                 // console.log(e)
 
                 $.ajax({
                     url: pathAdmin + e.id + '+' + e.content ,
                     type: 'DELETE',
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     success: function(response) {
                         alertStatus('แจ้งเตือน', 'ยกเลิกแล้ว', 'success')
                         document.getElementById('ref-' + e.id).remove()
                         savingAuto()
                     },
                     error: function(xhr, status, error) {
                         //alertStatus('แจ้งเตือน', 'ยกเลิกการนัดหมายไม่สำเร็จ', 'error')
                     }
 
                 });
             }
 
             const deleteData = (e) => { 
                callDelDataDb({id:e.data.split('//')[1], content: e.data.split('//')[0]})
 
             }
 
             const deleteDataConfirmAgain = (data) => { 
 
                 actionConfirm( { data: data.data, message: '&nbsp!! เตือน !! : ', objDetail: 'การลบข้อมูลนี้ส่งผลต่อการแสดงผลของข้อมูลบนเว็บไซต์ เช่น Events, Chart ' , callFunc: deleteData })
              
             }
             
             const deleteDataConfirm = (e) => 
             {
 
                if(e.split('//')[0] == 'delacc' &&  e.split('//')[1] == 'acc-B2iaW-26072023-its') {
                    alertStatus('แจ้งเตือน', 'อุปกรณ์นี้ไม่สามารถลบออกจากระบบได้', 'success')
                    return;

                }

                // console.log(e.split('//')[0])
                actionConfirm( { data:e, message: 'ลบข้อมูล : ', objDetail: 'ไอดี : &nbsp;' + e.split('//')[1] + ', &nbsp; ชื่อ : &nbsp;' + e.split('//')[2] , callFunc: deleteDataConfirmAgain })
  
             }
 
             const deleteDataConfirmTwo = (e) => 
             {
 
                 //console.log(e.split('//') )
                 actionConfirm( { data:e, message: 'ลบข้อมูล : ', objDetail: 'อุปกรณ์ : &nbsp;' + e.split('//')[4] + ', &nbsp; ห้อง : &nbsp;' + (meetingRoom[meetingRoom.findIndex(obj => { return obj.mrid ===  e.split('//')[2]})].mrname) , callFunc: deleteDataConfirmAgain })
  
             }
            
             
            //////////// Component Tag Meeting /////////////// <label class="st' + item.id + '">' + (item.active? 'เปิดใช้งาน' : 'ปิดใช้งาน' ) +  '</label>
           
            
            const headTableTagsMeetings = [ 
                "# สี",
                "ผู้สร้าง (Emp ID)",
                "วันที่สร้าง",
                "# Tag follow",
                "# active",
            ]

            //  <div style="--column-n: 5" class="td"><input onchange="autoSaveInput(this)" type="text" id="' + item.id + '" value="' + item.color + '"  name="color" placeholder="โค้ดสี . . ."></div>\


            const MapBodyTableTagsMeetings = (item, index) => {
                let dateCreated = new Date(item.created_at)
                return  '<div class="tr" id="ref-' + item.id + '" key="' + index + '">\
                            <div style="--column-n: 5" class="td"><input onchange="autoSaveInput(this)" type="color" id="' + item.id + '" value="' + item.color + '" style="width: 40px; height:25px; padding:0; border: 1px solid rgb(236, 236, 236)" name="color" placeholder="โค้ดสี . . ." ></div>\
                            <div style="--column-n: 5" class="td">' + (item.create_by? item.create_by : 'ไม่พบข้อมูล') + '</div>\
                            <div style="--column-n: 5" class="td">' + str00(dateCreated.getDate(),2) + '-' + str00((dateCreated.getMonth(+1)),2) + '-' + dateCreated.getFullYear()  + '</div>\
                            <div style="--column-n: 5" class="td"> &nbsp; &nbsp; &nbsp;' + item.tagcount + '</div>\
                            <div style="--column-n: 5" class="td">\
                                <label for="st' + item.id + '" class="toggle-1">\
                                    <input type="checkbox" onchange="autoSaveInput(this)" ' + (item.active? 'checked' : '' )  + ' placeholder="" name="st' + item.id + '" id="st' + item.id + '" class="toggle-1__input">\
                                    <span class="toggle-1__button"></span>\
                                </label> <label class="st' + item.id + ' DisplayNone">' + (item.active? 'เปิดใช้งาน' : 'ปิดใช้งาน' ) +  '</label>\
                            </div>\
                            <div onclick="deleteDataConfirm(\'' + 'deltag' + '//' + item.id + '//' + item.name + '\')" class="td btn-table table-row-func"><i class="bx bxs-trash-alt"></i>' + '<div class="btn-title-admin">ยกเลิก</div>'  + '</div>\
                        </div>'
            }
            

            const headTableTagsMeetingsMain = [
                "No.",
                "ชื่อแท็ก #"
            ]

            //  <div style="--column-n: 5" class="td"><input onchange="autoSaveInput(this)" type="text" id="' + item.id + '" value="' + item.color + '"  name="color" placeholder="โค้ดสี . . ."></div>

            const MapBodyTableTagsMeetingsMain = (item, index) => { 
                return  '<div class="tr" id="ref-' + item.id + '" key="' + index + '">\
                            <div class="td table-row-number">' + (index+1) + '</div>\
                            <div style="--column-n: 1" class="td">#' + item.name + '</div>\
                         </div>'
            }

            const callDataTableTagsMeetings  = (value) => {
              
                $.ajax({
                            url: pathAdmin + 'show/?value='+ value +'&content=' + "tagsMeetings" ,
                            type: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {

                                document.querySelector('.content .tabletags').innerHTML = Table({    
                                                                                                dataHeadMain:headTableTagsMeetingsMain, 
                                                                                                dataHead:headTableTagsMeetings, 
                                                                                                dataBody: data, 
                                                                                                funcRenderMain:MapBodyTableTagsMeetingsMain,
                                                                                                funcRender:MapBodyTableTagsMeetings
                                                                                            }) 
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }

                        });
            }

            const tagsSearch= (e) => {
                
                callDataTableTagsMeetings((e.value).replace('#','-_-'))

            }

            const renderTableTagsMeetings  = ( ) => {
                closeDialog()
                currentTable = 'tag'

                document.querySelector('.content').innerHTML =  '<div class="header-content-admin">\
                                                                    Tags Meetings&nbsp;&nbsp;\
                                                                    <i class="bx bx-folder-plus" onclick="dialogAddTagActive()"></i><label>เพิ่ม</label><div class="savingAuto"></div>\
                                                                </div>\
                                                                <div class="table-content-top">\
                                                                    <div class="table-search">\
                                                                        <input type="text" onchange="tagsSearch(this)" autofocus id="table-search" name="table-search" placeholder="ค้นหา . . .">\
                                                                        <i class="bx bx-search-alt"></i>\
                                                                    </div>\
                                                                </div>\
                                                                <div class="tabletags">\
                                                                </div>' 
                tagsSearch({value:''})

            }
            //////////// Component Tag Meeting ///////////////

            //////////// Component Meeting Rooms ///////////////
            const headTableMeetingRooms = [ 
                "สถานะการเปิดใช้งาน" 
            ]

            const MapBodyTableMeetingRooms = (item, index) => {
                return  '<div class="tr" id="ref-' + item.mrid + '" key="' + index + '">\
                             <div style="--column-n: 1" class="td">\
                                <label for="sw' + item.mrid + '" class="toggle-1">\
                                    <input type="checkbox" onchange="autoSaveInput(this)" ' + (item.isopen? 'checked' : '' )  + ' placeholder="" name="sw' + item.mrid + '" id="sw' + item.mrid + '" class="toggle-1__input">\
                                    <span class="toggle-1__button"></span>\
                                </label><label class="sw' + item.mrid + '">' + (item.isopen? 'เปิดใช้งาน' : 'ปิดใช้งาน' ) +  '</label>\
                            </div>\
                            <div onclick="deleteDataConfirm(\'' + 'delroom' + '//' + item.mrid + '//' + item.mrname + '\')" class="td btn-table table-row-func"><i class="bx bxs-trash-alt"></i>' + '<div class="btn-title-admin">ยกเลิก</div>'  + '</div>\
                        </div>'
            }

            const headTableMeetingRoomsMain = [
                "No.",
                "ห้องประชุม" 
            ]

            const MapBodyTableMeetingRoomsMain = (item, index) => {
                return  '<div class="tr" id="ref-' + item.mrid + '" key="' + index + '">\
                            <div class="td table-row-number">' + (index+1) + '</div>\
                            <div style="--column-n: 1" class="td"> <input onchange="autoSaveInput(this)" pattern=".{6,60}" type="text" id="' + item.mrid + '" value="' + item.mrname + '"  name="mrname" placeholder="กรอกข้อมูล . . ."></div>\
                         </div>'
            }

            const callDataTableMeetingRooms  = (value) => {
              
                $.ajax({
                            url: pathAdmin + 'show/?value='+ value +'&content=' + "meetingroom" ,
                            type: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {
                                meetingRoom = data
                                document.querySelector('.content .tableroom').innerHTML =  Table({
                                                                                                        dataHeadMain:headTableMeetingRoomsMain, 
                                                                                                        dataHead:headTableMeetingRooms, 
                                                                                                        dataBody: data, 
                                                                                                        funcRenderMain:MapBodyTableMeetingRoomsMain, 
                                                                                                        funcRender:MapBodyTableMeetingRooms
                                                                                                    }) 
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }

                        });
            }

            const roomsSearch= (e) => {

                callDataTableMeetingRooms(e.value)

            }
          
            const renderTableMeetingRooms  = ( ) => {
                closeDialog()
                currentTable = 'mroom'
           
                document.querySelector('.content').innerHTML =  '<div class="header-content-admin">\
                                                                    Meeting Rooms&nbsp;&nbsp;\
                                                                    <i class="bx bx-folder-plus" onclick="dialogAddRoomActive()"></i><label>เพิ่ม</label><div class="savingAuto"></div>\
                                                                </div>\
                                                                <div class="tableroom">\
                                                                </div>'

                roomsSearch({value:''})
            }
            //////////// Component Meeting Rooms /////////////// 
                    
            
            //////////// Component Accessories ///////////////
            const headTableAccessories = [
                "รายละเอียด"  
            ]

            const MapBodyTableAccessories = (item, index) => {
                return  '<div class="tr" id="ref-' + item.accid + '" key="' + index + '">\
                            <div style="--column-n: 1" class="td"><input type="text" pattern=".{0,255}" onchange="autoSaveInput(this)" id="' + item.accid + '" value="' +(item.detail? item.detail : '' ) + '"  name="detail" placeholder=". . ."> </div>\
                            <div onclick="deleteDataConfirm(\'' + 'delacc' + '//' + item.accid + '//' + item.accname + '\')" class="td btn-table table-row-func"><i class="bx bxs-trash-alt"></i>' + '<div class="btn-title-admin">ยกเลิก</div>'  + '</div>\
                        </div>'
            }

            const headTableAccessoriesMain = [
                "No.",
                "ชื่ออุปกรณ์" 
            ]

            const MapBodyTableAccessoriesMain = (item, index) => {
                return  '<div class="tr" id="ref-' + item.accid + '" key="' + index + '">\
                            <div class="td table-row-number">' + (index+1) + '</div>\
                            <div style="--column-n: 1" class="td"><input type="text" pattern=".{2,60}" onchange="autoSaveInput(this)" id="' + item.accid + '" value="' + item.accname + '"  name="accname" placeholder="กรอกข้อมูล . . ."></div>\
                         </div>'
            }

            const callDataTableAccessories  = (value) => {
              
                $.ajax({
                            url: pathAdmin + 'show/?value='+ value +'&content=' + "accessories" ,
                            type: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {
                            
                                document.querySelector('.content .tableAccessories').innerHTML =  Table({
                                                                                                        dataHeadMain:headTableAccessoriesMain, 
                                                                                                        dataHead:headTableAccessories, 
                                                                                                        dataBody: data, 
                                                                                                        funcRenderMain:MapBodyTableAccessoriesMain, 
                                                                                                        funcRender:MapBodyTableAccessories

                                                                                                    }) 
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }

                        });
            }

            const accessoriesSearch= (e) => {

                callDataTableAccessories(e.value)

            }

            const renderTableAccessories  = ( ) => {
                closeDialog()
                currentTable = 'acc'
                
                document.querySelector('.content').innerHTML =  '<div class="header-content-admin">\
                                                                    Accessories&nbsp;&nbsp;\
                                                                    <i class="bx bx-folder-plus" onclick="dialogAddAccActive()"></i><label>เพิ่ม</label><div class="savingAuto"></div>\
                                                                </div>\
                                                                <div class="table-content-top">\
                                                                    <div class="table-search">\
                                                                        <input type="text" onchange="accessoriesSearch(this)" autofocus id="table-search" name="table-search" placeholder="ค้นหา . . .">\
                                                                        <i class="bx bx-search-alt"></i>\
                                                                    </div>\
                                                                </div>\
                                                                <div class="tableAccessories">\
                                                                </div>'

                accessoriesSearch({value:''})
 
            }
            //////////// Component Accessories ///////////////



            //////////// Component Rooms  Accessories ///////////////
            const headTableRoomsAccessories = [
                "ชื่ออุปกรณ์",
                "รายละเอียด" 
            ]

            const MapBodyTableRoomsAccessories = (item, index) => {
        
                return  '<div class="tr" id="ref-' + item.rlistid + '" key="' + index + '">\
                            <div style="--column-n: 2"class="td">' + item.accessories[0].accname + '</div>\
                            <div style="--column-n: 2" class="td">' + (item.accessories[0].detail? item.accessories[0].detail : '. . .' )  + '</div>\
                            <div onclick="deleteDataConfirmTwo(\'' + 'delroomacc' + '//' + item.rlistid + '//' + item.mrid + '//' + item.accid + '//' + item.accessories[0].accname + '\')" class="td btn-table table-row-func"><i class="bx bxs-trash-alt"></i>' + '<div class="btn-title-admin">ยกเลิก</div>'  + '</div>\
                         </div>'
            }

            const headTableRoomsAccessoriesMain = [
                "No.", 
                "ห้องประชุม" 
            ]

            const MapBodyTableRoomsAccessoriesMain = (item, index) => {
        
                return  '<div class="tr" id="ref-' + item.rlistid + '" key="' + index + '">\
                            <div class="td table-row-number">' + (index+1) + '</div>\
                            <div style="--column-n: 1" class="td">' + (meetingRoom[meetingRoom.findIndex(obj => { return obj.mrid === item.mrid })].mrname) + '</div>\
                        </div>'
            }


            const callDataTableRoomsAccessories  = (room) => {
              
                $.ajax({
                    url: pathAdmin + 'show/?id=' + room + '&content=' + "roomsAccessories" ,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(RoomsAccessories) {
                        roomsAccessorie = RoomsAccessories
                        currentroomId = room

                        document.querySelector('.content .tableacc').innerHTML = Table({dataHeadMain:headTableRoomsAccessoriesMain, dataHead:headTableRoomsAccessories, dataBody: RoomsAccessories, funcRender:MapBodyTableRoomsAccessories, funcRenderMain:MapBodyTableRoomsAccessoriesMain}) 
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            }

            
            renderDropdownChartRooms = (content_class, content_class_add, data) =>  {

                if(meetingRoom != []) {
                    meetingRoom.forEach((e, index) => {  
                        if(e.isopen) {

                            let li = document.createElement("li");
                            li.classList.add(content_class);
                            li.innerHTML = e.mrname;
                            li.setAttribute("name",  e.mrname);
                            li.setAttribute("id",  e.mrid);
                            li.setAttribute("key",  index);
                            li.addEventListener('click', () => {

                                document.getElementById(content_class+'-label').innerHTML = e.mrname 
                                document.getElementById(content_class).value = e.mrid
                                document.getElementById('admin-room-input').value = e.mrid

                                callDataTableRoomsAccessories(e.mrid)

                                
                            });
                            

                            document.querySelector("." + content_class_add +" ul").appendChild(li)
                        }      
                    });
                }
            }


            const renderTableRoomsAccessories  = ( ) => {
                closeDialog()
                currentTable = 'racc'
                //console.log(meetingRoom)
                // (meetingRoom[meetingRoom.findIndex(obj => { return obj.mrid == this.mrid})].mrname)
                document.querySelector('.content').innerHTML =  '<div class="header-content-admin">\
                                                                    Rooms Accessories&nbsp;&nbsp;\
                                                                    <i class="bx bx-folder-plus" onclick="dialogAddRoomAccActive()"></i><label>เพิ่ม</label><div class="savingAuto"></div>\
                                                                </div>\
                                                                <div class="btn-dropdown-admin-roomds">\
                                                                    <div class="adminroom" type="button" ><label id="admin-room-input-label">'+   meetingRoom[0].mrname  +'</label></div>\
                                                                    <input type="text" name="admin-room-input-name" id="admin-room-input" value="'+   meetingRoom[0].mrid  +'" class="DisplayNone">\
                                                                    <span class="admin-room-dropdown dropdown">\
                                                                        <ul>\
                                                                        </ul>\
                                                                    </span>\
                                                                </div>\
                                                                <div class="tableacc">\
                                                                </div>'
            

                document.querySelector('.adminroom').addEventListener('click', () => {
                    document.querySelector(".admin-room-dropdown").classList.toggle('active')
                });

                document.querySelectorAll('div').forEach(ac => {
                    ac.addEventListener('click', function (e) { 
                        
                        if(!(e.target.classList.contains('adminroom') || e.target.classList.contains('admin-room-dropdown'))) {
                            try {
                                document.querySelector(".admin-room-dropdown").classList.remove("active")

                            } catch {
                            
                            }
                        } 
                    })
                }) 
                
                callDataTableRoomsAccessories(meetingRoom[0].mrid)

                setTimeout(() => {
                    renderDropdownChartRooms('admin-room-input', 'admin-room-dropdown', meetingRoom)    
                }, 50);
                    
                     
            }
            //////////// Component Rooms  Accessories ///////////////


            //////////// Component Rooms  Accessories ///////////////
            const headTableDept = [
                "ชื่อแผนก",
                "color" 
            ]

            const MapBodyTableDept = (item, index) => {
                return  '<div class="tr" id="ref-' + item.id + '" key="' + index + '">\
                            <div style="--column-n: 2" class="td"><input type="text" pattern=".{2,30}" onchange="autoSaveInput(this)"  id="' + item.id + '" value="' + item.name + '"  name="name" placeholder="กรอกข้อมูล . . ."></div>\
                            <div style="--column-n: 2" class="td"><input type="text" pattern=".{3,30}" onchange="autoSaveInput(this)"  id="' + item.id + '" value="' + item.color + '"  name="color" placeholder="กรอกข้อมูล . . ."></div>\
                            <div onclick="deleteDataConfirm(\'' + 'deldept' + '//' + item.id + '//' + item.name + '\')" class="td btn-table table-row-func"><i class="bx bxs-trash-alt"></i>' + '<div class="btn-title-admin">ยกเลิก</div>'  + '</div>\
                        </div>'
            }

            const headTableDeptMain = [
                "No.", 
                "ไอดี"
            ]

            const MapBodyTableDeptMain = (item, index) => {
                return  '<div class="tr" id="ref-' + item.id + '" key="' + index + '">\
                            <div class="td table-row-number">' + (index+1) + '</div>\
                            <div style="--column-n: 1" class="td">' + (item.id) + '</div>\
                        </div>'
            }

            const callDataTableDepts  = (value) => {
                
                $.ajax({
                            url: pathAdmin + 'show/?value='+ value +'&content=' + "depts" ,
                            type: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {
                            
                                document.querySelector('.content .tabledepts').innerHTML =  Table({
                                                                                                            dataHeadMain:headTableDeptMain, 
                                                                                                            dataHead:headTableDept, 
                                                                                                            dataBody: data, 
                                                                                                            funcRenderMain:MapBodyTableDeptMain, 
                                                                                                            funcRender:MapBodyTableDept
                                                                                                        })  
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }

                        });
            }

            const deptsSearch= (e) => {

                callDataTableDepts((e.value).replace('#','-_-'))

            }

            const renderTableDept  = ( ) => {
                closeDialog()
                currentTable = 'dept'

                document.querySelector('.content').innerHTML =  '<div class="header-content-admin">\
                                                                            Meeting Department&nbsp;&nbsp;\
                                                                            <i class="bx bx-folder-plus" onclick="dialogAdddeptsSearchDeptActive()"></i><label>เพิ่ม</label><div class="savingAuto"></div>\
                                                                        </div>\
                                                                        <div class="table-content-top">\
                                                                            <div class="table-search">\
                                                                                <input type="text" onchange="deptsSearch(this)" autofocus id="table-search" name="table-search" placeholder="ค้นหา . . .">\
                                                                                <i class="bx bx-search-alt"></i>\
                                                                            </div>\
                                                                        </div>\
                                                                        <div class="tabledepts">\
                                                                        <div>'
                deptsSearch({value:''})
            }
            //////////// Component Rooms  Accessories ///////////////

            document.querySelectorAll('.admin .btn-nav-dept').forEach((navbar) => {
                navbar.addEventListener("click", (e) => {
                    if(!e.target.classList.contains("active")) {
                        try {
                            document.querySelector(".admin .btn-nav-dept.active").classList.remove("active");

                        } catch {

                        }
                        e.target.classList.add('active')

                    }
                    
                 }
            )})

            //////////// setup start component ///////////////
            renderTableTagsMeetings()
            //////////// setup start component ///////////////

            const addTag  = (e) => { 
                $.ajax({
            
                    url: "{{ route('admin.store') }}" ,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{ 
                            "content": "addtag",
                            "id" :  ('tag-' + makeCodeId(10)),
                            "name" : e.name,
                            "create_by" : '<?php echo session("empno");?>'
                    },
                    success: function(response) {

                        if(response == 'meyuu') {
                            alertStatus('แจ้งเตือน', '# Tag ' + '\"'+ e.name +'\"' + ' , ขื่อนี้ถูกใช้งานแล้ว', 'success')

                        } else {
                            renderTableTagsMeetings()
                            setTimeout(() => {
                                savingAuto()                     
                            }, 200);
                        }

                      
                        
                        // alertStatus('แจ้งเตือน', e.planner + ', เพิ่มการนัดหมายแล้ว', 'success') mroom-hvfila-01-0002

                    },
                    error: function(xhr, status, error) {
                    
                    }

                });
            }

            const dialogAddTagActive  = ( ) => { 

                // document.querySelector('.backdrop-alert.addRoom').classList.add('active')

                document.querySelector(".backdrop-alert").style.display = "flex"
                document.querySelector(".backdrop-alert").innerHTML =  "<form class='dialog-room' id='form-addRoom' method='post' autocomplete='off'>\
                                                                            <i class='bx bx-x' onclick='dialogAddTagInActive()'></i>\
                                                                            <label>เพิ่ม #</label>\
                                                                            <input type='text'name='name' pattern='[ก-๏a-zA-Z0-9.=$%&@?]{3,30}' placeholder='ชื่อแท็ก . . .' >\
                                                                            <input type='submit' value='เพิ่ม'>\
                                                                        </form>"

  
                let formAddRoom = document.getElementById('form-addRoom')
                formAddRoom.addEventListener('submit', (event) => {
                    dialogAddTagInActive()

                    event.preventDefault()
                    let data = new FormData(event.currentTarget)
                    //console.log('addRoom')

                    for (var pair of data.entries()) {
                        // console.log(pair[0] + ', ' + pair[1])
                        addTag({ name: pair[1] })
                    }

                })
            }

            const dialogAddTagInActive  = ( ) => { 
                // document.querySelector('.backdrop-alert.addRoom').classList.remove('active')
                document.querySelector(".backdrop-alert").style.display = "none"
                document.querySelector(".backdrop-alert").innerHTML = ""
            }

            const addRoom  = (e) => { 
                $.ajax({
            
                    url: "{{ route('admin.store') }}" ,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{ 
                            "content": "addroom",
                            "mrid" :  ('mroom-hvfila-01-' + makeCodeId(5)),
                            "mrname" : e.mrname,
                    },
                    success: function(response) {
                        renderTableMeetingRooms()
                        setTimeout(() => {
                            savingAuto()                     
                       }, 200);
                        
                        // alertStatus('แจ้งเตือน', e.planner + ', เพิ่มการนัดหมายแล้ว', 'success') mroom-hvfila-01-0002

                    },
                    error: function(xhr, status, error) {
                    
                    }

                });
            }

            const dialogAddRoomActive  = ( ) => { 

                // document.querySelector('.backdrop-alert.addRoom').classList.add('active')

                document.querySelector(".backdrop-alert").style.display = "flex"
                document.querySelector(".backdrop-alert").innerHTML =  "<form class='dialog-room' id='form-addRoom' method='post' autocomplete='off'>\
                                                                            <i class='bx bx-x' onclick='dialogAddRoomInActive()'></i>\
                                                                            <label>เพิ่มห้องประชุม</label>\
                                                                            <input type='text' pattern='.{6,60}' name='roomname' placeholder='ชื่อห้องประชุม . . .' >\
                                                                            <input type='submit' value='เพิ่ม'>\
                                                                        </form>"

  

                let formAddRoom = document.getElementById('form-addRoom')
                formAddRoom.addEventListener('submit', (event) => {
                    dialogAddRoomInActive()

                    event.preventDefault()
                    let data = new FormData(event.currentTarget)
                    //console.log('addRoom')

                    for (var pair of data.entries()) {
                        // console.log(pair[0] + ', ' + pair[1])
                        addRoom({ mrname: pair[1] })
                    }

                })
            }

            const dialogAddRoomInActive  = ( ) => { 
                // document.querySelector('.backdrop-alert.addRoom').classList.remove('active')
                document.querySelector(".backdrop-alert").style.display = "none"
                document.querySelector(".backdrop-alert").innerHTML = ""
            }

            //acc-yUd3x-02072023-its,

            const addAcc  = (e) => { 
                let currentDate = new Date()

                $.ajax({
            
                    url: "{{ route('admin.store') }}" ,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{ 
                            "content": "addacc",
                            "accid" :  ('acc-' + makeCodeId(5) + '-' + ( str00(currentDate.getDate(),2)  + str00((currentDate.getMonth()+1),2) + currentDate.getFullYear() )) + '-its' ,
                            "accname" : e.accname,
                    },
                    success: function(response) {
                        // console.log(response)
                        // alertStatus('แจ้งเตือน', e.planner + ', เพิ่มการนัดหมายแล้ว', 'success') mroom-hvfila-01-0002
                        renderTableAccessories()
                        setTimeout(() => {
                            savingAuto()                     
                       }, 200);

                    },
                    error: function(xhr, status, error) {
                     }

                });
            }


            const dialogAddAccActive  = ( ) => { 
                document.querySelector(".backdrop-alert").style.display = "flex"
                document.querySelector(".backdrop-alert").innerHTML =   '<form class="dialog-acc" id="form-addAcc" method="post" autocomplete="off">\
                                                                            <i class="bx bx-x" onclick="dialogAddAccInActive()"></i>\
                                                                            <label>เพิ่มอุปกรณ์</label>\
                                                                            <input type="text" pattern=".{2,60}" name="accname" placeholder="ชื่ออุปกรณ์ . . ." >\
                                                                            <input  type="submit" value="เพิ่ม">\
                                                                        </div>'

  

                let formAddAcc = document.getElementById('form-addAcc')
                formAddAcc.addEventListener('submit', (event) => {
                    dialogAddRoomInActive()

                    event.preventDefault()
                    let data = new FormData(event.currentTarget)
                    //console.log('addAcc')
                 
                    for (var pair of data.entries()) {
                        //console.log(pair[0] + ', ' + pair[1])
                        addAcc({ accname: pair[1] })
                    }

                })
            }

            const dialogAddAccInActive  = ( ) => { 
                document.querySelector(".backdrop-alert").style.display = "none"
                document.querySelector(".backdrop-alert").innerHTML = ""
            }

            const addRoomAcc = (e) => { 
                let currentDate = new Date()

                $.ajax({
            
                    url: "{{ route('admin.store') }}" ,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{ 
                            "content": "addroomacc",
                            "rlistid" :  '' ,
                            "accid" :  '' ,
                            "mrid" : '',
                    },
                    success: function(response) {
                        // console.log(response)
                        // alertStatus('แจ้งเตือน', e.planner + ', เพิ่มการนัดหมายแล้ว', 'success') mroom-hvfila-01-0002
                        renderTableRoomsAccessories()
                        setTimeout(() => {
                            savingAuto()                     
                       }, 200);
                    },
                    error: function(xhr, status, error) {

                    }

                });
            }

            const autoSaveInputRAcc = (e) => { 
                // console.log(e.id.split('//'))makeCodeId(5)),
                let currentDate = new Date()
                let Dbuff = {idmr:'', idacc:'', value:''};

                Dbuff.idmr = e.id.split('//')[2]
                Dbuff.idacc =  e.id.split('//')[1]
                Dbuff.value = e.checked ? 1 : 0

                // console.log(Dbuff)

                $.ajax({
            
                    url: "{{ route('admin.store') }}" ,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { 
                            "content": "addroomacc",
                            "rlistid" :  'racc-' + makeCodeId(5) + '-' + ( str00(currentDate.getDate(),2) + str00((currentDate.getMonth()+1),2) + currentDate.getFullYear() ) + '-its',
                            "accid" : Dbuff.idacc,
                            "mrid" : Dbuff.idmr,
                            "value" : Dbuff.value 
                    },
                    success: function(response) {

                        // alertStatus('แจ้งเตือน', e.planner + ', เพิ่มการนัดหมายแล้ว', 'success') mroom-hvfila-01-0002
                        callDataTableRoomsAccessories(Dbuff.idmr)
                      

                    },
                    error: function(xhr, status, error) {
                    }

                });
            }

            const calldataAcc = (e) => { 
 
                $.ajax({
                    url: pathAdmin + 'show/?content=' + "accessories" ,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(Accessories) {

                        // console.log(Accessories )
                        // console.log(roomsAccessorie )

                        let content = ''
                        
                        Accessories.forEach((acc) => {
                            checked = roomsAccessorie.length > 0 ? roomsAccessorie.findIndex(obj => { return obj.accid == acc.accid}) : -1
 
                            content +=  '<div class="box">\
                                            <div class="nameacc">' + acc.accname + '</div>\
                                            <label for="' + acc.accname + '//' + acc.accid + '//' + currentroomId + '" class="toggle-1">\
                                                <input type="checkbox" onchange="autoSaveInputRAcc(this)" ' + (checked != -1? 'checked' : '' )  + ' placeholder="" name="' + acc.accname + '//' + acc.accid + '//' + currentroomId + '" id="' + acc.accname + '//' + acc.accid + '//' + currentroomId +'" class="toggle-1__input">\
                                                <span class="toggle-1__button"></span>\
                                            </label>\
                                        </div>'
                        })
                        
                        document.querySelector('.boxs').innerHTML = content
                        document.querySelector(".backdrop-alert").style.display = "flex"

                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            }

            const dialogAddRoomAccActive = () => { 
                //console.log(document.getElementById('admin-room-input').value)
                               
                document.querySelector(".backdrop-alert").innerHTML =   '<form class="dialog-addRommAcc" id="form-addRommAcc" method="post" autocomplete="off">\
                                                                            <i class="bx bx-x" onclick="dialogAddRoomAccInActive()"></i>\
                                                                            <label>จัดการอุปกรณ์</label>\
                                                                            <div class="boxs">\
                                                                            </div>\
                                                                        </form>'

                calldataAcc();


                let formAddAcc = document.getElementById('form-addRommAcc')
                formAddAcc.addEventListener('submit', (event) => {
                    dialogAddRoomInActive()

                    event.preventDefault()
                    let data = new FormData(event.currentTarget)
                    // console.log('addDept')
                    // "rlistid" :  '' ,
                    // "accid" :  '' ,
                    // "mrid" : '',

                    // for (var pair of data.entries()) {
                    //     // addRoomAcc({ accname: pair[1] })
                    //     console.log({accid:'', mrid: document.getElementById('admin-room-input').value })
                    // }

                })
            }

            const dialogAddRoomAccInActive  = ( ) => { 
                document.querySelector(".backdrop-alert").style.display = "none"
                document.querySelector(".backdrop-alert").innerHTML = ""
            }

            const addDept  = (e) => {
                
                //console.log(e)

                $.ajax({
            
                    url: "{{ route('admin.store') }}" ,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{ 
                            "content": "adddept",
                            "id" : e.deptid,
                            "name" : e.deptname,
                            "color" : '#e6e6e6',
                    },
                    success: function(response) {
                        // console.log(response)
                        // alertStatus('แจ้งเตือน', e.planner + ', เพิ่มการนัดหมายแล้ว', 'success') mroom-hvfila-01-0002
                       renderTableDept()
                       setTimeout(() => {
                            savingAuto()                     
                       }, 200);
                    },
                    error: function(xhr, status, error) {
                     }

                });
            }

            const dialogAddDeptActive  = ( ) => {

                document.querySelector(".backdrop-alert").style.display = "flex"
                document.querySelector(".backdrop-alert").innerHTML =   '<form class="dialog-dept" id="form-addDept" method="post" autocomplete="off">\
                                                                            <i class="bx bx-x" onclick="dialogAddDeptInActive()"></i>\
                                                                            <label>เพิ่มแผนก</label>\
                                                                            <label class="title-add">ไอดี</label>\
                                                                            <input type="text" pattern=".{2,10}" name="deptid" placeholder="ไอดีแผนก . . ." >\
                                                                            <label class="title-add">ชื่อ</label>\
                                                                            <input type="text" pattern=".{2,30}" name="deptname" placeholder="ชื่อแผนก . . ." >\
                                                                            <input  type="submit" value="เพิ่ม">\
                                                                        </div>'

                let formAddAcc = document.getElementById('form-addDept')
                formAddAcc.addEventListener('submit', (event) => {
                    dialogAddRoomInActive()

                    event.preventDefault()
                    let data = new FormData(event.currentTarget)
                    //console.log('addDept')

                    for (var pair of data.entries()) {
                        //console.log(pair[0] + ', ' + pair[1])
                    }

                    addDept({deptid: data.get('deptid'), deptname: data.get('deptname')})
                    // data.get('mrid-edit'),
                })
            }

            const dialogAddDeptInActive  = ( ) => { 
                document.querySelector(".backdrop-alert").style.display = "none"
                document.querySelector(".backdrop-alert").innerHTML = ""
            }

        </script>
</body>
</html>