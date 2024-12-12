<script>

var PUSHER_APP_KEY = "{{ env('PUSHER_APP_KEY') }}";

    var notificationsWrapper   = $('.dropdown-notifications');
    var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('i[data-count]');
    var notificationsCount     = parseInt(notificationsCountElem.data('count'));
    var notifications          = notificationsWrapper.find('ul.dropdown-menu');

    if (notificationsCount <= 0) {
      notificationsWrapper.hide();
    }

  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher(PUSHER_APP_KEY, {
      cluster: 'ap1'
    });

    var userId = {{ auth()->user()->id }};

    var channel = pusher.subscribe('popup-channel');

    // Do Notif
    channel.bind(`DO/${userId}`, function(data) {
        var notificationsList = $('.notifications-list');
    var notificationsCountElem = $('.notif-count');
    var notificationsCount = parseInt(notificationsCountElem.text());

    var newNotificationHtml = `
    <a class="dropdown-item d-flex align-items-center" href="/DO">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">${data['name']} </div>
                        <span class="font-weight-bold">${data['message']}</span>
                    </div>
                </a>
      `;

    // Add the new notification at the top of the list
    notificationsList.prepend(newNotificationHtml);

    notificationsCount += 1;
    notificationsCountElem.text(notificationsCount);
    });
    // end do notif

    //stockCount notif
    channel.bind(`StockCount/${userId}`, function(data) {
        var notificationsList = $('.notifications-list');
    var notificationsCountElem = $('.notif-count');
    var notificationsCount = parseInt(notificationsCountElem.text());

    var newNotificationHtml = `
    <a class="dropdown-item d-flex align-items-center" href="/stockcount">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">${data['name']} </div>
                        <span class="font-weight-bold">${data['message']}</span>
                    </div>
                </a>
      `;

    // Add the new notification at the top of the list
    notificationsList.prepend(newNotificationHtml);

    notificationsCount += 1;
    notificationsCountElem.text(notificationsCount);
    });
    //end stockCount notif

    // material notif
    channel.bind(`MaterialReq/${userId}`, function(data) {
        var notificationsList = $('.notifications-list');
    var notificationsCountElem = $('.notif-count');
    var notificationsCount = parseInt(notificationsCountElem.text());

    var newNotificationHtml = `
    <a class="dropdown-item d-flex align-items-center" href="/materialreq">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">${data['name']} </div>
                        <span class="font-weight-bold">${data['message']}</span>
                    </div>
                </a>
      `;

    // Add the new notification at the top of the list
    notificationsList.prepend(newNotificationHtml);

    notificationsCount += 1;
    notificationsCountElem.text(notificationsCount);
    });
    // end material notif
  
  // itr notif
  channel.bind(`ITR/${userId}`, function(data) {
        var notificationsList = $('.notifications-list');
    var notificationsCountElem = $('.notif-count');
    var notificationsCount = parseInt(notificationsCountElem.text());

    var newNotificationHtml = `
    <a class="dropdown-item d-flex align-items-center" href="/ITR">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">${data['name']} </div>
                        <span class="font-weight-bold">${data['message']}</span>
                    </div>
                </a>
      `;

    // Add the new notification at the top of the list
    notificationsList.prepend(newNotificationHtml);

    notificationsCount += 1;
    notificationsCountElem.text(notificationsCount);
    });
    // end itr notif
</script>