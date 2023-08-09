

const Table = (props) => {
    
    const dataHead = [
            "A",
            "B",
            "C"
    ]

    const dataBody = [
        {
            A: '1',
            B: '2',
            C: '3'
        },
        {
            A: '1',
            B: '2',
            C: '3'
        },
        {
            A: '1',
            B: '2',
            C: '3'
        },
        {
            A: '1',
            B: '2',
            C: '3'
        }
    ]


    const renderHead = (item, index, n) => {
        if(index == 0) {
            return '<div class="th table-row-number" key="' + index + '">' + item  + '</div>'

        } else {
            return '<div style="--column-n:' + n + '" class="th" key="' + index + '">' + item  + '</div>'

        }
    }

    const renderHeadBody = (item, index, n) => {
       
            return '<div style="--column-n:' + n + '" class="th" key="' + index + '">' + item  + '</div>'
 
    }

    // const renderBody = (item, index) => {
    //     return  '<tr key="' + index + '">\
    //                 <td>' + item.A + '</td>\
    //                 <td>' + item.B  + '</td>\
    //                 <td>' + item.C  + '</td>\
    //             </tr>'
    // }
    
 
    const render = (item, funcRender) => {
        let content = ''

        if(item.length > 0) {

            item.forEach((e, index) => {
                content += funcRender(e, index, item.length-1)
            }) 

        }

        return content 
    }

   
    return ( 
            dataHead.length!=0 && dataBody.length!=0 ?
                '<div class="table-data-view">\
                    <div class="table head-content">' 
                    +
                                '<div class="thead">\
                                    <div class="tr">'
                                    +
                                        render(props.dataHeadMain, renderHead)
                                    +
                                    '</div>\
                                </div>'
                    +
                                '<div class="tbody">'
                                    +
                                        render(props.dataBody, props.funcRenderMain)
                                    +
                                '</div>'
                    +
                    '</div>\
                    <div class="table body-content">' 
                    +
                                '<div class="thead">\
                                    <div class="tr">'
                                    +
                                        render(props.dataHead, renderHeadBody) + '<div class="th table-row-func" key="' + 'lne' + '">' +  ''  + '</div>'
                                    +
                                    '</div>\
                                </div>'
                    +
                                '<div class="tbody">'
                                    +
                                        render(props.dataBody, props.funcRender)
                                    +
                                '</div>'
                    +
                    '</div>\
                </div>\
                \
                <div class="table-content-footer">\
                    <div class="currentpages">1/100</div>\
                    <div class="pagination">\
                        <i class="bx bx-chevrons-left pageNext"></i>\
                            ...\
                            <div class="pageN">1</div>\
                            <div class="pageN">2</div>\
                            <div class="pageN">3</div>\
                            <div class="pageN">4</div>\
                            ...\
                        <i class="bx bx-chevrons-right pagePrev"></i>\
                    </div>\
                </div>'
            :
                '<div class="table-data-view">\
                    <table class="table">' 
                    +
                                '<thead class="thead">\
                                    <tr class="tr">'
                                        + '<th>' + 'No Date' + '</th>' +
                                    '</tr>\
                                </thead>'
                    +
                                '<tbody class="tbody">\
                                    <tr class="tr">'
                                        + '<td class="td">' + 'ไม่มีรายการข้อมูล' + '</td>' +
                                    '</tr>\
                                </tbody>'
                    +
                    '</table>\
                </div>'
    )
}