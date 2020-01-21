(function ($) {
    
    $(document).ready(function () {
        $.getJSON('/system/api', function(data){
            let level = data["academic"];
            let deadlinePeriods = data["deadline"];
            let pages = $("input[name='pages']").val();
            let references = 0.00;
            let writerCost = 0.00;
            let powerpoint = 0.00;
            let charts = 0.00;
            let samples = 0.00;
            let sources = 0.00;
            let progressive = 0.00;
            let writerTotal = 0.00;
            let complexAssignment = 0.00;
            let grandTotal = 0.00;

            function orderCost(pages,powerpoint,charts,samples,sources,progressive,writerCost){
                let academicLevel = $("select[name='academic_level']").val();
                let deadlineValue = $("select[name='deadline']").val();
                let spacing = $("input[name='word_spacing']:checked").val();
                let basicRate = 0.00;
                let deadlineRateArr = [];
                let deadlineRate = 0.00;
                let ppt = $("input[name='powerpoint_slides']").val();
                let chrts = $("input[name='charts']").val();
				let basicPay = 0.00;

                switch (academicLevel){
                    case "45":
                        basicRate = level[0]["rate"];
                        for(let i = 0; i <= 7; i++){
                            deadlineRateArr.push(deadlinePeriods[i]["rate"]);
                        }
                        switch(deadlineValue){
                            case "336":
                                deadlineRate = deadlineRateArr[0];
                            break;
                            case "168":
                                deadlineRate = deadlineRateArr[1];
                            break;
                            case "120":
                                deadlineRate = deadlineRateArr[2];
                            break;
                            case "72":
                                deadlineRate = deadlineRateArr[3];
                            break;
                            case "48":
                                deadlineRate = deadlineRateArr[4];
                            break;
                            case "24":
                                deadlineRate = deadlineRateArr[5];
                            break;
                            case "8":
                                deadlineRate = deadlineRateArr[6];
                            break;
                            case "4":
                                deadlineRate = deadlineRateArr[7];
                        }
                    break;
                    case "46":
                        basicRate = level[1]["rate"];
                        for(let i = 8; i <= 15; i++){
                            deadlineRateArr.push(deadlinePeriods[i]["rate"]);
                        }
                        switch(deadlineValue){
                            case "336":
                                deadlineRate = deadlineRateArr[0];
                            break;
                            case "168":
                                deadlineRate = deadlineRateArr[1];
                            break;
                            case "120":
                                deadlineRate = deadlineRateArr[2];
                            break;
                            case "72":
                                deadlineRate = deadlineRateArr[3];
                            break;
                            case "48":
                                deadlineRate = deadlineRateArr[4];
                            break;
                            case "24":
                                deadlineRate = deadlineRateArr[5];
                            break;
                            case "8":
                                deadlineRate = deadlineRateArr[6];
                            break;
                            case "4":
                                deadlineRate = deadlineRateArr[7];
                        }
                    break;
                    case "47":
                        basicRate = level[2]["rate"];
                        for(let i = 16; i <= 23; i++){
                            deadlineRateArr.push(deadlinePeriods[i]["rate"]);
                        }
                        switch(deadlineValue){
                            case "336":
                                deadlineRate = deadlineRateArr[0];
                            break;
                            case "168":
                                deadlineRate = deadlineRateArr[1];
                            break;
                            case "120":
                                deadlineRate = deadlineRateArr[2];
                            break;
                            case "72":
                                deadlineRate = deadlineRateArr[3];
                            break;
                            case "48":
                                deadlineRate = deadlineRateArr[4];
                            break;
                            case "24":
                                deadlineRate = deadlineRateArr[5];
                            break;
                            case "8":
                                deadlineRate = deadlineRateArr[6];
                            break;
                            case "4":
                                deadlineRate = deadlineRateArr[7];
                        }
                    break;
                    case "48":
                        basicRate = level[3]["rate"];
                        for(let i = 24; i <= 31; i++){
                            deadlineRateArr.push(deadlinePeriods[i]["rate"]);
                        }
                        switch(deadlineValue){
                            case "336":
                                deadlineRate = deadlineRateArr[0];
                            break;
                            case "168":
                                deadlineRate = deadlineRateArr[1];
                            break;
                            case "120":
                                deadlineRate = deadlineRateArr[2];
                            break;
                            case "72":
                                deadlineRate = deadlineRateArr[3];
                            break;
                            case "48":
                                deadlineRate = deadlineRateArr[4];
                            break;
                            case "24":
                                deadlineRate = deadlineRateArr[5];
                            break;
                            case "8":
                                deadlineRate = deadlineRateArr[6];
                            break;
                            case "4":
                                deadlineRate = deadlineRateArr[7];
                        }
                    break;
                    case "49":
                        basicRate = level[4]["rate"];
                        for(let i = 32; i <= 39; i++){
                            deadlineRateArr.push(deadlinePeriods[i]["rate"]);
                        }
                        switch(deadlineValue){
                            case "336":
                                deadlineRate = deadlineRateArr[0];
                            break;
                            case "168":
                                deadlineRate = deadlineRateArr[1];
                            break;
                            case "120":
                                deadlineRate = deadlineRateArr[2];
                            break;
                            case "72":
                                deadlineRate = deadlineRateArr[3];
                            break;
                            case "48":
                                deadlineRate = deadlineRateArr[4];
                            break;
                            case "24":
                                deadlineRate = deadlineRateArr[5];
                            break;
                            case "8":
                                deadlineRate = deadlineRateArr[6];
                            break;
                            case "4":
                                deadlineRate = deadlineRateArr[7];
                        }
                }
				
				basicPay = parseFloat(parseFloat(basicRate) + parseFloat(deadlineRate)).toFixed(2);
			
                if(spacing == "single"){
                    pages *= 2;
                }
                
                if(ppt >= 1){
                    powerpoint = ((basicPay)/2) * ppt;
                }

                if(chrts >= 1){
                    charts = ((basicPay)/2) * chrts;
                }


                // Summary

                switch(academicLevel){
                    case "45":
                        $(".level-summary").text("High School");
                    break;
                    case "46":
                        $(".level-summary").text("Undergraduate (Years 1-2)");
                    break;
                    case "47":
                        $(".level-summary").text("Undergraduate (Years 3-4)");
                    break;
                    case "48":
                        $(".level-summary").text("Masters");
                    break;
                    case "49":
                        $(".level-summary").text("Doctoral");
                }
                
                if(pages > 0){
                    $(".pages-summary").removeClass("hidden");
                    $(".pages").text(pages + " Pages");
                    let costPerPage = basicPay;
                    let basicCost = costPerPage * pages;
                    $(".cost-per-page").html("$"+costPerPage);
                    $(".pages-cost").html("<strong>$"+ parseFloat(basicCost).toFixed(2) +"</strong>");
                }else{
                    $(".pages-summary").addClass("hidden");
                }

                if(ppt > 0){
                    $(".ppt-summary").removeClass("hidden");
                    $(".ppt").text(ppt+" slides");
                    $(".cost-per-ppt").html("$"+(basicPay/2).toFixed(2));
                    $(".ppt-cost").html("<strong>$"+parseFloat(powerpoint).toFixed(2)+"</strong>");
                }else{
                    $(".ppt-summary").addClass("hidden");
                }

                if(chrts>0){
                    $(".charts-summary").removeClass("hidden");
                    $(".charts").text(chrts+" charts");
                    $(".cost-per-chart").html("$"+(basicPay/2).toFixed(2));
                    $(".charts-cost").html("<strong>$"+parseFloat(charts).toFixed(2)+"</strong>");
                }else{
                    $(".charts-summary").addClass("hidden");
                }

                if($("input[name='writer_samples']").prop("checked")){
                    samples = 5.00;
                    $(".samples-summary").removeClass("hidden");
                    $(".samples-cost").html("<strong>$"+parseFloat(samples).toFixed(2)+"</strong>");
                }else{
                    $(".samples-summary").addClass("hidden");
                }

                if($("input[name='writer_sources']").prop("checked")){
                    sources = 10.00;
                    $(".sources-summary").removeClass("hidden");
                    $(".sources-cost").html("<strong>$"+parseFloat(sources).toFixed(2)+"</strong>");
                }else{
                    $(".sources-summary").addClass("hidden");
                }

                if($("input[name='progressive_delivery']").prop("checked")){
                    progressive = (basicPay * pages) * 0.1;
                    $(".progressive-summary").removeClass("hidden");
                    $(".progressive-cost").html("<strong>$"+parseFloat(progressive).toFixed(2)+"</strong>");
                }else{
                    $(".progressive-summary").addClass("hidden");
                }

                let writerCategory = $("input[name='writer']:checked").val();
                
                if(writerCategory == "top-writer"){
                    writerCost = ((basicPay * pages) + powerpoint + charts + samples + sources + progressive ) * 0.25;
                    if(writerCost > 0.00){
                        $(".writer-summary").removeClass("hidden");
                        $(".writer-cost").html("<strong>$"+writerCost.toFixed(2)+"</strong>");
                    }
                }else{
                    $(".writer-summary").addClass("hidden");
                }

                let subject = $("select[name='subject']").find("option:selected").attr("category");

                if(subject  == "complex"){
                    complexAssignment = (((basicPay) * pages) + powerpoint + charts) * 0.2;
                    $(".complex-summary").removeClass("hidden");
                    $(".complex-cost").html("<strong>$"+complexAssignment.toFixed(2)+"</strong>");
                }else{
                    $(".complex-summary").addClass("hidden");
                    complexAssignment = 0.00;
                }

                let writerConsideration = basicPay;
                
                if(writerConsideration <= 6){
                    let basicWriterPay = basicPay * 0.5;
                    let powerPointPay = ppt * 1.2;
                    let chartsPay = chrts * 1.2;
                    let pagesCount = $("input[name='pages']").val();

                    writerTotal = (basicWriterPay * pagesCount) + powerPointPay + chartsPay;
                }else if(writerConsideration >= 7 && writerConsideration <= 15 ){
                    let basicWriterPay = 3.0;
                    let powerPointPay = ppt * 1.2;
                    let chartsPay = chrts * 1.2;
                    let pagesCount = $("input[name='pages']").val();

                    writerTotal = (basicWriterPay * pagesCount) + powerPointPay + chartsPay;
                }else if(writerConsideration >= 16 && writerConsideration <= 20){
                    let basicWriterPay = 4.0;
                    let powerPointPay = ppt * 1.2;
                    let chartsPay = chrts * 1.2;
                    let pagesCount = $("input[name='pages']").val();

                    writerTotal = (basicWriterPay * pagesCount) + powerPointPay + chartsPay;
                }else if(writerConsideration >= 21 && writerConsideration <= 25){
                    let basicWriterPay = 5.0;
                    let powerPointPay = ppt * 1.2;
                    let chartsPay = chrts * 1.2;
                    let pagesCount = $("input[name='pages']").val();

                    writerTotal = (basicWriterPay * pagesCount) + powerPointPay + chartsPay;
                }else if(writerConsideration >= 26){
                    let basicWriterPay = (basicRate+deadlineRate) * 0.2;
                    let powerPointPay = ppt * 1.2;
                    let chartsPay = chrts * 1.2;
                    let pagesCount = $("input[name='pages']").val();

                    writerTotal = (basicWriterPay * pagesCount) + powerPointPay + chartsPay;
                }else{
                    writerTotal = 0.00;
                } 
				
                grandTotal = parseFloat((basicPay * pages) + powerpoint + charts + samples + sources + progressive + writerCost + complexAssignment).toFixed(2);
                
                $("input[name='writer_amount']").val(writerTotal);
                $("input[name='price_amount']").val(grandTotal);

                if(grandTotal <= 0.00){
                    $("#proceed-btn").addClass("hidden");
                }else{
                    $("#proceed-btn").removeClass("hidden");
                }
                
                return $('.grandTotal').html('$' + grandTotal);

            }

            orderCost(pages,powerpoint,charts,samples,sources,progressive,writerCost);

            $("select[name='subject']").change(function(){
                orderCost(pages,powerpoint,charts,samples,sources,progressive,writerCost);
            });

            // End of Cost Calculator

            $('#addPages').click(function () {
                pages++;
                $("input[name='pages']").val(pages);
                if(pages > 19){
                    $("input[name='progressive_delivery']").removeAttr("disabled");
                    $("input[name='progressive_delivery']").prop("checked",true);
                    $("#written-text").removeClass("text-gray-300");
                    $("#costValue").removeClass("text-gray-300");
                    $("#costValue").addClass("text-primary"); 
                }
                numberOfWords();
                orderCost(pages,powerpoint,charts,samples,sources,progressive,writerCost);
            });
    
            $('#minusPages').click(function () {
                pages--;
                if (pages >= 1) {
                    $("input[name='pages']").val(pages);
                } else {
                    pages = 0;
                    $("input[name='pages']").val(pages);
                }
                if (pages < 20){
                    $("input[name='progressive_delivery']").prop("disabled",true);
                    $("input[name='progressive_delivery']").prop("checked",false);
                    $("#written-text").addClass("text-gray-300");
                    $("#costValue").addClass("text-gray-300");
                    $("#costValue").removeClass("text-primary"); 
                }
                numberOfWords();
                orderCost(pages,powerpoint,charts,samples,sources,progressive,writerCost);
            });
    
            $('#addSources').click(function () {
                references++;
                $("input[name='references']").val(references);
            });
    
            $('#minusSources').click(function () {
                references--;
                if (references > 0) {
                    $("input[name='references']").val(references);
                } else {
                    references = 0;
                    $("input[name='references']").val(references);
                }
            });
    
            $('#addPPT').click(function () {
                powerpoint++;
                $("input[name='powerpoint_slides']").val(powerpoint);
                orderCost(pages,powerpoint,charts,samples,sources,progressive,writerCost);
            });
    
            $('#minusPPT').click(function () {
                powerpoint--;
                if (powerpoint > 0) {
                    $("input[name='powerpoint_slides']").val(powerpoint);
                } else {
                    powerpoint = 0;
                    $("input[name='powerpoint_slides']").val(powerpoint);
                }
                orderCost(pages,powerpoint,charts,samples,sources,progressive,writerCost);
            });
    
            $('#addCharts').click(function () {
                charts++;
                $("input[name='charts']").val(charts);
                orderCost(pages,powerpoint,charts,samples,sources,progressive,writerCost);
            });
    
            $('#minusCharts').click(function () {
                charts--;
                if (charts > 0) {
                    $("input[name='charts']").val(charts);
                } else {
                    charts = 0;
                    $("input[name='charts']").val(charts);
                }
                orderCost(pages,powerpoint,charts,samples,sources,progressive,writerCost);
            });
    
            function numberOfWords() {
                let spacing = $("input[name='word_spacing']:checked").val();
                let total = 0;
                if(spacing == "single"){
                    let wordCount = 550;
                    total = wordCount * pages;
                }else if(spacing == "double"){
                    let wordCount = 275;
                    total = wordCount * pages;
                }
                $('.number-of-words').html(total + " Words");
            }
            numberOfWords();

    
            $("input[name='word_spacing']").change(function(){
                numberOfWords();
                orderCost(pages,powerpoint,charts,samples,sources,progressive,writerCost);
            });

            function calculateDeadline() {
                let hours = $("select[name='deadline']").val();
                let writerHours = hours/2;
                let deadline = moment().add(hours, 'hours').valueOf();
                let writerDeadline = moment().add(writerHours, 'hours').valueOf();
                let deadlinePeriod = moment().add(hours, 'hours').format('h:mm a, MMMM Do YYYY');
                $('.deadline-period').html(deadlinePeriod + ".");
                $(".deadline-summary").text(" "+deadlinePeriod+ ".");
                $("input[name='writer_deadline']").val(writerDeadline);
                return $("input[name='deadline_period']").val(deadline);
            }
            calculateDeadline();

            $("select[name='academic_level'],select[name='deadline'],input[name='writer']").change(function(){
                calculateDeadline();
                orderCost(pages,powerpoint,charts,samples,sources,progressive,writerCost);
            });

            $("input[name='writer_samples'],input[name='writer_sources'],input[name='progressive_delivery']").click(function(){
                orderCost(pages,powerpoint,charts,samples,sources,progressive,writerCost);
            });
		
        });
        
    })
})(jQuery);