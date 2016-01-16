angular.module('app.filters').filter('dateDiff', function () {
    var magicNumber = (1000 * 60 * 60 * 24);

    return function (toDate, fromDate) {
        if(toDate && fromDate){
            var dayDiff = Math.floor((new Date(toDate) - new Date(fromDate)) / magicNumber);
            if (angular.isNumber(dayDiff)){
                return dayDiff + 1;
            }
        }
    };
});