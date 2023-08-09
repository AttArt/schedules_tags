class Chart {

    constructor() {
        this.schedule = [];
        this.dept = '';
        this.year = '';
        this.mrid = '';

        this.max_growing = 366;
        this.yf = 136.5;
        this.ydif = 4.2;
        this.xf = 30;
        this.xdif = 70.5;

        this.prevElementClass = "";
    }

    setDataSchedule = (newData) => {
        this.schedule = newData;
    }

    setYear = (year) => {
        this.year = year;
    }

    getYear = () => {
        return  this.year
    }

    setDept = (dept) => {
        this.dept = dept;
    }

    setMrid = (mrid) => {
        this.mrid = mrid;
    }
    
    getMrid = () => {
        return  this.mrid
    }

    lineOn(elementBoxcolor,eLine,color) {
        elementBoxcolor.style.setProperty( "--sum-chart", '"ปิด"' )
        eLine.style.display = 'block'
        elementBoxcolor.style.backgroundColor = color;
        elementBoxcolor.style.outlineColor = '#fff';
        document.querySelectorAll('.point-of-chart-lint-tooltip.tooltip-' +  String(color).slice(1)).forEach((tooltip) => {
                tooltip.style.display = 'block'
        })
    }

    lineOff(elementBoxcolor,eLine,color) {
        elementBoxcolor.style.setProperty( "--sum-chart", '"เปิด"' )
        eLine.style.animation = 'fadeOut .7s';
        setTimeout(() => {
            eLine.style.display = 'none';
        }, 505);
        elementBoxcolor.style.backgroundColor = '#e6e6e6';
        elementBoxcolor.style.outlineColor = '#fff';
        document.querySelectorAll('.point-of-chart-lint-tooltip.tooltip-' +  String(color).slice(1)).forEach((tooltip) => {
                tooltip.style.display = 'none'
        })
    }

    renderViewValueObj(obj, color, name, sumall) {


        let sum = 0;
        obj.forEach(( e, index ) => {
            if(typeof e == 'string') {
                sum += parseInt(e)

            } else {
                sum += e;
            }
        })

        let elementCircle = '<div class="chart-donut value-of-obj" style="--title-chart:\'' + name + '\'; ">\
                                <svg viewBox="-2 -2 40 40" class="circular-chart" style="--donut-color:' + color + '">\
                                    <path class="circle-bg"\
                                        d="M18 2.0845\
                                        a 15.9155 15.9155 0 0 1 0 31.831\
                                        a 15.9155 15.9155 0 0 1 0 -31.831"\
                                    />\
                                    <path class="circle"\
                                        stroke-dasharray="' + ( sum != 0 ? parseFloat((parseInt(sum)/sumall)*100).toFixed(2) : 0 )  + ', 100"\
                                        d="M18 2.0845\
                                        a 15.9155 15.9155 0 0 1 0 31.831\
                                        a 15.9155 15.9155 0 0 1 0 -31.831"\
                                    />\
                                    <text x="19" y="21.35" class="percentage">' + (  sum != 0 ? parseFloat((parseInt(sum)/sumall)*100).toFixed(1) : 0 ) + ' %</text>\
                                </svg>\
                            </div>'
        
        let elementBar =    '<div class="chart-bar small-font-size">\
                                <div class="bar bar-0 barX">\
                                    <div class="face side-0">\
                                        <div class="growing-bar" style="--color-bar:' + color + '; --value-growing:\'' + sum + '\'; transform: translateY(' + ( sum != 0 ? ( 100 - ( sum/this.max_growing) * 100 ): 100) + '%); opacity: .6;"></div>\
                                    </div>\
                                    <div class="face side-1">\
                                        <div class="growing-bar"  style="--color-bar:' + color + '; --value-growing:\'' + '' + '\'; transform: translateY(' + ( sum != 0 ? ( 100 - ( sum/this.max_growing) * 100 ): 100) + '%); opacity: .6;"></div>\
                                    </div>\
                                    <div class="face top"></div>\
                                    <div class="face floor" style="--donut-floor-color:' + color + '"></div>\
                                </div>\
                            </div>'

        let elementBoxcolor = document.createElement("div");
        elementBoxcolor.classList += 'box-color-of-obj-chart-line ' + 'box-' + String(color).slice(1)
        elementBoxcolor.style =  "--sum-chart:'" + 'ปิด' + "';--color-box-of-chart-line:" + color + ""
        elementBoxcolor.addEventListener('click', (e) => { 

            
            let eBtn =  document.querySelector('.box-color-of-obj-chart-line.' + 'box-' + String(color).slice(1))
            let eLine = document.querySelector('.box-color-' +  String(color).slice(1))

            if(elementBoxcolor.classList.contains('disable')) {
                this.lineOn(elementBoxcolor,eLine,color)
            

            } else {
                this.lineOff(elementBoxcolor,eLine,color)

            }

            elementBoxcolor.classList.toggle('disable')

        });

        document.querySelector('.content-foot-chart').innerHTML += elementCircle;
        document.querySelector('.content-chart-bar').innerHTML += elementBar;
        
        document.querySelector('.side-data-right').appendChild(elementBoxcolor);

        elementCircle = ''
        elementBar = ''

        return sum;
    }

     renderChartLineElement(dataY, color) {

        let polyline = '<polyline class="chart-line-x box-color-' + String(color).slice(1) + '\" points=" ';
        let circle = ""; 
        
        dataY.forEach((e, index) => {
            let txtX = index == 0 ?  this.xf : this.xf + (this.xdif * (index));
            let calY = Math.abs( this.yf - (parseInt(e) * this.ydif ) );
            let colorObj = String(color).slice(1);

            polyline +=  txtX  + ',' +  calY + ' '    
            if(dataY.length-1 == index) {
                polyline+= '"style=" stroke:' + color + ';stroke-width:2 "></polyline>'
            }
            
            circle += '<circle class="point-of-chart-line point-x-'+  colorObj +' " cx="' + txtX + '" cy="' + calY + '" r="3" stroke="#fff" stroke-width="2" fill="' + color + '"/>'
            circle += '<circle style="opacity: 0" class="point-of-chart-lint-tooltip tooltip-' +  colorObj +'" cx="' + ( txtX ) + '" cy="' + ( calY < 15 ?   calY + 16 :  calY - 16 ) + '" r="10" stroke="#e6e6e6" stroke-width="3" fill="' + '#ffff' + '"/>'
            circle += '<text style="opacity: 0" class="point-of-chart-lint-tooltip tooltip-' +  colorObj +'" x="' + ( e.length > 1? txtX - 3.9 : txtX - 2.5 ) + '" y="' + ( calY < 15 ?   calY + 18 :  calY - 13 )  + '" font-size=".5rem" fill="#5F5757">' + e + '</text>'

            calY = null;
            txtX = null;
            colorObj = null;

        });

   


        return polyline + circle;

    }

    renderViewX(dataXaxis) {

        let element = "";

        dataXaxis.forEach(( month, index ) => {
            let txtX = index == 0 ?  this.xf : this.xf + (this.xdif * (index)) 

            element += '<text x="' + ( txtX - 6 ) + '" y="148" font-size=".5rem" fill="#5F5757">' + month + '</text>\
                        <polygon points="' + txtX + ',' + 0 + ' ' + txtX + ',' + 135 + '" style="fill:none; stroke:#e6e6e6;"/>';

        });
        
        return element;

    }

    renderViewY(dataYaxis) {

        let element = "";

        dataYaxis.reverse().forEach(( valueX, index ) => {
            let txtY = Math.abs( this.yf - (parseInt(valueX) * this.ydif) ) + 2

            element += '<text x="' + 20 + '" y="' + (txtY) + '" font-size=".5rem" fill="#5F5757">' + valueX + '</text>';

        });

        return element;

    }

    
    chartLineDisplayON(codeId) {

        document.querySelectorAll('.chart-line-x').forEach((line) => {
            if(!line.classList.contains('focus')) {
                line.style.animation = 'fadeOutFocus .2s';
                line.style.opacity = '0.1'
            }
        })

        document.querySelectorAll('.point-of-chart-line').forEach((point) => {
            point.style.animation = 'fadeOutFocus .7s';
            point.style.opacity = '0.1'
        
        })

        document.querySelectorAll('.point-x-' + codeId).forEach((point) => {
            point.style.opacity = '0.8'
        })


        document.querySelectorAll('.point-of-chart-lint-tooltip.tooltip-' + codeId).forEach((tooltip) => {
                tooltip.style.opacity = '0.8'
        })

        if(this.prevElementClass != "" && this.prevElementClass != '.point-of-chart-lint-tooltip.tooltip-' + codeId) {
            document.querySelectorAll(this.prevElementClass).forEach((tooltip) => {
                tooltip.style.opacity = '0'
            })
        }
        
        this.prevElementClass = '.point-of-chart-lint-tooltip.tooltip-' + codeId;

    }

    chartLineDisplayOFF(codeId) {

        document.querySelectorAll('.chart-line-x').forEach((line) => {
            line.style.animation = 'fadeInFocus .7s';
            line.style.opacity = '0.8'
            line.classList.remove('focus')
        })

        document.querySelectorAll('.point-of-chart-line').forEach((point) => {
            point.style.animation = 'fadeInFocus .7s';
            point.style.opacity = '10.8'
        })

        document.querySelectorAll('.point-of-chart-lint-tooltip').forEach((tooltip) => {
                tooltip.style.opacity = '0'
        })

    }

    AddlistenerChartAtline(colorObj) {

        let elementClass = '';

        colorObj.forEach(( code, index ) => {

            elementClass = '.box-color-' +  String(code).slice(1)
        
            try {
                document.querySelector(elementClass).addEventListener('click', (e) => { 
                    if(e.target.classList.contains('focus')) {
                        this.chartLineDisplayOFF(String(code).slice(1))

                    } else {

                        document.querySelectorAll('.chart-line-x.focus').forEach((line) => {
                            line.classList.remove('focus')
                        })

                        e.target.style.opacity = '0.8'
                        e.target.classList.add('focus')

                        this.chartLineDisplayON(String(code).slice(1))
                    
                    }

                });

            } catch {
                
            }

        })
        
        elementClass = '';
    }

   mapDataPointYForChart = (room, objY, year, dataVY) => {
 
        

        let valOfChart =  [];
        let thisYear = dataVY.filter(
                                        (event) => ( 
                                            event.tag == objY 
                                            && event.mrid == room
                                            && new Date(event.startdate).getFullYear() == year
                                        ) 
                                    ) 
 

        for(let i = new Date().getMonth(); i >= 0; i--) {
    
            valOfChart.unshift(
                thisYear.filter((event) => ( 
                            new Date(event.startdate).getMonth() == i
                            && new Date(event.startdate ) < new Date() 
                        ) 
                ).length
            )
    
        } 

      
        return valOfChart;
    }
    
    mapDataForChart = (room, dataObjY, year, schedule) => {
          
        this.setMrid(room)

        let objChart = {
            data: [],
            name: [],
            color: []
        };

        dataObjY.forEach((e, index) => {  
           
            objChart.data.push(this.mapDataPointYForChart(room, e.name, year, schedule))
            objChart.name.push(e.name)
            objChart.color.push(e.color)
        })

        return objChart;
    }


    renderMainChart(rooms) {
         document.querySelector('.card-chart').innerHTML =  '<div class="chart-head">\
                                                                <label>Chart line</label>\
                                                            </div>\
                                                            <div class="chart-line"></div>\
                                                            <div class="view-of-chart">\
                                                                <div class="side-data-right"></div>\
                                                            </div>\
                                                            <div class="chart-foot">\
                                                                <label class="chart-line-foot-title"></label>\
                                                                <div class="chart-line-nameY"></div>\
                                                                <div class="content-foot-chart">\
                                                                    <div class="chart-value-sumAll">\
                                                                    </div>\
                                                                    <div class="text-for-chart-value">\
                                                                        ครั้งใน ปี ' + this.year +'\
                                                                    </div>\
                                                                </div>\
                                                                <div class="content-chart">\
                                                                    <div class="btn-dropdown-chart-roomds">\
                                                                        <div class="chartroom" type="button" ><label id="chart-room-input-label">'+  (rooms[rooms.findIndex(obj => { return obj.mrid == this.mrid})].mrname)  +'</label></div>\
                                                                        <input type="text" name="chart-room-input-name" id="chart-room-input" class="DisplayNone">\
                                                                        <span class="chart-room-dropdown dropdown">\
                                                                            <ul>\
                                                                            </ul>\
                                                                        </span>\
                                                                    </div>\
                                                                    <div class="content-chart-bar">\
                                                                    </div> \
                                                                </div>\
                                                            </div>'


        document.querySelector('.chartroom').addEventListener('click', () => {
            document.querySelector(".chart-room-dropdown").classList.toggle('active')
        });

        setTimeout(() => {
            this.renderDropdownChartRooms('chart-room-input', 'chart-room-dropdown', rooms)    
        }, 50);

    }

    // roomDropdownMenuChart() {
    //     document.querySelector(".chart-room-dropdown").classList.toggle('active')
    // }

    renderSVG = (objData) => {
        let element = "";
        let sums = 0;

        objData.data.forEach(( data, index ) => {
            data.forEach(( v, index ) => { sums += parseInt(v)})
        })
        
        objData.data.forEach(( data, index ) => {
            element += this.renderChartLineElement(data, objData.color[index])
        
        })

        objData.name.forEach(( name, index ) => {
            this.renderViewValueObj( objData.data[index], objData.color[index], name, sums)

        })


        document.querySelector('.chart-value-sumAll').innerHTML = sums
        
        setTimeout(() => {
            this.AddlistenerChartAtline(objData.color)
            //document.querySelector('.card-chart').scrollLeft  = 70 * (( new Date().getMonth()+1)-6)

            if(new Date().getMonth() <= 4) {

                document.querySelector('.card-chart').scrollLeft  = 0

            } else if(new Date().getMonth() <= 8) {

                document.querySelector('.card-chart').scrollLeft  =  document.querySelector('.card-chart').scrollWidth/2 - 200
            } else if(new Date().getMonth() <= 12) {

                document.querySelector('.card-chart').scrollLeft  = 1000
            }

        }, 50);

        return element;
    }

    callFuncRenderChartLine( objData ) {

        this.renderMainChart( objData.room )

        let box_month = document.querySelector('.chart-line');

        document.querySelector('.chart-head label').innerHTML = objData.title
        document.querySelector('.chart-line-nameY').innerHTML = objData.titleX
        document.querySelector('.chart-line-foot-title').innerHTML = objData.footTitle

        box_month.innerHTML += '<div class="side-data-left">\
                                    <svg>'
                                        +  this.renderViewY(objData.dataYaxis) +
                                    '</svg>\
                                </div>\
                                <div class="chart-line-polygon">\
                                    <svg>'
                                        +  this.renderViewX(objData.dataXaxis) + 
                                    '</svg>\
                                    <svg class="CompInside-chart">'
                                        + this.renderSVG(objData) + 
                                    '</svg>\
                                    </div>\
                                    \
                                    <div class="chart-line-nameX">'
                                    + objData.titleY + 
                                    '</div>\
                                </div>'

        box_month = null
       
    }

    renderDropdownChartRooms(content_class, content_class_add, data) {

        if(data != []) {
            data.forEach((e, index) => {  
                if(e.isopen) {

                    let li = document.createElement("li");
                    li.classList.add(content_class);
                    li.innerHTML = e.mrname;
                    li.setAttribute("name",  e.mrname);
                    li.setAttribute("id",  e.mrid);
                    li.setAttribute("key",  index);
                    li.addEventListener('click', () => {

                        // console.log(e.mrname)
                        document.getElementById(content_class+'-label').innerHTML = e.mrname 
                        document.getElementById(content_class).value =  e.mrid
                        // console.log(e.mrid)
            
                        document.querySelector('.content-foot-chart').innerHTML =  '<div class="chart-value-sumAll"></div>\
                                                                                    <div class="text-for-chart-value">\
                                                                                        ครั้งใน ปี ' + this.year +'\
                                                                                    </div>'     

                        document.querySelector('.content-chart-bar').innerHTML = '';
                        document.querySelector('.side-data-right').innerHTML = '';
                        this.setMrid(e.mrid)
                        document.querySelector('.CompInside-chart').innerHTML = this.renderSVG( this.mapDataForChart(e.mrid, this.dept, this.year, this.schedule))

                    });
                    

                    document.querySelector("." + content_class_add +" ul").appendChild(li)
                    
                }      
                
            });

        
        }
    }

    renderChartRoomsThisYaer = (year) => {
 
        this.setYear(year)

        // document.querySelector('.content-chart-bar').innerHTML = '';
        // document.querySelector('.side-data-right').innerHTML = '';
        // document.querySelector('.CompInside-chart').innerHTML ='';
        // document.querySelector('.CompInside-chart').innerHTML = this.renderSVG( this.mapDataForChart(this.mrid, this.dept, year, this.schedule))
 

    }

}

class HeatMap {
    constructor(coFunc) {
        this.coFuncYear = coFunc ;
    }

    renderObjsHeatMap = (dataObjChart) => {

        let content = "";

        if(dataObjChart.Objs != []) {
            dataObjChart.Objs.forEach((e, index) => {  
                let bufObjMapXColor = ( getComputedStyle(document.querySelector(':root')).getPropertyValue('--color-map-'+ e.name) ).split(',')
                // console.log(bufObjMapXColor)
                if(e.active || true) {
                    content += "<div class='content-heatmap "+ e.name +"' id="+ e.name +">\
                                    <div class='title-heatmap'>"+ e.name +"</div>\
                                    <div class='area-boxmap'>\
                                        <table class='heatmap'>\
                                            <thead>\
                                                <tr class='months'>\
                                                    <td colspan='' style='width: 29px' class='box-days side-days'> </td>\
                                                    <td colspan='5' id='jan' ><span>jan</span></td>\
                                                    <td colspan='4' id='feb' ><span>feb</span></td>\
                                                    <td colspan='4' id='mar' ><span>mar</span></td>\
                                                    <td colspan='5' id='apr' ><span>apr</span></td>\
                                                    <td colspan='4' id='may' ><span>may</span></td>\
                                                    <td colspan='4' id='jun' ><span>jun</span></td>\
                                                    <td colspan='5' id='jul' ><span>jul</span></td>\
                                                    <td colspan='4' id='aug' ><span>aug</span></td>\
                                                    <td colspan='4' id='sep' ><span>sep</span></td>\
                                                    <td colspan='5' id='oct' ><span>oct</span></td>\
                                                    <td colspan='4' id='nav' ><span>nav</span></td>\
                                                    <td colspan='5' id='dec' ><span>dec</span></td>\
                                                </tr>\
                                            </thead>\
                                            <tbody>\
                                                <tr class='box-days sun-day "+ e.name +"' style='height: 11px'>\
                                                    <td class='side-days'><span> </span></td>\
                                                </tr>\
                                                <tr class='box-days mon-day "+ e.name +"' style='height: 11px'>\
                                                    <td class='side-days'><span>mon</span></td>\
                                                </tr>\
                                                <tr class='box-days tue-day "+ e.name +"' style='height: 11px'>\
                                                    <td class='side-days'><span> </span></td>\
                                                </tr>\
                                                <tr class='box-days wed-day "+ e.name +"' style='height: 11px'>\
                                                    <td class='side-days'><span>wed</span></td>\
                                                </tr>\
                                                <tr class='box-days thu-day "+ e.name +"' style='height: 11px'>\
                                                    <td class='side-days'><span> </span></td>\
                                                </tr>\
                                                <tr class='box-days fri-day "+ e.name +"' style='height: 11px'>\
                                                    <td class='side-days'><span>fri</span></td>\
                                                </tr>\
                                                <tr class='box-days sat-day "+ e.name +"' style='height: 11px'>\
                                                    <td class='side-days'><span> </span></td>\
                                                </tr>\
                                            </tbody>\
                                        </table>\
                                    </div>\
                                    <div class='leng-color'>\
                                        <div class='less'>Less</div>\
                                        <div class='color'>\
                                            <div class='color-box' style='background-color:  " + bufObjMapXColor[0] + "'></div>\
                                            <div class='color-box' style='background-color: " + bufObjMapXColor[1] + "'></div>\
                                            <div class='color-box' style='background-color: " + bufObjMapXColor[2] + "'></div>\
                                            <div class='color-box' style='background-color: " + bufObjMapXColor[3] + "'></div>\
                                            <div class='color-box' style='background-color: " + bufObjMapXColor[4] + "'></div>\
                                        </div>\
                                        <div class='more'>More</div>\
                                    </div>\
                                </div>";
                }      
                
            });
        }
        
            document.querySelector(".box-heatmap").innerHTML += content
    }

    hexToRgb = (hex)  => {
        var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        return result ? {
            r: parseInt(result[1], 16),
            g: parseInt(result[2], 16),
            b: parseInt(result[3], 16)
        } : null;
    }

    calMin = (h, m) => {
        if(m > 59) {
            m = m - 60
            h++
        }

        return {h: h, m: m}
    }

    renderHeatMap(Schedule) {
        let bufObjMapDate;
        let bufObjMapX;
        let bufObjMapXColor;
        let hours;
        let minutes;
        let title;
        let vHM;

  
        if(Schedule.length > 0) {
            Schedule.forEach((e, index) => { 
                bufObjMapDate = new Date(e.startdate);
                bufObjMapXColor = ( getComputedStyle(document.querySelector(':root')).getPropertyValue('--color-map-'+ e.tag) ).split(',')
                bufObjMapX = document.getElementById('heatmap_day//' + e.tag + '//' + new Date(bufObjMapDate.getFullYear(), bufObjMapDate.getMonth(), bufObjMapDate.getDate(), 0, 0, 0) )
                hours = new Date(e.enddate).getHours() - new Date(e.startdate).getHours()
                minutes = new Date(e.enddate).getMinutes() - new Date(e.startdate).getMinutes()

                if(bufObjMapX != null) {
                    title = bufObjMapX.style.getPropertyValue('--title')

                    if (bufObjMapX.style.backgroundColor != '') {
                        hours +=  parseInt(bufObjMapX.name.split('.')[0]);
                        minutes += parseInt(bufObjMapX.name.split('.')[1]);
                        vHM = this.calMin(hours, minutes) 
                        hours = vHM.h
                        minutes = vHM.m
                        bufObjMapX.style.setProperty("--title",  (title.split(' , ')[0]) + ' , ' + ( (hours == 0 ? '' : hours + 'h ') + (minutes == 0 ? '' : minutes + 'm') ) + "'");
                        
                    } else {
                        bufObjMapX.style.setProperty("--title",  (title).slice(0,-1) + ' , ' + ( (hours == 0 ? '' : hours + 'h ') + (minutes == 0 ? '' : minutes + 'm') ) + "'");
    
                    }
    
                    if( hours >= 6 ) {
                        bufObjMapX.style.backgroundColor = bufObjMapXColor[4]
                        
                    } else if( hours >= 4 ) {
                        bufObjMapX.style.backgroundColor = bufObjMapXColor[3]
    
                    } else if( hours >= 2 ) {
                        bufObjMapX.style.backgroundColor = bufObjMapXColor[2]
    
                    } else if( hours <= 1 ) {
                        bufObjMapX.style.backgroundColor = bufObjMapXColor[1]
    
                    }

                    bufObjMapX.name = hours + '.' + minutes;

                }  

               

            })

        }

        bufObjMapDate = null;
        bufObjMapX = null;
        bufObjMapXColor = null;
        hours = null;
        minutes = null;
        title = null;
        vHM = null;
    }

    renderElementHeatMap = (dataObjChart) => {

    
        this.renderObjsHeatMap(dataObjChart)

        const heatmap_prev = document.querySelector(".heatmap_prev"),
        heatmap_next = document.querySelector(".heatmap_next"),
        heatmap_date = document.querySelector(".heatmap_date"),
        currentY = document.querySelector(".current-btn");

        const weekday = ["sun","mon","tue","wed","thu","fri","sat"];
        const monthNames = ["jan", "feb","mar", "apr", "may", "jun", "jul","aug", "sep", "oct", "nav", "dec"];

        let heatmap_today = new Date();
        let heatmap_year = heatmap_today.getFullYear();
        let heatmap_month = 0;
        heatmap_date.innerHTML = heatmap_year

        const addElement = (eId, e, day) => {
            if(day.toLowerCase() == "sun") {
                document.querySelector(".sun-day."+eId).appendChild(e);

            } else if(day.toLowerCase() == "mon") {
                document.querySelector(".mon-day."+eId).appendChild(e);

            } else if(day.toLowerCase() == "tue") {
                document.querySelector(".tue-day."+eId).appendChild(e);

            } else if(day.toLowerCase() == "wed") {
                document.querySelector(".wed-day."+eId).appendChild(e);

            } else if(day.toLowerCase() == "thu") {
                document.querySelector(".thu-day."+eId).appendChild(e);

            } else if(day.toLowerCase() == "fri") {
                document.querySelector(".fri-day."+eId).appendChild(e);

            } else if(day.toLowerCase() == "sat") {
                document.querySelector(".sat-day."+eId).appendChild(e);

            }    
        } 

        const initHeatmap = (eId) => {
            const heatmap_firstDay = new Date(heatmap_year, heatmap_month, 1);
            const heatmap_lastDay = new Date(heatmap_year, heatmap_month + 1, 0);
            const heatmap_prevLastDay = new Date(heatmap_year, heatmap_month, 0);
            const heatmap_prevDays = heatmap_prevLastDay.getDate();
            const heatmap_lastDate = heatmap_lastDay.getDate();
            const heatmap_day = heatmap_firstDay.getDay();

            let element_day;
            let textday;

            if(heatmap_month == 0) {
                for (let x = heatmap_day; x > 0; x--) {
                    textday = weekday[ (new Date(heatmap_year, heatmap_month - 1, heatmap_prevDays - x + 1)).getDay() ] ;
        
                    element_day = document.createElement('td');
                    element_day.style.width = "11px"
                    element_day.classList += "prevDays";
                    // element_day.textContent = prevDays - x + 1;

                    addElement(eId, element_day, textday.toLowerCase())
                }
            }

            //heatmap //add Event
            for (let i = 1; i <= heatmap_lastDate; i++) {
                textday = weekday[ (new Date(heatmap_year, heatmap_month, i)).getDay() ] ;

                element_day = document.createElement('td');
                element_day.classList += "heatmap_day";
                element_day.id = "heatmap_day//" + eId + '//' + new Date(heatmap_year,heatmap_month,i);
                element_day.style =  "--title: '" + ( i + "/" + monthNames[heatmap_month] + "/" + heatmap_year ).toString() + "'"; 
                // element_day.title = i + "/" + monthNames[heatmap_month] + "/" + heatmap_year;
                element_day.style.width = "11px"
                // element_day.textContent = i;

                // if(lastDate == i) {
                //     element_day.style.backgroundColor = "red"
                // }

                addElement(eId, element_day, textday.toLowerCase())
            
            }
            
        }

        const heatRenderbox = (eId) => {
            heatmap_month = 0;
            document.querySelector(".sun-day."+eId).innerHTML = "<td class='side-days'><span> </span></td>";
            document.querySelector(".mon-day."+eId).innerHTML = "<td class='side-days'><span>mon</span></td>";
            document.querySelector(".tue-day."+eId).innerHTML = "<td class='side-days'><span> </span></td>";
            document.querySelector(".wed-day."+eId).innerHTML = "<td class='side-days'><span>wed</span></td>";
            document.querySelector(".thu-day."+eId).innerHTML = "<td class='side-days'><span> </span></td>";
            document.querySelector(".fri-day."+eId).innerHTML = "<td class='side-days'><span>fri</span></td>";
            document.querySelector(".sat-day."+eId).innerHTML = "<td class='side-days'><span> </span></td>";

            for (let i = 1; i <= 12; i++) {
                initHeatmap(eId)
                heatmap_month++
            }
        }                        

        //////////////// render element heatmap ////////////////
        const renderHeatMapOfObjs = (year) => {
            if(dataObjChart.Objs != []) {
                dataObjChart.Objs.forEach((e, index) => {
                    if(e.active || true) {
                        heatRenderbox(e.name);

                    }

                })

                callDataViewChartXHeatMap(dataObjChart, year)
            }
         }

        renderHeatMapOfObjs(new Date().getFullYear())
        //////////////// render element heatmap ////////////////

        const prevYear = () => {
            heatmap_year --;
            heatmap_date.innerHTML = heatmap_year
            this.coFuncYear(heatmap_year)
            renderHeatMapOfObjs(heatmap_year);
        }
        const nextYear = () => {
            heatmap_year ++;
            heatmap_date.innerHTML = heatmap_year
            this.coFuncYear(heatmap_year)
            renderHeatMapOfObjs(heatmap_year);
        }
        const CurrentYear = () => {
            heatmap_year = new Date().getFullYear();
            heatmap_date.innerHTML = heatmap_year
            this.coFuncYear(heatmap_year)
            renderHeatMapOfObjs(heatmap_year);
        }

        heatmap_next.addEventListener("click", nextYear);
        heatmap_prev.addEventListener("click", prevYear);
        currentY.addEventListener("click", CurrentYear);
    };
}

const ChartComponent = new Chart(); 
const HeatMapComponent = new HeatMap(ChartComponent.renderChartRoomsThisYaer);
let objChart = {
    data: [],
    name: [],
    color: []
};

let callF = true;

callDataViewChartXHeatMap = (props, year) => {
   
    //ChartComponent.setMrid(props.rooms)
    document.querySelector(".card-chart").classList.add('skeleton')

    // script loaction variable pathMain  in index.php //
     $.ajax({

        url: pathMain + 'show/?year='+ year +' +&content=' + "chartSchedule" ,
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(Schedule) {
            console.log(Schedule)

            HeatMapComponent.renderHeatMap(Schedule);
            document.querySelector(".card-chart").classList.remove('skeleton')

            if(callF) {
                ChartComponent.setMrid(props.rooms[0].mrid)
                ChartComponent.setYear(new Date().getFullYear())

                callF = false
            }
            
            //console.log(ChartComponent.getMrid())
            //console.log(ChartComponent.getYear())

            objChart = ChartComponent.mapDataForChart(ChartComponent.getMrid(), props.Objs, ChartComponent.getYear(), Schedule)
            ChartComponent.callFuncRenderChartLine(
                                                        {
                                                            room: props.rooms,
                                                            data: objChart.data,
                                                            name: objChart.name,
                                                            color: objChart.color,
                                                            title: 'กราฟแสดงการขอใช้งานห้องประชุม / ปี',
                                                            titleY: 'จำนวนการเข้าใช้งาน / เดือน',
                                                            titleX: 'เดือน',
                                                            footTitle: 'จำนวนการเข้าใช้งานห้องประชุม / ปี',
                                                            dataYaxis: [5,10,15,20,25,30],
                                                            dataXaxis: ["jan", "feb","mar", "apr", "may", "jun", "jul","aug", "sep", "oct", "nav", "dec"],
                                                        }
                                                    )

            ChartComponent.setDataSchedule( Schedule )
            ChartComponent.setDept( props.Objs )
            // // ChartComponent.setYear( new Date().getFullYear() )
            
           
             
        },
        error: function(xhr, status, error) {
            console.log(error);
        }

    });

}


const renderPageChartXHeatMap = (props) => {
    objChart = {
        data: [],
        name: [],
        color: []
    };

    pageActive = {
        "pageCalendar" : false,
        "pageHeatMap" : true
    } 
    
    ChartComponent.setMrid(props.rooms[0].mrid)
    ChartComponent.setYear(new Date().getFullYear())

    document.querySelector(".meeting-room").classList.remove('active')
    document.querySelector(".room-dropdown").classList.remove('enable')
    
    ////////// reset sidebar radio //////////
    recheck();
    ////////// reset sidebar radio //////////
    // <div class='card-chart skeleton'></div>\
    // document.querySelector(".content").innerHTML = ""
    document.querySelector(".content").innerHTML = "<div class='container-heatmap'>\
                                                        <div class='head-heatmap'>\
                                                            <div class='heatmap_nav-left'>\
                                                                <button class='current-btn'>Current</button>\
                                                                <i class='bx bx-chevron-left heatmap_prev'></i>\
                                                                <i class='bx bx-chevron-right heatmap_next'></i>\
                                                                <div class='heatmap_date'>december 2015</div>\
                                                            </div>\
                                                        </div>\
                                                        <div class='box-heatmap'>\
                                                        <div class='card-chart skeleton'></div>\
                                                        \
                                                        </div>\
                                                    </div>";

    HeatMapComponent.renderElementHeatMap(props);
 
    

    objChart = {
        data: [],
        name: [],
        color: []
    };

}