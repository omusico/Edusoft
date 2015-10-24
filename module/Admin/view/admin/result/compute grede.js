var _btnmes = "<br><br><div class='text-right'><button type='button' id='okBtn' class='btn btn-primary btn-sm'>Ok</button><button type='button' id='cancelBtn' class='btn btn-sm btn-info' style='margin: 0 8px 0 8px'>Cancel</button></div>", _ids, _classes = [], _scoreset = [], names = [], gInfo = null, nextEntry = 0, startEntry = 0, totalEntry = 0, displaySize = 50, prevState = false, nextState = false, title = "", usertype = 0, typeid = 1;
function setupFunc3() {
    getUser();
    getClasses();
    $('input[name="typeid"]').change(function() {
        $this = $(this);
       
        typeid = parseInt($this.attr('value'));
        
        getClasses();
    });
    $(".invr").click(function() {
        if (gInfo !== null && gInfo.istudids.length > 0) {
            uncheckall();
            $('#invrecords').modal('show');
        }
    });
    $(".cleanup").click(function() {
        if (gInfo !== null && gInfo.studids.length > 0) {
            if (gInfo.approval == 1) {
                alertBox("info", "Sorry!, the set of records had been approved already.");
                return;
            }
            confirmBox("This action is irreversible. Are you sure about wiping the entire set of grades?" + _btnmes, runWipeClean);
        }
    });
}
function runWipeClean() {
    iml2(".cleanup");
    ajaxCall("text", "post", usp.academic.gr[0], "wipeclean=" + gInfo.datasearch + "|" + gInfo.studids, function(x) {
        if (x.trim().length > 0) {
            if (x !== "-1") {
                alertBox("success", x + " grades wiped out successfully");
                $("#thead").html("");
                $("#tbody").html("");
                $("#nocontent").show();
                $("#page_info").addClass("text-danger");
                $("#page_info").html("Showing 0 to 0 of 0 entries");
                $("#cavg").html("0.00%");
                gInfo.studids = [];
                gInfo.students = [];
                gInfo.classes = [];
                gInfo.scores = [];
                gInfo.approval = 0;
                if (usertype == 1) {
                    if (gInfo.approval == 0) {
                        $("#ap").html("<input class='checkbox style-2' type='checkbox' id='approval' onchange='setApproval();'><span></span>Approved");
                    } else {
                        $("#ap").html("<input class='checkbox style-2' type='checkbox' id='approval' onchange='setApproval();' checked=''><span></span>Approved");
                    }
                } else {
                    if (gInfo.approval == 0) {
                        $("#op").html("<span class='txt-color-red fa fa-lg fa-times-circle'></span> Approved");
                    } else {
                        $("#op").html("<span class='txt-color-green fa fa-lg fa-check-circle'></span> Approved");
                    }
                }
            } else {
                alertBox("error", "Grades could not be wiped out. Please check your server/network connection");
            }
        }
    }, true, 0);
}
function uncheckall() {
    var checkState = document.getElementById("checkall"), checkStuds = document.getElementsByClassName("irselect");
    for (var i = 0; i < checkStuds.length; i++) {
        checkStuds[i].checked = false;
    }
    if ($("#checkall").prop("checked")) {
        $("#checkall").removeAttr("checked");
    }
}
function resetData() {
    gInfo = null;
    nextEntry = 0;
    startEntry = 0;
    totalEntry = 0;
    prevState = false;
    nextState = false;
    $("#nextid").children("a").removeAttr("onclick");
    $("#previd").children("a").removeAttr("onclick");
    $("#nextid").addClass("disabled");
    $("#previd").addClass("disabled");
    title = "";
    usertype = 0;
    typeid = 1;
    $("#thead").html("");
    $("#tbody").html("");
    $("#subteh").html("");
    $("#nocontent").show();
    $("#thead2").html("");
    $("#tbody2").html("");
    $("#nocontent2").show();
    $("#page_info2").html("0");
    $("#page_info").addClass("text-danger");
    $("#page_info").html("Showing 0 to 0 of 0 entries");
    $("#previd").addClass("disabled");
    $("#previd").children("a").removeAttr("onclick");
    $("#nextid").addClass("disabled");
    $("#nextid").children("a").removeAttr("onclick");
    $("#cavg").html("0.00%");
    $(".invr").removeClass("bg-color-red");
    $(".invr").addClass("bg-color-blue");
    $(".invr").children("b").html(0);
    $("#course").html("<option value='0'>Courses</option>");
    $(".pri").addClass("active");
    $(".jnr").removeClass("active");
    $(".snr").removeClass("active");
    $("#approval").removeAttr("checked");
    $(".smail").attr("onclick", "sendMail2('','','','',3);");
    $("input[name='class']").val(0);
    $("input[name='subject']").val("");
    getUser();
    getClasses();
}
function data(tag, index, p) {
    document.getElementsByClassName(tag)[index].setAttribute("aria-valuetransitiongoal", p);
    document.getElementsByClassName(tag)[index].setAttribute("aria-valuenow", p);
    $('.progress-bar').progressbar({display_text: 'fill'});
}
function getUser() {
    ajaxCall("text", "post", usp.academic.gr[0], "getuser=ut", function(x) {
        if (x.trim().length > 0) {
            usertype = x;
            if (usertype != 1) {
                $("#apsection").hide();
                $("#opsection").show();
            } else {
                $("#apsection").show();
                $("#opsection").hide();
            }
        }
    }, false, 0);
}
function loadData() {
    var goAhead = 0;
    if ($("#class").val() !== "0") {
        if ($("#course").val() !== "0") {
            goAhead = 1;
        } else {
            alertBox("info", "Please select a course");
        }
    } else {
        alertBox("info", "Please select a class");
    }
    if (goAhead == 1) {
        var package = $("#class").val().split(",")[0] + "," + $("#course").val() + "," + $("#class").val().split(",")[1];
        ajaxCall("text", "post", usp.academic.gr[0], "loaddata=" + package, function(x) {
            if (x.trim().length > 0 && /^[0-9]/.test(x.substr(0, 1))) {
                processgrades(x);
            } else {
                setGradeTitle("");
                if (usertype == 1) {
                    $("#ap").html("<input type='checkbox' class='checkbox style-2' id='approval' onchange='setApproval();'><span></span>Approved");
                } else {
                    $("#op").html("<span class='txt-color-red fa fa-lg fa-times-circle'></span> Approved");
                }
                $(".invr").removeClass("bg-color-red");
                $(".invr").addClass("bg-color-blue");
                $(".invr").children("b").html(0);
                gInfo = null;
                $("#nocontent").show();
                $("#nocontent1").show();
                $("#tbody").html("");
                $("#thead").html("");
                $("#tbody2").html("");
                $("#thead2").html("");
                $("#page_info").addClass("text-danger");
                $("#page_info").html("Showing 0 to 0 of 0 entries");
                $("#page_info2").html(0);
                $(".smail").attr("onclick", "sendMail2('','','','',3);");
                alertBox("info", x);
            }
        }, true, 1);
    }
}
function processgrades(x) {
    var result = x.split("|");
    gInfo = new Object();
    gInfo.datasearch = result[0].split(",");
    gInfo.caexamsystem = result[1].split(";");
    gInfo.title = result[2];
    gInfo.students = result[3].trim().length > 0 ? result[3].split(";") : [];
    gInfo.studids = result[4].trim().length > 0 ? result[4].split(";") : [];
    gInfo.scores = result[5].trim().length > 0 ? result[5].split(";") : [];
    gInfo.classes = result[6].trim().length > 0 ? result[6].split(";") : [];
    gInfo.istudents = result[7].trim().length > 0 ? result[7].split(";") : [];
    gInfo.istudids = result[8].trim().length > 0 ? result[8].split(";") : [];
    gInfo.iscores = result[9].trim().length > 0 ? result[9].split(";") : [];
    gInfo.iclasses = result[10].trim().length > 0 ? result[10].split(";") : [];
    gInfo.itreated = [];
    gInfo.approval = parseInt(result[11]);
    gInfo.teachers = result[12].trim().length > 0 ? result[12].split(";") : [];
    if (usertype == 1) {
        if (gInfo.approval == 0) {
            $("#ap").html("<input class='checkbox style-2' type='checkbox' id='approval' onchange='setApproval();'><span></span>Approved");
        } else {
            $("#ap").html("<input class='checkbox style-2' type='checkbox' id='approval' onchange='setApproval();' checked=''><span></span>Approved");
        }
    } else {
        if (gInfo.approval == 0) {
            $("#op").html("<span class='txt-color-red fa fa-lg fa-times-circle'></span> Approved");
        } else {
            $("#op").html("<span class='txt-color-green fa fa-lg fa-check-circle'></span> Approved");
        }
    }
    nextEntry = 0;
    startEntry = 0;
    prevState = false;
    nextState = false;
    totalEntry = 0;
    $("#nextid").children("a").removeAttr("onclick");
    $("#previd").children("a").removeAttr("onclick");
    $("#nextid").addClass("disabled");
    $("#previd").addClass("disabled");
    if (gInfo.iscores.length > 0) {
        $(".invr").removeClass("bg-color-blue");
        $(".invr").addClass("bg-color-red");
    } else {
        $(".invr").removeClass("bg-color-red");
        $(".invr").addClass("bg-color-blue");
    }
    $(".invr").children("b").html(gInfo.iscores.length);
    setGradeTitle(gInfo.title);
    var h = "", ids = "", emails = "", phones = "", users = "";
    if (gInfo.teachers.length > 0) {
        var z, l = gInfo.teachers.length;
        z = gInfo.teachers[0].split(",");
        ids = z[0];
        emails = z[1];
        phones = z[2];
        users = z[3];
        h = z[3];
        for (var B = 1; B < l; B++) {
            z = gInfo.teachers[B].split(",");
            h += (((B + 1) === l) ? " and " : ", ") + z[3];
            ids += "," + z[0];
            emails += "," + z[1];
            phones += "," + z[2];
            users += "," + z[3];
        }
        $("#subteh").html("Subject Teachers: " + h);
    } else {
        $("#subteh").html("");
    }
    $(".smail").attr("onclick", "sendMail2('" + ids + "','" + emails + "','" + phones + "','" + users + "',3);");
    totalEntry = gInfo.students.length;
    var casystem = gInfo.caexamsystem, canames = casystem[0].split(","), cascores = casystem[1].split(","), casum;
    $("#tbody").html("");
    $("#thead").html("");
    $("#nocontent").show();
    $("#page_info").addClass("text-danger");
    $("#page_info").html("Showing 0 to 0 of 0 entries");
    if (totalEntry > 0) {
        $("#nocontent").hide();
        casum = 0;
        var tr1 = "<th>First Name</th><th>Last Name</th><th>Registration No.</th><th>Class</th>", tr2;
        for (var header = 0; header < canames.length; header++) {
            tr1 += "<th class='tocenter'> " + canames[header] + " (" + cascores[header] + ")" + " </th>";
            casum += parseInt(cascores[header]);
        }
        tr1 += "<th class='tocenter'>Exams (" + (100 - casum) + ")</th><th class='tocenter'>Total (/100)</th>";
        tr1 += "<th>Completed</th>";
        var stud, trHead = document.createElement("tr"), headerContent = document.getElementById("thead"), bodyContent = document.getElementById("tbody");
        trHead.innerHTML = tr1;
        headerContent.appendChild(trHead);
        var counter, scores, completed, approved, readonly = "", offered;
        for (var student = startEntry; student < gInfo.students.length; student++) {
            tr2 = document.createElement("tr");
            completed = 0;
            // keep state of course offered
            offered = 1;
            stud = gInfo.students[student].split(",");
            tr1 = "<td><span class='txt-color-blue'>" + stud[0] + "</span></td><td><span class='txt-color-blue'>" + stud[1] + "</span></td>" + "<td><span class='txt-color-blue'>" + stud[2] + "</span></td><td><span class='txt-color-blue'><small>" + gInfo.classes[student] + "</small></td>";
            counter = canames.length;
            scores = gInfo.scores[student].split(",");
            readonly = gInfo.approval == 1 ? "readonly='' " : "";
            // check if any field has '*' symbol
            if (scores[scores.length - 2] === "*") {
                offered = 0;
            } else {
                for (var c = 0; c < counter; c++) {
                    if (scores[c] === "*") {
                        offered = 0;
                        break;
                    }
                }
            }
            if (offered == 1) {
                for (var c = 0; c < counter; c++) {
                    if (scores[c] !== "-" && scores[c] !== "*") {
                        completed++;
                    }
                    tr1 += "<td class='tocenter'><input " + readonly + "onchange='computeGrade(" + gInfo.studids[student] + ");' type='text' class='infield test" + gInfo.studids[student] + " input-xs' maxlength='3' size='3' value='" + scores[c] + "'></td>";
                }
                if (scores[scores.length - 2] !== "-") {
                    completed++;
                }
                tr1 += "<td class='tocenter'><input " + readonly + "onchange='computeGrade(" + gInfo.studids[student] + ");' type='text' class='infield exams" + gInfo.studids[student] + " input-xs' maxlength='3' size='3' value='" + scores[scores.length - 2] + "'></td>";
                tr1 += "<td class='tocenter'><input type='text' class='total" + gInfo.studids[student] + " input-xs' maxlength='3' size='3' readonly='' value='" + scores[scores.length - 1] + "/100'></td>" + "<td class='tocenter'><div class='progress progress-striped active no-margin'><div class='pc" + gInfo.studids[student] + " progress-bar progress-bar-primary'></div></div></td>";
            } else {
                for (var c = 0; c < counter; c++) {
                    tr1 += "<td class='tocenter'><input " + readonly + "onchange='computeGrade(" + gInfo.studids[student] + ");' type='text' class='infield test" + gInfo.studids[student] + " input-xs' maxlength='3' size='3' value='*'></td>";
                }
                tr1 += "<td class='tocenter'><input " + readonly + "onchange='computeGrade(" + gInfo.studids[student] + ");' type='text' class='infield exams" + gInfo.studids[student] + " input-xs' maxlength='3' size='3' value='*'></td>";
                tr1 += "<td class='tocenter'><input type='text' class='total" + gInfo.studids[student] + " input-xs' maxlength='3' size='3' readonly='' value='*'></td>" + "<td class='tocenter'><div class='progress progress-striped active no-margin'><div class='pc" + gInfo.studids[student] + " progress-bar progress-bar-primary'></div></div></td>";
            }
            tr2.innerHTML = tr1;
            bodyContent.appendChild(tr2);
            var percentage = completed / (scores.length - 1) * 100;
            data("pc" + gInfo.studids[student], 0, percentage);
            if ((student + 1) % displaySize === 0) {
                break;
            }
            nextEntry++;
        }
        calculateSubjectAverage();
        $("#page_info").removeClass("text-danger");
        $("#page_info").html("Showing <span class='txt-color-darken'>" + (startEntry + 1) + "</span> to <span class='txt-color-darken'>" + ((nextEntry + 1 <= totalEntry) ? nextEntry + 1 : nextEntry) + "</span> of <span class='text-primary'>" + totalEntry + "</span> entries");
        if ((totalEntry - (nextEntry + 1)) > 0) {
            nextEntry++;
            if (!nextState) {
                $("#nextid").removeClass("disabled");
                $("#nextid").children("a").attr("onclick", "getNextData();");
                nextState = !nextState;
            }
        }
    }
    var itotalEntry = gInfo.istudents.length;
    $("#tbody2").html("");
    $("#thead2").html("");
    $("#nocontent2").show();
    $("#page_info2").html(0);
    if (itotalEntry > 0) {
        $("#nocontent2").hide();
        var tr1 = "<th class='smart-form'><label class='checkbox'><input type='checkbox' id='checkall' name='irselect' onchange='checkData();'><i></i></label></th>" + "<th>First Name</th><th>Last Name</th><th>Registration No.</th><th>Class</th>";
        casum = 0;
        for (var header = 0; header < canames.length; header++) {
            tr1 += "<th class='tocenter'> " + canames[header] + " (" + cascores[header] + ")" + " </th>";
            casum += parseInt(cascores[header]);
        }
        tr1 += "<th class='tocenter'>Exams (" + (100 - casum) + ")</th><th class='tocenter'>Total (/100)</th>";
        tr1 += "<th>Completed</th><th class='tocenter'>Treated</th>";
        var istud, trh = document.createElement("tr");
        trh.innerHTML = tr1;
        var thead = document.getElementById("thead2");
        thead.appendChild(trh);
        var tbody = document.getElementById("tbody2"), counter, scores, completed, offered;
        for (var student = 0; student < itotalEntry; student++) {
            gInfo.itreated.push(0);
            tr2 = document.createElement("tr");
            tr2.className = "notreat";
            tr2.setAttribute("id", "igr" + gInfo.istudids[student]);
            completed = 0;
            offered = 1;
            istud = gInfo.istudents[student] = gInfo.istudents[student].split(",");
            tr1 = "<td class='smart-form'><label class='checkbox'><input type='checkbox' name='irselect' class='irselect' value='" + gInfo.istudids[student] + "'><i></i></label></td>" + "<td>" + istud[0] + "</td><td>" + istud[1] + "</td><td>" + istud[2] + "</td><td><small>" + gInfo.iclasses[student] + "</small></td>";
            counter = canames.length;
            scores = gInfo.iscores[student].split(",");
            // check if any field has '*' symbol
            if (scores[scores.length - 2] === "*") {
                offered = 0;
            } else {
                for (var c = 0; c < counter; c++) {
                    if (scores[c] === "*") {
                        offered = 0;
                        break;
                    }
                }
            }
            if (offered == 1) {
                for (var c = 0; c < counter; c++) {
                    if (scores[c] !== "-") {
                        completed++;
                    }
                    tr1 += "<td class='tocenter'>" + scores[c] + "</td>";
                }
                if (scores[scores.length - 2] !== "-") {
                    completed++;
                }
                tr1 += "<td class='tocenter'>" + scores[scores.length - 2] + "</td>";
                tr1 += "<td class='tocenter'>" + scores[scores.length - 1] + "</td>" + "<td class='tocenter'><div class='progress progress-striped active no-margin'><div class='ir" + gInfo.istudids[student] + " progress-bar progress-bar-primary'></div></div></td>";
                tr1 += "<td class='tocenter'><span class='fa fa-times itreated'></span>";
            } else {
                for (var c = 0; c < counter; c++) {
                    tr1 += "<td class='tocenter'>*</td>";
                }
                tr1 += "<td class='tocenter'>*</td>";
                tr1 += "<td class='tocenter'>*</td>" + "<td class='tocenter'><div class='progress progress-striped active no-margin'><div class='ir" + gInfo.istudids[student] + " progress-bar progress-bar-primary'></div></div></td>";
                tr1 += "<td class='tocenter'><span class='fa fa-times itreated'></span>";

            }
            tr2.innerHTML = tr1;
            tbody.appendChild(tr2);
            var percentage = completed / (scores.length - 1) * 100;
            data("ir" + gInfo.istudids[student], 0, percentage);
        }
        $("#page_info2").html(itotalEntry);
    }
}
function getNextData() {
    if (gInfo !== null && gInfo.students.length > 0) {
        $("#tbody").html("");
        var tr1 = "", tr2, casystem = gInfo.caexamsystem, canames = casystem[0].split(","), cascores = casystem[1].split(","), stud, bodyContent = document.getElementById("tbody");
        startEntry = nextEntry;
        var counter, scores, completed, approved, readonly = "", offered;
        for (var student = startEntry; student < gInfo.students.length; student++) {
            tr1 = "";
            tr2 = document.createElement("tr");
            completed = 0;
            offered = 1;
            stud = gInfo.students[student].split(",");
            tr1 += "<td><span class='txt-color-blue'>" + stud[0] + "</span></td><td><span class='txt-color-blue'>" + stud[1] + "</span></td>" + "<td><span class='txt-color-blue'>" + stud[2] + "</span></td><td><span class='txt-color-blue'><small>" + gInfo.classes[student] + "</small></td>";
            counter = canames.length;
            scores = gInfo.scores[student].split(",");
            readonly = gInfo.approval == 1 ? "readonly='' " : "";
            // check if any field has '*' symbol
            if (scores[scores.length - 2] === "*") {
                offered = 0;
            } else {
                for (var c = 0; c < counter; c++) {
                    if (scores[c] === "*") {
                        offered = 0;
                        break;
                    }
                }
            }
            if (offered == 1) {
                for (var c = 0; c < counter; c++) {
                    if (scores[c] !== "-" && scores[c] !== "*") {
                        completed++;
                    }
                    tr1 += "<td class='tocenter'><input " + readonly + "onchange='computeGrade(" + gInfo.studids[student] + ");' type='text' class='infield test" + gInfo.studids[student] + " input-xs' maxlength='3' size='3' value='" + scores[c] + "'></td>";
                }
                if (scores[scores.length - 2] !== "-") {
                    completed++;
                }
                tr1 += "<td class='tocenter'><input " + readonly + "onchange='computeGrade(" + gInfo.studids[student] + ");' type='text' class='infield exams" + gInfo.studids[student] + " input-xs' maxlength='3' size='3' value='" + scores[scores.length - 2] + "'></td>";
                tr1 += "<td class='tocenter'><input type='text' class='total" + gInfo.studids[student] + " input-xs' maxlength='3' size='3' readonly='' value='" + scores[scores.length - 1] + "/100'></td>" + "<td class='tocenter'><div class='progress progress-striped active no-margin'><div class='pc" + gInfo.studids[student] + " progress-bar progress-bar-primary'></div></div></td>";
            } else {
                for (var c = 0; c < counter; c++) {
                    tr1 += "<td class='tocenter'><input " + readonly + "onchange='computeGrade(" + gInfo.studids[student] + ");' type='text' class='infield test" + gInfo.studids[student] + " input-xs' maxlength='3' size='3' value='*'></td>";
                }
                tr1 += "<td class='tocenter'><input " + readonly + "onchange='computeGrade(" + gInfo.studids[student] + ");' type='text' class='infield exams" + gInfo.studids[student] + " input-xs' maxlength='3' size='3' value='*'></td>";
                tr1 += "<td class='tocenter'><input type='text' class='total" + gInfo.studids[student] + " input-xs' maxlength='3' size='3' readonly='' value='*'></td>" + "<td class='tocenter'><div class='progress progress-striped active no-margin'><div class='pc" + gInfo.studids[student] + " progress-bar progress-bar-primary'></div></div></td>";
            }
            tr2.innerHTML = tr1;
            bodyContent.appendChild(tr2);
            var percentage = completed / (scores.length - 1) * 100;
            data("pc" + gInfo.studids[student], 0, percentage);
            if ((student + 1) % displaySize === 0) {
                break;
            }
            nextEntry++;
        }
        calculateSubjectAverage();
        $("#page_info").removeClass("text-danger");
        $("#page_info").html("Showing <span class='txt-color-darken'>" + (startEntry + 1) + "</span> to <span class='txt-color-darken'>" + ((nextEntry + 1 <= totalEntry) ? nextEntry + 1 : nextEntry) + "</span> of <span class='text-primary'>" + totalEntry + "</span> entries");
        if ((totalEntry - (nextEntry + 1)) > 0) {
            nextEntry++;
        } else {
            nextEntry = totalEntry - 1;
            if (nextState) {
                $("#nextid").addClass("disabled");
                $("#nextid").children("a").removeAttr("onclick");
                nextState = false;
            }
        }
        if (((startEntry + 1) > displaySize) && !prevState) {
            $("#previd").removeClass("disabled");
            $("#previd").children("a").attr("onclick", "getPrevData();");
            prevState = !prevState;
        }
    }
}
function getPrevData() {
    if (gInfo !== null && gInfo.students.length > 0) {
        $("#tbody").html("");
        startEntry = startEntry - displaySize;
        if (startEntry <= 0) {
            startEntry = 0;
            if (prevState) {
                $("#previd").addClass("disabled");
                $("#previd").children("a").removeAttr("onclick");
                prevState = !prevState;
            }
        }
        nextEntry = startEntry;
        var tr1 = "", tr2, casystem = gInfo.caexamsystem, canames = casystem[0].split(","), cascores = casystem[1].split(","), stud, bodyContent = document.getElementById("tbody"), i = 0, counter, scores, completed, readonly = "", offered;
        for (var student = startEntry; student < gInfo.students.length; student++) {
            tr1 = "";
            tr2 = document.createElement("tr");
            completed = 0;
            offered = 1;
            stud = gInfo.students[student].split(",");
            tr1 += "<td><span class='txt-color-blue'>" + stud[0] + "</span></td><td><span class='txt-color-blue'>" + stud[1] + "</span></td>" + "<td><span class='txt-color-blue'>" + stud[2] + "</span></td><td><span class='txt-color-blue'><small>" + gInfo.classes[student] + "</small></td>";
            counter = canames.length;
            scores = gInfo.scores[student].split(",");
            readonly = gInfo.approval == 1 ? "readonly='' " : "";
            // check if any field has '*' symbol
            if (scores[scores.length - 2] === "*") {
                offered = 0;
            } else {
                for (var c = 0; c < counter; c++) {
                    if (scores[c] === "*") {
                        offered = 0;
                        break;
                    }
                }
            }
            if (offered == 1) {
                for (var c = 0; c < counter; c++) {
                    if (scores[c] !== "-" && scores[c] !== "*") {
                        completed++;
                    }
                    tr1 += "<td class='tocenter'><input " + readonly + "onchange='computeGrade(" + gInfo.studids[student] + ");' type='text' class='infield test" + gInfo.studids[student] + " input-xs' maxlength='3' size='3' value='" + scores[c] + "'></td>";
                }
                if (scores[scores.length - 2] !== "-") {
                    completed++;
                }
                tr1 += "<td class='tocenter'><input " + readonly + "onchange='computeGrade(" + gInfo.studids[student] + ");' type='text' class='infield exams" + gInfo.studids[student] + " input-xs' maxlength='3' size='3' value='" + scores[scores.length - 2] + "'></td>";
                tr1 += "<td class='tocenter'><input type='text' class='total" + gInfo.studids[student] + " input-xs' maxlength='3' size='3' readonly='' value='" + scores[scores.length - 1] + "/100'></td>" + "<td class='tocenter'><div class='progress progress-striped active no-margin'><div class='pc" + gInfo.studids[student] + " progress-bar progress-bar-primary'></div></div></td>";
            } else {
                for (var c = 0; c < counter; c++) {
                    tr1 += "<td class='tocenter'><input " + readonly + "onchange='computeGrade(" + gInfo.studids[student] + ");' type='text' class='infield test" + gInfo.studids[student] + " input-xs' maxlength='3' size='3' value='*'></td>";
                }
                tr1 += "<td class='tocenter'><input " + readonly + "onchange='computeGrade(" + gInfo.studids[student] + ");' type='text' class='infield exams" + gInfo.studids[student] + " input-xs' maxlength='3' size='3' value='*'></td>";
                tr1 += "<td class='tocenter'><input type='text' class='total" + gInfo.studids[student] + " input-xs' maxlength='3' size='3' readonly='' value='*'></td>" + "<td class='tocenter'><div class='progress progress-striped active no-margin'><div class='pc" + gInfo.studids[student] + " progress-bar progress-bar-primary'></div></div></td>";
            }
            tr2.innerHTML = tr1;
            bodyContent.appendChild(tr2);
            var percentage = completed / (scores.length - 1) * 100;
            data("pc" + gInfo.studids[student], 0, percentage);
            if ((student + 1) % displaySize === 0) {
                break;
            }
            nextEntry++;
        }
        calculateSubjectAverage();
        $("#page_info").removeClass("text-danger");
        $("#page_info").html("Showing <span class='txt-color-darken'>" + (startEntry + 1) + "</span> to <span class='txt-color-darken'>" + ((nextEntry + 1 <= totalEntry) ? nextEntry + 1 : nextEntry) + "</span> of <span class='text-primary'>" + totalEntry + "</span> entries");
        if ((totalEntry - (nextEntry + 1)) > 0) {
            nextEntry++;
            if (!nextState) {
                $("#nextid").removeClass("disabled");
                $("#nextid").children("a").attr("onclick", "getNextData();");
                nextState = !nextState;
            }
        }
    }
}
function computeGrade(id) {
    if (gInfo !== null) {
        var completed = 0, casystem = gInfo.caexamsystem, scoresLimit = casystem[1].split(","), sizeOfScores = scoresLimit.length, studScores = "", numbertest = /^([0-9]{1,3}|\-|abs|\*)$/, sum = 0, totalexams = 0, testdata = document.getElementsByClassName("test" + id), value, offered = 1, examsdata = document.getElementsByClassName("exams" + id)[0];
        for (var i = 0; i < testdata.length; i++) {
            value = testdata[i].value.toLowerCase();
            if (!numbertest.test(value)) {
                alertBox("warning", "Please enter a positive integer or abs or hyphen(-) to leave as blank or asterisk(*) as course not offered by student at column " + (i + 5) + getStudName(id));
                testdata[i].value = "-";
                studScores += "-,";
            } else if (value !== "-" && value !== "abs" && value !== "*" && parseInt(value) > parseInt(scoresLimit[i])) {
                alertBox("warning", "Score exceed limit for column " + (i + 5) + getStudName(id));
                testdata[i].value = "-";
                studScores += "-,";
            }
            else if (value === "*") {
                studScores = "";
                completed = totalexams = offered = 0;
                for (var k = 0; k < testdata.length; k++) {
                    studScores += "*,";
                    // testdata[k].value = "*";
                }
                // examsdata.value = "*";
                studScores += "*,";
                break;
            }
            else {
                if (value !== "-") {
                    sum += (value === "abs" ? 0 : parseInt(value));
                    completed++;
                }
                studScores += value + ",";
            }
            totalexams += parseInt(scoresLimit[i]);
        }
        // deal with exams section
        if (offered == 1) {
            totalexams = 100 - totalexams;
            value = examsdata.value.toLowerCase();
            if (!numbertest.test(value)) {
                alertBox("warning", "Please enter a positive integer or 'abs' or hyphen(-) to leave as blank or asterisk(*) as course not offered by student at column " + (sizeOfScores + 5) + getStudName(id));
                examsdata.value = "-";
                studScores += "-,";
            } else if (value !== "-" && value !== "abs" && value !== "*" && parseInt(value) > totalexams) {
                alertBox("warning", "Score exceed limit for column " + (sizeOfScores + 5) + getStudName(id));
                examsdata.value = "-";
                studScores += "-,";
            } else if (value === "*") {
                studScores = "";
                completed = totalexams = offered = 0;
                for (var k = 0; k < testdata.length; k++) {
                    studScores += "*,";
                    // testdata[k].value = "*";
                }
                // examsdata.value = "*";
                studScores += "*,";
            }
            else {
                if (value !== "-") {
                    sum += (value === "abs" ? 0 : parseInt(value));
                    completed++;
                }
                studScores += value + ",";
            }
            var totaldata = document.getElementsByClassName("total" + id)[0];
            totaldata.value = (offered == 0 ? "*" : sum + "/100");
            studScores += (offered == 0 ? "*" : sum);
        } else {
            var totaldata = document.getElementsByClassName("total" + id)[0];
            totaldata.value = "*";
            studScores += "*";
        }
        var percentage = completed / (sizeOfScores + 1) * 100, position = -1;
        data("pc" + id, 0, percentage);
        for (var student = 0; student < gInfo.students.length; student++) {
            if (gInfo.studids[student] === (id + "")) {
                position = student;
                break;
            }
        }
        if (position > -1 && studScores.length >= 0) {
            gInfo.scores[position] = studScores;
        }
    }
    calculateSubjectAverage();
}
function calculateSubjectAverage() {
    if (gInfo !== null) {
        var scores, avg = 0, lastscore, non_offered = 0;
        for (var i = 0; i < gInfo.scores.length; i++) {
            scores = gInfo.scores[i].split(",");
            lastscore = scores[scores.length - 1];
            if (lastscore === "*") {
                non_offered++;
                lastscore = 0;
            } else if (lastscore === "-" || lastscore === "abs") {
                lastscore = 0;
            }
            avg += parseInt(lastscore);
        }
        var cavg = new Number((avg / ((gInfo.scores.length - non_offered) * 100) * 100));
        $("#cavg").html(cavg.toFixed(2) + "%");
    }
}
function setApproved(state) {
    var infields = $(".infield");
    if (state) {
        infields.attr("readonly", "");
    } else {
        infields.removeAttr("readonly");
    }
}
function setApproval() {
    var state = document.getElementById("approval").checked;
    if (gInfo !== null) {
        gInfo.approval = state ? 1 : 0;
    }
    setApproved(state);
}
function saveData() {
    if (gInfo !== null) {
        if (usertype == 1 || gInfo.approval === 0) {
            var package = gInfo.datasearch.join(",") + "|";
            package += gInfo.studids.join(";") + "|";
            package += gInfo.caexamsystem.join(";") + "|";
            package += gInfo.scores.join(";") + "|";
            package += gInfo.approval;
            iml2(".lsgs");
            ajaxCall("text", "post", usp.academic.gr[0], "savedata=" + package, function(x) {
                if (x.trim().length > 0) {
                    var datatest = /^[0-9]+\|[0-9]+$/;
                    if (datatest.test(x)) {
                        x = x.split("|");
                        alertBox("success", x[0] + " grade" + (parseInt(x[0]) > 1 ? "s" : "") + " updated and " + x[1] + " grade" + (parseInt(x[1]) > 1 ? "s" : "") + " added successfully");
                    } else {
                        alertBox("error", x);
                    }
                }
            }, true, 0);
            package = null;
        } else {
            alertBox("error", "Your access clearance prevent you from altering/saving students grades. Contact School Administrator for help.");
        }
    }
}
function setGradeTitle(title) {
    $("#gradetitle").html(title);
}
function getClasses() {
    ajaxCall("text", "post", usp.academic.gr[0], "getClass=" + typeid, function(x) {
        $("#class").html("<option value='0'>Class</option>");
        
        console.log(x);
        
        if (x.trim().length > 0) {
            var index, data, clas;
            data = x.split("*");
            for (index in data) {
                clas = data[index].split("|");
                $("#class").append("<option value='" + clas[0] + "," + clas[1] + "'>" + clas[2].toUpperCase() + "</option>");
            }
        }
    }, true, 1);
}
function getCourses() {
    if ($("#class").val() !== "0") {
        ajaxCall("text", "post", usp.academic.gr[0], "cid=" + $("#class").val(), function(x) {
            if (x.trim().length > 0) {
                $("#course").html(x);
            }
        }, true, 1);
    } else {
        $("#course").html("<option value='0'>Courses</option>");
    }
}
function getStudName(id) {
    if (gInfo !== null) {
        var i, j;
        for (i in gInfo.studids) {
            j = gInfo.studids[i];
            if (j == id) {
                j = gInfo.students[i].split(",");
                return" for " + j[0] + " " + j[1];
            }
        }
    }
    return"";
}
function refreshD() {
    if (gInfo !== null && gInfo.istudents.length > 0) {
        var j, left = 0;
        for (j in gInfo.itreated) {
            if (gInfo.itreated[j] == 1) {
                $("#igr" + gInfo.istudids[j]).remove();
            } else {
                left++;
            }
        }
        if (left > 0) {
            $("#nocontent2").hide();
            $("#page_info2").html(left);
            $(".invr").children("b").html(left);
            uncheckall();
        } else {
            $(".invr").removeClass("bg-color-red");
            $(".invr").addClass("bg-color-blue");
            $(".invr").children("b").html(left);
            $("#tbody2").html("");
            $("#thead2").html("");
            $("#nocontent2").show();
            $("#page_info2").html(0);
        }
    }
}
function transferInfo() {
    iml2(".lctr");
    ajaxCall("text", "post", usp.academic.gr[0], "transfergrades=" + gInfo.datasearch + "|" + _ids + "|" + _classes + "|" + _scoreset.join("*") + "|" + _names.join("*"), function(x) {
        if (x.trim().length > 0) {
            if (x === "cne") {
                alertBox("error", "Class(es) does not exists");
            } else {
                x = x.split("<1>");
                var out = (parseInt(x[0]) > 1 ? x[0] + " grades" : x[0] + " grade") + " transfered successfully";
                if (x[1].trim().length > 0) {
                    out += "<br>" + x[1].split("<2>").join("<br>");
                }
                printStatus(_ids, x[0], x[2]);
                alertBox("success", out);
            }
        }
    }, true, 0);
}
function transferD() {
    if (gInfo !== null && gInfo.istudents.length > 0) {
        var checkStuds = document.getElementsByClassName("irselect");
        _ids = [];
        var notillegible = 0;
        _classes = [];
        _scoreset = [];
        _names = [];
        for (var x = 0; x < checkStuds.length; x++) {
            if (checkStuds[x].checked && gInfo.itreated[x] == 0 && gInfo.istudents[x][0] !== "-") {
                _ids.push(checkStuds[x].value);
                _classes.push(gInfo.iclasses[x]);
                _scoreset.push(gInfo.iscores[x]);
                _names.push(gInfo.istudents[x]);
            }
            if (checkStuds[x].checked && gInfo.itreated[x] == 0 && gInfo.istudents[x][0] === "-") {
                notillegible++;
            }
        }
        if (_ids.length > 0) {
            confirmBox("This decision may overwrite existing grade(s) for any student match found. Are you sure you want to proceed?" + _btnmes, transferInfo);
        }
        if (notillegible > 0) {
            alertBox("error", notillegible + " grade" + (notillegible > 1 ? "s are" : " is") + " not illegible for transfer (no student own such grade(s))");
        }
    }
}
function deleteD() {
    iml2(".lcrd");
    ajaxCall("text", "post", usp.academic.gr[0], "deletegrades=" + gInfo.datasearch + "|" + _ids, function(x) {
        if (x.trim().length > 0) {
            x = x.split("|");
            printStatus(_ids, x[0], x[1]);
            alertBox("success", x[0] + " record" + (parseInt(x[0]) > 1 ? "s were" : " was") + " treated successfully");
        }
    }, true, 0);
}
function removeD() {
    if (gInfo !== null && gInfo.istudents.length > 0) {
        var checkStuds = document.getElementsByClassName("irselect");
        _ids = [];
        for (var x = 0; x < checkStuds.length; x++) {
            if (checkStuds[x].checked && gInfo.itreated[x] == 0) {
                _ids.push(checkStuds[x].value);
            }
        }
        if (_ids.length > 0) {
            confirmBox("Are you sure you want to proceed?" + _btnmes, deleteD);
        }
    }
}
function checkData() {
    var checkState = document.getElementById("checkall"), checkStuds = document.getElementsByClassName("irselect"), state = checkState.checked;
    for (var i = 0; i < checkStuds.length; i++) {
        checkStuds[i].checked = state;
    }
}
function printStatus(treated, numtreated, nottreated) {
    var ids = treated;
    if (nottreated.length > 0) {
        var untreated = nottreated.split(","), i, j, k;
        for (i in ids) {
            k = 0;
            for (j in untreated) {
                if (ids[i] == untreated[j]) {
                    k = 1;
                    break;
                }
            }
            if (k == 1) {
                ids[i] = null;
            }
        }
    }
    if (ids.length > 0) {
        for (i in ids) {
            for (j in gInfo.itreated) {
                if (gInfo.istudids[j] == ids[i]) {
                    gInfo.itreated[j] = 1;
                    $("#igr" + ids[i]).removeClass("notreat");
                    $("#igr" + ids[i]).addClass("treat");
                    $("#igr" + ids[i] + " .itreated").removeClass("fa-times");
                    $("#igr" + ids[i] + " .itreated").addClass("fa-check");
                    break;
                }
            }
        }
    }
    var left = (parseInt($("#page_info2").html()) - parseInt(numtreated));
    if (left == 0) {
        $(".invr").removeClass("bg-color-red");
        $(".invr").addClass("bg-color-blue");
        $(".invr").children("b").html(left);
    } else {
        $(".invr").children("b").html(left);
    }
    $("#page_info2").html(left);
}
$('.sendz').click(function() {
    processMail(usp.academic.gr[0], userz, keyz, methodz);
});