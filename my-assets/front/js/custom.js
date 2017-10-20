$("#journey").change(function(){
    GetRoute();
});

function GetRoute() {
    var hostUrl = $("#base_url").val();
    source = document.getElementById("txtSource").value, destination = document.getElementById("txtDestination").value;
    var e = {origin: source, destination: destination, travelMode: google.maps.TravelMode.DRIVING};
    directionsService.route(e, function (e, t) {
        t == google.maps.DirectionsStatus.OK && directionsDisplay.setDirections(e)
    });
    var t = new google.maps.DistanceMatrixService;
    t.getDistanceMatrix({
        origins: [source],
        destinations: [destination],
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC,
        avoidHighways: !1,
        avoidTolls: !1
    }, function (e, t) {
        if (t == google.maps.DistanceMatrixStatus.OK && "ZERO_RESULTS" != e.rows[0].elements[0].status) {
            var journval=$("#journey").val();
            var a = parseFloat(e.rows[0].elements[0].distance.text)*parseInt(journval), i = parseFloat(e.rows[0].elements[0].distance.value)*parseInt(journval);
            i = 0 == i ? 1 : Math.ceil(i / 1e3);
            e.rows[0].elements[0].duration.text;
            document.getElementById("distance").value = a, document.getElementById("distancehd").value = i;
            var n = {vid: $("#car").val(), dis: i, journey:$("#journey").val()};
            $.ajax({
                type: "post",
                url: hostUrl+"home/price",
                data: JSON.stringify(n),
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                traditional: !0,
                success: function (e) {
                    var t = e.total;
                    $("#cost").val(t);
                }
            })
        } else alert("Unable to find the distance via road.")
    })
}
var RP = {}, source, destination, directionsDisplay, directionsService = new google.maps.DirectionsService;
$(document).ready(function () {
    RP.initcombo(), RP.chk_bidfrm(), $("#datetimepicker").datetimepicker({step: 60, minDate: 0})
}), google.maps.event.addDomListener(window, "load", function () {
    new google.maps.places.SearchBox(document.getElementById("txtSource"));
    var e = new google.maps.places.SearchBox(document.getElementById("txtDestination"));
    directionsDisplay = new google.maps.DirectionsRenderer({draggable: !0}), e.addListener("places_changed", function () {
        GetRoute();
    })
}), RP.chk_bidfrm = function () {
    jQuery.validator.addMethod("optdate", function (e, t) {
        var a = new Date(e), i = new Date;
        return a.setHours(a.getHours() + 1), i > a ? !1 : !0
    }, "Pickup time must be after on hr "), jQuery.validator.addClassRules({optdate: {optdate: !0}}), $("#bidfrm").validate({
        submitHandler: function () {
            frm.submit()
        }
    })
}, RP.initcombo = function () {
    var hostUrl = $("#base_url").val();
    $.post(hostUrl+"api/display_file", function (e) {
        RP.cartype = e, $("#carType").empty(), $("#carType").append('<option value="">Select Type ...</option>'), $.each(RP.cartype, function (e, t) {
            $("#carType").append('<option value="' + t.mTypeOfVehicle + '">' + t.mTypeOfVehicle + "</option>");
        });
    }), $("#carType").bind("change", function () {
        $("#car").empty();
        var e = this.selectedIndex - 1;
        $.each(RP.cartype[e].vehicle, function (e, t) {
            $("#car").append('<option value="' + t.mName + '">' + t.mName + "</option>");
        });
    });
};