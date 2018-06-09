function RevealConnexionPanel() {


    this.connectionPanel = $('#connectionpanel');
    var that = this;

    $(document).ready(function () {

        that.connectionPanel.animate({

            opacity: 1
        }, 500);
    });
}

RevealConnexionPanel();
