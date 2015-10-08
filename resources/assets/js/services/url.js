angular.module('app.services')
    .service('Url', ['$interpolate', function ($interpolate) {
        return {
            getUrlFromUrlSymbol: function (url, params) {
                var urlModel = $interpolate(url)(params);
                return urlModel.replace(/\/\//g, '/').replace(/\/$S/, '');
            },
            getUrlResouce: function (url) {
                return url.replace(new RegExp('{{', 'g'), ':').replace(new RegExp('}}', 'g'), '');
            }
        };
    }]);