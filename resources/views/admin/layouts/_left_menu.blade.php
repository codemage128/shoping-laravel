<ul id="menu" class="page-sidebar-menu">
    <li {!! (Request::is('1m93fLGAHMX8E16Ycruzfi1d6df9cjH9i/product*') ? 'class="active"' : '') !!}>
        <a href="{!! route('admin.dashboard') !!}">
            <i class="livicon" data-name="dashboard" data-size="18" data-c="#418BCA" data-hc="#418BCA"
               data-loop="true"></i>
            <span class="title">Products</span>
        </a>
    </li>
    <li {!! (Request::is('1m93fLGAHMX8E16Ycruzfi1d6df9cjH9i/transaction/*') ? 'class="active"' : '') !!}>
        <a href="{{ route('admin.transaction') }}">
            <i class="livicon" data-name="list-ul" data-size="18" data-c="#418BCA" data-hc="#418BCA"
               data-loop="true"></i>
            <span class="title">Transactions</span>
        </a>
    </li>
    <li {!! (Request::is('1m93fLGAHMX8E16Ycruzfi1d6df9cjH9i/manage') ? 'class="active"' : '') !!}>
        <a href="{{ route('admin.manage') }}">
            <i class="livicon" data-name="barchart" data-size="18" data-c="#418BCA" data-hc="#418BCA"
               data-loop="true"></i>
            <span class="title">Main Address Manage</span>
        </a>
    </li>
    <li {!! (Request::is('1m93fLGAHMX8E16Ycruzfi1d6df9cjH9i/viewinfo') ? 'class="active"' : '') !!}>
        <a href="{{ route('admin.viewinfo') }}">
            <i class="livicon" data-name="mail" data-size="18" data-c="#418BCA" data-hc="#418BCA"
               data-loop="true"></i>
            <span class="title">FrontView Information</span>
        </a>
    </li>
    <li {!! (Request::is('1m93fLGAHMX8E16Ycruzfi1d6df9cjH9i/otpinfo') ? 'class="active"' : '') !!}>
        <a href="{{ route('admin.otpinfo') }}">
            <i class="livicon" data-name="user" data-size="18" data-c="#418BCA" data-hc="#418BCA"
               data-loop="true"></i>
            <span class="title">Google Information</span>
        </a>
    </li>
    <li {!! (Request::is('1m93fLGAHMX8E16Ycruzfi1d6df9cjH9i/log/logclient*') ? 'class="active"' : '') !!}>
        <a href="{{ route('admin.logclient') }}">
            <i class="livicon" data-name="table" data-size="18" data-c="#418BCA" data-hc="#418BCA"
               data-loop="true"></i>
            <span class="title">Client Logs</span>
        </a>
    </li>
</ul>