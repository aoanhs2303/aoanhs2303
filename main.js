$(document).ready(function () {
    $('nav.navbar ul li').click(function () {
        $(this).children('ul.sub-menu').slideToggle();
    })
    $('span.togger-icon').click(function () {
        $('.one-line-togger').toggleClass('active');
    })
    $(window).scroll(function() {
        var posAng = $('.angular-trending').offset().top;
        var screenTop = $(document).scrollTop();
        console.log(screenTop);
        
        if(screenTop < posAng) {
            //$('.angular-trending').removeClass('active');
        }
        else {
            //$('.angular-trending').addClass('active');
            
        }
        
    })
    $('pre code').each(function(i, block) {
        hljs.highlightBlock(block);
    });
});

angular.module('tabTrending', [])
    .controller("TabController", function($scope){
        $scope.current_tab = 1;
        $scope.changeTab = function(index) {
            $scope.current_tab = index;
        };
        $scope.isActiveTab = function(index) {
            return index === $scope.current_tab;
        };
    
})