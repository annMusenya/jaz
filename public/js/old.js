(function ($) {
    $(document).ready(function () {
        let pages = $("input[name='pages']").val();
        let ppt = $("input[name='charts']").val();
        let charts = $("input[name='powerpoint_slides']").val();
        let sources = $("input[name='references']").val();
        let spacing = $("input[name='spacing']:checked").val();
        let academicLevel = $("select[name='academic_level']").val();
        let progressive = 0.00;
        let amount = 0.00;
        let pptCost = 0.00;
        let chartCost = 0.00;
        let writer = $("input[name='writer']:checked").val();
        let additionals = 0.00; let deadlinePrice = 0.00; let wordCountTotal = 0; let wordCount = 275; let wordsMultiplier = 1;

        $.getJSON('/system/api', function(data){
            let documents = data["documents"];
            let level = data["academic"];
            let paperType = $("input[name='paper']").val();

            let academicLevel = $("input[name='academic_level']").val();
            let deadlinePeriods = data["deadline"];

            console.log(academicLevel);
            switch (academicLevel){
                case "45":
                    for(let i = 0; i <= 7; i++){
                        let highSchool = deadlinePeriods[i];
                        let hours = highSchool["hours"];
                        let deadline = highSchool["description"];          
                        $("select[name='deadline']").append("<option class='high-school' value='" + hours + "'>" + deadline + "</option>");    
                    }
                break;
                case "46":
                    for(let i = 8; i <= 14; i++){
                        let underGrad1 = deadlinePeriods[i];
                        let hours = underGrad1["hours"];
                        let deadline = underGrad1["description"];          
                        $("select[name='deadline']").append("<option class='high-school' value='" + hours + "'>" + deadline + "</option>");    
                    }
                break;
            }

            
            
        });
        

        $('#addPages').click(function () {
            pages++;
            $("input[name='pages']").val(pages);
            numberOfWords();
            calculatePrice(pages,additionals,progressive);
            calculateAdditionalCost();
        });

        $('#minusPages').click(function () {
            pages--;
            if (pages > 1) {
                $("input[name='pages']").val(pages);
            } else {
                pages = 0;
                $("input[name='pages']").val(pages);
            }
            numberOfWords();
            calculatePrice(pages,additionals,progressive);
            calculateAdditionalCost();
        });
        
        $('#addPPT').click(function () {
            ppt++;
            $("input[name='powerpoint_slides']").val(ppt);
            calculatePrice(pages,additionals,progressive);
        });

        $('#minusPPT').click(function () {
            ppt--;
            if (ppt >= 1) {
                $("input[name='powerpoint_slides']").val(ppt);
            } else {
                ppt = 0;
                $("input[name='powerpoint_slides']").val(ppt);
            }
            calculatePrice(pages,additionals,progressive);
        });
        
        $('#addCharts').click(function () {
            charts++;
            $("input[name='charts']").val(charts);
            calculatePrice(pages,additionals,progressive);
        });

        $('#minusCharts').click(function () {
            charts--;
            if (charts >= 1) {
                $("input[name='charts']").val(charts);
            } else {
                charts = 0;
                $("input[name='charts']").val(charts);
            }
            calculatePrice(pages,additionals,progressive);
        });

        $("input[name='word_spacing']").click(function () {
            spacing = $("input[name='word_spacing']:checked").val();
            if (spacing == "single") {
                wordsMultiplier = 2;
            } else if (spacing == "double") {
                wordsMultiplier = 1;
            }
            numberOfWords();
            calculatePrice(pages,additionals,progressive);
        });

        $("input[name='writer']").click(function () {
            writer = $("input[name='writer']:checked").val();
            calculatePrice(pages,additionals,progressive);
        });

        function numberOfWords() {
            let total = (wordCount * wordsMultiplier) * pages;
            wordCountTotal = total;
            $('.number-of-words').html(total + " Words");
        }
        numberOfWords();

        $('#addSources').click(function () {
            sources++;
            $("input[name='references']").val(sources);
        });

        $('#minusSources').click(function () {
            sources--;
            if (sources > 0) {
                $("input[name='references']").val(sources);
            } else {
                sources = 0;
                $("input[name='references']").val(sources);
            }
        });
       
        

        function calculateDeadline() {
            let hours = $("select[name='deadline']").val();
            let deadline = moment().add(hours, 'hours').valueOf();
            let deadlinePeriod = moment().add(hours, 'hours').format('h:mm a, MMMM Do YYYY');
            $('.deadline-period').html(deadlinePeriod + ".");
            $("input[name='deadline_period']").val(deadline);
        }
        calculateDeadline();

        $("select[name='academic_level']").click(function () {
            deadlines();
            calculateDeadline();
            calculatePrice(pages,additionals,progressive);
        });

        $("select[name='deadline']").change(function () {
            calculateDeadline();
        });

        $("select[name='deadline']").change(function () {
            calculateDeadline();
            calculatePrice(pages,additionals,progressive);
        });

        function calculateAdditionalCost(){
                let samplesCost = 0.00; let sourcesCost = 0.00;
                let samples = $("input[name='writer_samples']").prop("checked");
                let sources = $("input[name='writer_sources']").prop("checked");

                if(samples){
                    samplesCost = 5.00;
                }
                if(sources){
                    sourcesCost = 10.00;
                }

                return additionals = (plagiarismCost + powerpointCost + excelCost);
        }

        $("input[name='progressive_delivery']").click(function(){
            calculatePrice(pages,additionals,progressive);
        });

        $("input[name='plagiarism']").click(function(){
            calculateAdditionalCost();
            calculatePrice(pages,additionals,progressive);
        });

        $("input[name='powerpoint']").click(function(){
            calculateAdditionalCost();
            calculatePrice(pages,additionals,progressive);
        });

        $("input[name='xlsx']").click(function(){
            calculateAdditionalCost();
            calculatePrice(pages,additionals,progressive);
        });

        $("select[name='ppt'],select[name='excel']").change(function(){
            calculateAdditionalCost();
            calculatePrice(pages,additionals,progressive);
        });

        $("input[name='progress_delivery']").click(function(){
            let progressDeliveryChecked = $("input[name='progress_delivery']").prop("checked");
            if(progressDeliveryChecked){
                progressive = (normalCost + pptCost + chartCost + additionals) * 0.1;
            }
        });

        function calculatePrice(pages,additionals,progressive) {
            let academic = pricing["levels"];
            let deadline = pricing["deadlines"];
            academicCost = 0.00;
            let hours = $("select[name='deadline']").val();
            let deadlineCost;
            
            switch (academicLevel) {
                case "45":
                    academicCost = academic[0]["rate"];
                    amount = academicCost;
                    deadlineCost = deadline[0];
                    switch (hours) {
                        case "336":
                            deadlinePrice = deadlineCost[0]["rate"];
                            break;
                        case "168":
                            deadlinePrice = deadlineCost[1]["rate"];
                            break;
                        case "120":
                            deadlinePrice = deadlineCost[2]["rate"];
                            break;
                        case "72":
                            deadlinePrice = deadlineCost[3]["rate"];
                            break;
                        case "48":
                            deadlinePrice = deadlineCost[4]["rate"];
                            break;
                        case "24":
                            deadlinePrice = deadlineCost[5]["rate"];
                            break;
                        case "8":
                            deadlinePrice = deadlineCost[6]["rate"];
                            break;
                        case "4":
                            deadlinePrice = deadlineCost[7]["rate"];
                    }
                    break;
                case "46":
                    academicCost = academic[1]["rate"];
                    amount = academicCost;
                    deadlineCost = deadline[1];
                    switch (hours) {
                        case "336":
                            deadlinePrice = deadlineCost[0]["rate"];
                            break;
                        case "168":
                            deadlinePrice = deadlineCost[1]["rate"];
                            break;
                        case "120":
                            deadlinePrice = deadlineCost[2]["rate"];
                            break;
                        case "72":
                            deadlinePrice = deadlineCost[3]["rate"];
                            break;
                        case "48":
                            deadlinePrice = deadlineCost[4]["rate"];
                            break;
                        case "24":
                            deadlinePrice = deadlineCost[5]["rate"];
                            break;
                        case "8":
                            deadlinePrice = deadlineCost[6]["rate"];
                            break;
                        case "4":
                            deadlinePrice = deadlineCost[7]["rate"];
                    }
                    break;
                case "47":
                    academicCost = academic[2]["rate"];
                    amount = academicCost;
                    deadlineCost = deadline[2];
                    switch (hours) {
                        case "336":
                            deadlinePrice = deadlineCost[0]["rate"];
                            break;
                        case "168":
                            deadlinePrice = deadlineCost[1]["rate"];
                            break;
                        case "120":
                            deadlinePrice = deadlineCost[2]["rate"];
                            break;
                        case "72":
                            deadlinePrice = deadlineCost[3]["rate"];
                            break;
                        case "48":
                            deadlinePrice = deadlineCost[4]["rate"];
                            break;
                        case "24":
                            deadlinePrice = deadlineCost[5]["rate"];
                            break;
                        case "8":
                            deadlinePrice = deadlineCost[6]["rate"];
                            break;
                        case "4":
                            deadlinePrice = deadlineCost[7]["rate"];
                    }
                    break;
                case "48":
                    academicCost = academic[3]["rate"];
                    amount = academicCost;
                    deadlineCost = deadline[3];
                    switch (hours) {
                        case "336":
                            deadlinePrice = deadlineCost[0]["rate"];
                            break;
                        case "168":
                            deadlinePrice = deadlineCost[1]["rate"];
                            break;
                        case "120":
                            deadlinePrice = deadlineCost[2]["rate"];
                            break;
                        case "72":
                            deadlinePrice = deadlineCost[3]["rate"];
                            break;
                        case "48":
                            deadlinePrice = deadlineCost[4]["rate"];
                            break;
                        case "24":
                            deadlinePrice = deadlineCost[5]["rate"];
                            break;
                        case "8":
                            deadlinePrice = deadlineCost[6]["rate"];
                            break;
                        case "4":
                            deadlinePrice = deadlineCost[7]["rate"];
                    }
                    break;
                case "49":
                    academicCost = academic[4]["rate"];
                    amount = academicCost;
                    deadlineCost = deadline[4];
                    switch (hours) {
                        case "336":
                            deadlinePrice = deadlineCost[0]["rate"];
                            break;
                        case "168":
                            deadlinePrice = deadlineCost[1]["rate"];
                            break;
                        case "120":
                            deadlinePrice = deadlineCost[2]["rate"];
                            break;
                        case "72":
                            deadlinePrice = deadlineCost[3]["rate"];
                            break;
                        case "48":
                            deadlinePrice = deadlineCost[4]["rate"];
                            break;
                        case "24":
                            deadlinePrice = deadlineCost[5]["rate"];
                            break;
                        case "8":
                            deadlinePrice = deadlineCost[6]["rate"];
                            break;
                        case "4":
                            deadlinePrice = deadlineCost[7]["rate"];
                    }
            }
            if (spacing == "single") {
                amount = (amount * 2);
            }
            if (writer == "advanced") {
                amount = amount + (amount * 0.25);
            }

            let normalCost = ((amount * pages) + deadlinePrice);
            let costSinglePage = (amount + deadlinePrice);

            if(ppt >= 1){
                pptCost = (costSinglePage/2) * ppt;
                $(".slides").removeClass("hidden");
                $(".additional-slides").html("+ $"+pptCost);
            }else{
                pptCost = 0.00;
                $(".slides").addClass("hidden");
                $(".additional-slides").html("+ $"+pptCost);
            }
            
            if(charts >= 1){
                chartCost = (costSinglePage/2) * charts;
                $(".charts").removeClass("hidden");
                $(".additional-charts").html("+ $"+chartCost);
            }else{
                chartCost = 0.00;
                $(".charts").addClass("hidden");
                $(".additional-charts").html("+ $"+chartCost);
            }

            if(pages > 0){
                $(".order").removeClass("hidden");
                $(".order").html(pages + " pages  X $" +costSinglePage+'<span class="normal-cost text-danger h5 ml-3"> $'+normalCost+'</span>');
            }else{
                $(".order").addClass("hidden");
            }

            if(pages > 19){
                $("input[name='progressive_delivery']").removeAttr("disabled");
                $("input[name='progressive_delivery']").prop("checked",true);
                $("#written-text").removeClass("text-gray-300");
                $("#costValue").removeClass("text-gray-300");
                $("#costValue").addClass("text-primary");
                progressive = (normalCost + pptCost + chartCost + additionals) * 0.1;
            }else{
                $("input[name='progressive_delivery']").attr("disabled",true);
                $("input[name='progressive_delivery']").prop("checked",false);
                $("#written-text").addClass("text-gray-300");
                $("#costValue").addClass("text-gray-300");
                $("#costValue").removeClass("text-primary");
                progressive = 0.00;
            }

            let grandTotal = (normalCost + pptCost + chartCost + additionals + progressive).toFixed(2);
            
            $("#grandTotal").val(grandTotal);

            return $('.grandTotal').html('$' + grandTotal);
        }
        
        calculatePrice(pages,additionals,progressive);

    })
})(jQuery);