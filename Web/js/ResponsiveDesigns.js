function ResponsiveDesigns() {

    this.footer = $('footer ul');
    var that = this;

    this.replaceFooterClass = function () {

        if (window.matchMedia("(max-width:425px)").matches) {

            that.footer.removeClass("justify-content-end");
            that.footer.addClass("justify-content-center");
            
        }
    };

    this.replaceFooterClass();

}

ResponsiveDesigns();
