var _btnmes = "<br><br><div class='text-right'><button type='button' id='okBtn' class='btn btn-primary btn-sm'>Ok</button><button type='button' id='cancelBtn' class='btn btn-sm btn-info' style='margin: 0 8px 0 8px'>Cancel</button></div>", _id = [], _id2 = [], formrow = document.getElementById("rowinfo"), caformrow = document.getElementById("carowinfo"), currentGS = [], currentCA = [];
function addNewGS() {
    document.getElementById("gslistsec").className = "dd hidden";
    document.getElementById("gseditsec").className = "hidden";
    document.getElementById("gsaddsec").className = "";
    document.getElementById("add").className = "btn btn-primary btn-xs hidden";
    document.getElementById("rem").className = "btn btn-primary btn-xs";
    $("#gsfield").val("");
    $("#rowinfo").html("");
    document.getElementById("gsaddnamesec").className = "input-group";
    document.getElementById("gsadddatasec").className = "hidden"
}
function addNewCA() {
    document.getElementById("calistsec").className = "dd hidden";
    document.getElementById("caeditsec").className = "hidden";
    document.getElementById("caaddsec").className = "";
    document.getElementById("addca").className = "btn btn-primary btn-xs hidden";
    document.getElementById("remca").className = "btn btn-primary btn-xs";
    $("#cafield").val("");
    $("#carowinfo").html("");
    document.getElementById("caaddnamesec").className = "input-group";
    document.getElementById("caadddatasec").className = "hidden"
}
function removeNewGS() {
    document.getElementById("gslistsec").className = "dd";
    document.getElementById("gseditsec").className = "hidden";
    document.getElementById("gsaddsec").className = "hidden";
    document.getElementById("add").className = "btn btn-primary btn-xs";
    document.getElementById("rem").className = "btn btn-primary btn-xs hidden";
    $("#gsfield").val("");
    $("#rowinfo").html("");
    document.getElementById("gsaddnamesec").className = "input-group hidden"
}
function removeNewCA() {
    document.getElementById("calistsec").className = "dd";
    document.getElementById("caeditsec").className = "hidden";
    document.getElementById("caaddsec").className = "hidden";
    document.getElementById("addca").className = "btn btn-primary btn-xs";
    document.getElementById("remca").className = "btn btn-primary btn-xs hidden";
    $("#cafield").val("");
    $("#carowinfo").html("");
    document.getElementById("caaddnamesec").className = "input-group hidden"
}
function editGS(b) {
    ajaxCall("text", "post", usp.academic.gr[0], "editgsid=" + b, function (a) {
        document.getElementById("gslistsec").className = "dd hidden";
        document.getElementById("gseditsec").className = "hidden";
        document.getElementById("gsaddsec").className = "";
        document.getElementById("add").className = "btn btn-primary btn-xs hidden";
        document.getElementById("rem").className = "btn btn-primary btn-xs";
        activateGSDataSec(b + "-" + $("#" + b).text());
        $("#buttext").html("Update Grade");
        $("#gstitle").html("Update Grading System");
        if (a.trim().length > 0) {
            $("#rowinfo").append(a)
        }
    }, true, 1)
}
function editCA(b) {
    ajaxCall("text", "post", usp.academic.gr[0], "editcaid=" + b, function (d) {
        document.getElementById("calistsec").className = "dd hidden";
        document.getElementById("caeditsec").className = "hidden";
        document.getElementById("caaddsec").className = "";
        document.getElementById("addca").className = "btn btn-primary btn-xs hidden";
        document.getElementById("remca").className = "btn btn-primary btn-xs";
        activateCADataSec(b + "-" + $("#CA" + b).text());
        $("#cabuttext").html("Update CA/Exam");
        $("#catitle").html("Update CA / Exam System");
        if (d.trim().length > 0) {
            var a = d.split("|")[1].split(",");
            addTopCAData(a.length, getTotal(a));
            $("#carowinfo").append(d.split("|")[0])
        } else {
            addTopCAData(0, 10);
            $("#chead").hide()
        }
    }, true, 1)
}
function getTotal(f) {
    var d = 0;
    for (var e = 0; e < f.length; e++) {
        d += new Number(f[e])
    }
    return d
}
function deleteGS(b) {
    _id = b;
    confirmBox("Deleting this grade system will affect all grades attach to it. Are you sure about your current operation?" + _btnmes, eraseGS)
}
function deleteCA(b) {
    _id2 = b;
    confirmBox("Deleting this continuous / exams system will affect all grades attach to it. Are you sure about your current operation?" + _btnmes, eraseCA)
}
function eraseGS() {
    ajaxCall("text", "post", usp.academic.gr[0], "gsid=" + _id, function (b) {
        if (b.trim().length > 0) {
            if (b.indexOf("been deleted") >= 0) {
                alertBox("success", b);
                $("#" + _id).remove()
            } else {
                if (b == "linked") {
                    alertBox("info", "this grade system is currently in use as default for grading students, please detach in settings before deleting")
                } else {
                    alertBox("error", b)
                }
            }
        }
    }, false, 0)
}
function eraseCA() {
    ajaxCall("text", "post", usp.academic.gr[0], "caid=" + _id2, function (b) {
        if (b.trim().length > 0) {
            if (b.indexOf("been deleted") >= 0) {
                alertBox("success", b);
                $("#CA" + _id2).remove()
            } else {
                if (b == "linked") {
                    alertBox("info", "this continuous / exams system is currently in use as default for grading students, please detach in settings before deleting")
                } else {
                    alertBox("error", b)
                }
            }
        }
    }, false, 0)
}
function addGS() {
    var d = document.getElementById("gsfield"), c = /^[a-zA-z0-9\s]{1,40}$/;
    if (!c.test(d.value.trim())) {
        alertBox("warning", "Please enter a valid Grading System Name. Alphanumeric characters plus space only,1-40 chars")
    } else {
        iml2(".lags");
        ajaxCall("text", "post", usp.academic.gr[0], "gradingsystemtype=" + d.value.trim(), function (b) {
            if (b.trim().length > 0) {
                if (b.substr(0, 1) === "<") {
                    var a = document.getElementById("gslist");
                    a.innerHTML = a.innerHTML + b.split(":")[0];
                    activateGSDataSec(b.split(":")[1]);
                    $("#buttext").html("Add Grade");
                    $("#gstitle").html("Add New Grading System");
                    addRow()
                } else {
                    alertBox("error", b)
                }
            }
        }, true, 0)
    }
}
function addCA() {
    $("#chead").hide();
    var d = document.getElementById("cafield"), c = /^[a-zA-z0-9\s]{1,40}$/;
    if (!c.test(d.value.trim())) {
        alertBox("info", "Please enter a valid CA / Exam System Name. Alphanumeric characters plus space only,1-40 chars")
    } else {
        iml2(".lace");
        ajaxCall("text", "post", usp.academic.gr[0], "caexamsystemtype=" + d.value.trim(), function (b) {
            if (b.trim().length > 0) {
                if (b.substr(0, 1) === "<") {
                    var a = document.getElementById("calist");
                    a.innerHTML = a.innerHTML + b.split(":")[0];
                    activateCADataSec(b.split(":")[1]);
                    $("#cabuttext").html("Add CA/Exam");
                    $("#catitle").html("Add New CA / Exam System");
                    addTopCAData(0, 10)
                } else {
                    alertBox("error", b)
                }
            }
        }, true, 0)
    }
}
function activateGSDataSec(b) {
    document.getElementById("gsadddatasec").className = "";
    document.getElementById("gsaddnamesec").className = "input-group hidden";
    currentGS = b.split("-");
    document.getElementById("gsname").innerHTML = currentGS[1].toUpperCase();
    $("#rowinfo").html("")
}
function activateCADataSec(b) {
    document.getElementById("caadddatasec").className = "";
    document.getElementById("caaddnamesec").className = "input-group hidden";
    currentCA = b.split("-");
    document.getElementById("caname").innerHTML = currentCA[1].toUpperCase();
    $("#carowinfo").html("")
}
function addRow() {
    var c = formrow.childNodes.length, d = "<div class='batch'><div class='row well' style='padding-top:10px'><section class='col col-3'><label class='input'><input type='text' class='gsn' placeholder='eg A, C5, B3'></label></section><section class='col col-2'><label class='select'><select class='gss_start'>" + getOptNum() + "</select><i></i></label></section><section class='col col-2'><label class='select'><select class='gss_end'>" + getOptNum() + "</select><i></i></label></section><section class='col col-4'><label class='input'><input type='text' class='gsr' placeholder='eg excellent'></label></section><section class='col col-1'><span class='shutdown' style='cursor: pointer; text-decoration: underline;' onclick='takeoutrow(" + c + ");'><i class='fa fa-times'></i></span></section></div><br></div>";
    $("#rowinfo").append(d)
}
function addTopCAData(g, f) {
    var e = "";
    for (var h = 0; h < 6; h++) {
        if (h == g) {
            e += "<option selected=''>" + h + "</option>"
        } else {
            e += "<option>" + h + "</option>"
        }
    }
    $("#cad").html(e);
    e = "";
    for (var h = 0; h < 11; h++) {
        if (f == (h * 10)) {
            e += "<option selected=''>" + (h * 10) + "</option>"
        } else {
            e += "<option>" + (h * 10) + "</option>"
        }
    }
    $("#cas").html(e);
    $("#exam").val(100 - f)
}
function addRowData() {
    if ($("#cad").select().val() > -1) {
        $("#chead").show()
    } else {
        $("#chead").hide()
    }
    var i, h, j;
    
    if (caformrow.childNodes.length === 0 && parseInt($("#cad").select().val()) === 0) {
        j = "<div class='batch2'><div class='row well' style='padding-top:10px;'><section class='col col-4'><label class='input'><input type='text' class='caename' value='NULL CA' readonly='readonly'></label></section><section class='col col-4'><label class='input'><input type='text' value='0' readonly class='caescore'></label></section><section class='col col-4'><span class='shutdown2 pull-right' style='cursor: pointer; text-decoration: underline;' onclick='takeoutrow2(" + i + ");'><i class='fa fa-times'></i></span></section></div><br></div>";
            $("#carowinfo").html(j);
       
    } else if (caformrow.childNodes.length < $("#cad").select().val()) {
        h = caformrow.childNodes.length;
        for (var g = h; g < $("#cad").select().val(); g++) {
            i = caformrow.childNodes.length;
            j = "<div class='batch2'><div class='row well' style='padding-top:10px;'><section class='col col-4'><label class='input'><input type='text' class='caename' placeholder='eg CA" + (g + 1) + ", Test" + (g + 1) + "'></label></section><section class='col col-4'><label class='input'><input type='text' placeholder='score fragment" + (g + 1) + "' class='caescore'></label></section><section class='col col-4'><span class='shutdown2 pull-right' style='cursor: pointer; text-decoration: underline;' onclick='takeoutrow2(" + i + ");'><i class='fa fa-times'></i></span></section></div><br></div>";
            $("#carowinfo").append(j)
        }
    } else {
        if (caformrow.childNodes.length > $("#cad").select().val()) {
            var f = caformrow.childNodes.length - $("#cad").select().val();
            while (f > 0) {
                takeoutrow2(caformrow.childNodes.length - 1);
                f--
            }
        }
    }
}
function updateExam() {
    $("#exam").val(100 - ((document.getElementById("cas").selectedIndex) * 10))
}
function getOptNum() {
    var c = "";
    for (var d = 0; d <= 100; d++) {
        c += "<option>" + d + "</option>"
    }
    return c
}
function takeoutrow(e) {
    var f = formrow.childNodes.length;
    if (e < (f - 1)) {
        formrow.removeChild(document.getElementsByClassName("batch")[e]);
        for (var d = e; d < f - 1; d++) {
            document.getElementsByClassName("shutdown").item(d).setAttribute("onclick", "takeoutrow(" + d + ");")
        }
    } else {
        formrow.removeChild(document.getElementsByClassName("batch")[e])
    }
}
function takeoutrow2(e) {
    var f = caformrow.childNodes.length;
    if (e < (f - 1)) {
        caformrow.removeChild(document.getElementsByClassName("batch2")[e]);
        for (var d = e; d < f - 1; d++) {
            document.getElementsByClassName("shutdown2").item(d).setAttribute("onclick", "takeoutrow2(" + d + ");")
        }
    } else {
        caformrow.removeChild(document.getElementsByClassName("batch2")[e])
    }
    $("#cad").val(caformrow.childNodes.length);
    if (caformrow.childNodes.length == 0) {
        $("#chead").hide()
    }
}
function processData() {
    if (formrow.childNodes.length > 0) {
        var K = "", H = [], r = [], N = [], C = [], A = document.getElementsByClassName("gsn"), D = document.getElementsByClassName("gsr"), P = document.getElementsByClassName("gss_start"), Q = document.getElementsByClassName("gss_end"), F = /^[a-zA-Z0-9]{1,3}$/, T = /^[a-zA-Z0-9\s]{1,15}$/;
        for (var B = 0; B < formrow.childNodes.length; B++) {
            if (!F.test(A[B].value.trim())) {
                K = B + 1 + "";
                alertBox("warning", "please enter a valid grade name at row " + K + ". (alphanumeric only, must be within 1-3 in length)");
                break
            }
            if (!T.test(D[B].value.trim())) {
                K = B + 1 + "";
                alertBox("warning", "please enter a valid grade remark at row " + K + ". (alphanumeric only, must be within 1-15 in length, space included)");
                break
            }
            if (P[B].selectedIndex >= Q[B].selectedIndex) {
                K = B + 1 + "";
                alertBox("warning", "please ensure lower range score is less than upper range score at row " + K);
                break
            }
        }
        if (K.length == 0) {
            for (var G = 0; G < formrow.childNodes.length; G++) {
                var x = A[G].value.trim().toLowerCase(), I = D[G].value.trim().toLowerCase(), B = 0;
                for (var J = 0; J < formrow.childNodes.length; J++) {
                    if (J != G) {
                        if (x === A[J].value.trim().toLowerCase() || I === D[J].value.trim().toLowerCase()) {
                            K = "row " + (G + 1) + " and row " + (J + 1) + "\n";
                            B = 1;
                            break
                        }
                    }
                }
                if (B == 1) {
                    break
                }
            }
            if (K.length != 0) {
                alertBox("warning", "grade name or remark name repetition at \n\n" + K)
            }
        }
        if (K.length == 0) {
            var M = 0;
            for (var G = 0; G < formrow.childNodes.length; G++) {
                var R = P[G].selectedIndex, S = Q[G].selectedIndex, B = 0;
                for (var E = 0; E < formrow.childNodes.length; E++) {
                    if (E != G) {
                        if (valueFound(P[E].selectedIndex, Q[E].selectedIndex, R, S)) {
                            K = "row " + (G + 1) + " and row " + (E + 1) + "\n";
                            B = 1;
                            break
                        }
                    }
                }
                if (B == 1) {
                    break
                }
            }
            if (K.length == 0) {
                var O = 0, i = currentGS[0] + "|";
                for (var L = 0; L < formrow.childNodes.length; L++) {
                    if (P[L].selectedIndex == 0) {
                        O += (Q[L].selectedIndex - P[L].selectedIndex)
                    } else {
                        O += (Q[L].selectedIndex - P[L].selectedIndex + 1)
                    }
                    i += "(null, " + currentGS[0] + ", '" + A[L].value.trim() + "', '" + P[L].selectedIndex + "-" + Q[L].selectedIndex + "', '" + D[L].value.trim() + "', 0),"
                }
                i = $("#buttext").text() + "|" + i.substr(0, i.length - 1);
                if (O == 100) {
                    iml2(".laga");
                    ajaxCall("text", "post", usp.academic.gr[0], "gsdata=" + i, function (a) {
                        if (a.trim().length > 0) {
                            if (a.indexOf("success") >= 0) {
                                alertBox("success", a);
                                setTimeout(removeNewGS, 1000)
                            } else {
                                alertBox("warning", a)
                            }
                        }
                    }, true, 0)
                } else {
                    alertBox("warning", "the sum of all lower range and upper range must equate to 100")
                }
            } else {
                alertBox("warning", "score range overlaps between \n\n" + K)
            }
        }
    } else {
        alertBox("warning", "No Information To Process")
    }
}
function processDataCA() {
    if (caformrow.childNodes.length > 0) {
        var o = /^[0-9]{1,3}$/, j = /^[a-zA-Z0-9\s]{1,10}$/, n = document.getElementsByClassName("caename"), i = document.getElementsByClassName("caescore");
        for (var s = 0; s < n.length; s++) {
            if (!j.test(n[s].value.trim()) || !o.test(i[s].value.trim())) {
                alertBox("warning", "Invalid data at row " + (s + 1) + ". CA Name - 1-10 alphanumeric chars plus space only, CA Score - 1-3 +ve digits only");
                return
            }
        }
        for (var s = 0; s < n.length; s++) {
            var t = n[s].value.trim().toLowerCase();
            for (var u = 0; u < n.length; u++) {
                if (u != s) {
                    if (n[u].value.trim().toLowerCase() == t) {
                        alertBox("warning", "CA Name replication error at row " + (s + 1) + " and row " + (u + 1));
                        return
                    }
                }
            }
        }
        var r = 0;
        for (var s = 0; s < n.length; s++) {
            r += new Number(i[s].value.trim())
        }
        if (r != $("#cas").select().val()) {
            alertBox("warning", "sum of CA scores must equal " + $("#cas").select().val());
            return
        }
        var v = "", q = "";
        for (var p = 0; p < caformrow.childNodes.length; p++) {
            v += i[p].value.trim() + ",";
            q += n[p].value.trim() + ","
        }
        v = v.substr(0, v.length - 1);
        q = q.substr(0, q.length - 1);
        var t = currentCA[0] + "|(null, " + currentCA[0] + ", '" + q + "', '" + v + "', 0)";
        t = $("#cabuttext").text() + "|" + t;
        iml2(".laca");
        ajaxCall("text", "post", usp.academic.gr[0], "cadata=" + t, function (a) {
            if (a.trim().length > 0) {
                if (a.indexOf("success") >= 0) {
                    alertBox("success", a);
                    setTimeout(removeNewCA, 1000)
                } else {
                    alertBox("error", a)
                }
            }
        }, true, 0)
    } else {
        alertBox("warning", "No information to process")
    }
}
function isContained(f, d) {
    for (var e = 0; e < f.length; e++) {
        if (f[e] === d) {
            return true
        }
    }
    return false
}
function valueFound(j, i, g, h) {
    for (var e = j; e <= i; e++) {
        if (g == e || h == e) {
            return true
        }
    }
    return false
}
;