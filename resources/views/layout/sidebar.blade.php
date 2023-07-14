<div class="sidebar" data-active-color="rose" data-background-color="black" data-image="../assets/img/sidebar-1.jpg">
    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
            CT
        </a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
            Creative Tim
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="../assets/img/faces/avatar.jpg" />
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    <span>
                        {{ session()->get('name') }}
                        <b class="caret"></b>
                    </span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li>
                            <a href="#">
                                <span class="sidebar-mini"> Level </span>
                                <span class="sidebar-normal"> {{ !session()->get('level') ? 'Admin' : 'Supper Admin' }}
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href=" {{ route('logout') }}">
                                <span class="sidebar-mini"> </span>
                                <span class="sidebar-normal"> Logout </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="sidebar-mini"> S </span>
                                <span class="sidebar-normal"> Settings </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li class="active">
                <a href="./dashboard.html">
                    <i class="material-icons">dashboard</i>
                    <p> Dashboard </p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#pagesExamples">
                    <i class="material-icons">image</i>
                    <p> Pages
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="pagesExamples">
                    <ul class="nav">
                        <li>
                            <a href="./pages/pricing.html">
                                <span class="sidebar-mini"> P </span>
                                <span class="sidebar-normal"> Pricing </span>
                            </a>
                        </li>
                        <li>
                            <a href="./pages/rtl.html">
                                <span class="sidebar-mini"> RS </span>
                                <span class="sidebar-normal"> RTL Support </span>
                            </a>
                        </li>
                        <li>
                            <a href="./pages/timeline.html">
                                <span class="sidebar-mini"> T </span>
                                <span class="sidebar-normal"> Timeline </span>
                            </a>
                        </li>
                        <li>
                            <a href="./pages/login.html">
                                <span class="sidebar-mini"> LP </span>
                                <span class="sidebar-normal"> Login Page </span>
                            </a>
                        </li>
                        <li>
                            <a href="./pages/register.html">
                                <span class="sidebar-mini"> RP </span>
                                <span class="sidebar-normal"> Register Page </span>
                            </a>
                        </li>
                        <li>
                            <a href="./pages/lock.html">
                                <span class="sidebar-mini"> LSP </span>
                                <span class="sidebar-normal"> Lock Screen Page </span>
                            </a>
                        </li>
                        <li>
                            <a href="./pages/user.html">
                                <span class="sidebar-mini"> UP </span>
                                <span class="sidebar-normal"> User Profile </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#componentsExamples">
                    <i class="material-icons">apps</i>
                    <p> Components
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="componentsExamples">
                    <ul class="nav">
                        <li>
                            <a href="./components/buttons.html">
                                <span class="sidebar-mini"> B </span>
                                <span class="sidebar-normal"> Buttons </span>
                            </a>
                        </li>
                        <li>
                            <a href="./components/grid.html">
                                <span class="sidebar-mini"> GS </span>
                                <span class="sidebar-normal"> Grid System </span>
                            </a>
                        </li>
                        <li>
                            <a href="./components/panels.html">
                                <span class="sidebar-mini"> P </span>
                                <span class="sidebar-normal"> Panels </span>
                            </a>
                        </li>
                        <li>
                            <a href="./components/sweet-alert.html">
                                <span class="sidebar-mini"> SA </span>
                                <span class="sidebar-normal"> Sweet Alert </span>
                            </a>
                        </li>
                        <li>
                            <a href="./components/notifications.html">
                                <span class="sidebar-mini"> N </span>
                                <span class="sidebar-normal"> Notifications </span>
                            </a>
                        </li>
                        <li>
                            <a href="./components/icons.html">
                                <span class="sidebar-mini"> I </span>
                                <span class="sidebar-normal"> Icons </span>
                            </a>
                        </li>
                        <li>
                            <a href="./components/typography.html">
                                <span class="sidebar-mini"> T </span>
                                <span class="sidebar-normal"> Typography </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#formsExamples">
                    <i class="material-icons">content_paste</i>
                    <p> Forms
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="formsExamples">
                    <ul class="nav">
                        <li>
                            <a href="./forms/regular.html">
                                <span class="sidebar-mini"> RF </span>
                                <span class="sidebar-normal"> Regular Forms </span>
                            </a>
                        </li>
                        <li>
                            <a href="./forms/extended.html">
                                <span class="sidebar-mini"> EF </span>
                                <span class="sidebar-normal"> Extended Forms </span>
                            </a>
                        </li>
                        <li>
                            <a href="./forms/validation.html">
                                <span class="sidebar-mini"> VF </span>
                                <span class="sidebar-normal"> Validation Forms </span>
                            </a>
                        </li>
                        <li>
                            <a href="./forms/wizard.html">
                                <span class="sidebar-mini"> W </span>
                                <span class="sidebar-normal"> Wizard </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#tablesExamples">
                    <i class="material-icons">grid_on</i>
                    <p> Tables
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="tablesExamples">
                    <ul class="nav">
                        <li>
                            <a href="./tables/regular.html">
                                <span class="sidebar-mini"> RT </span>
                                <span class="sidebar-normal"> Regular Tables </span>
                            </a>
                        </li>
                        <li>
                            <a href="./tables/extended.html">
                                <span class="sidebar-mini"> ET </span>
                                <span class="sidebar-normal"> Extended Tables </span>
                            </a>
                        </li>
                        <li>
                            <a href="./tables/datatables.net.html">
                                <span class="sidebar-mini"> DT </span>
                                <span class="sidebar-normal"> DataTables.net </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#mapsExamples">
                    <i class="material-icons">place</i>
                    <p> Maps
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="mapsExamples">
                    <ul class="nav">
                        <li>
                            <a href="./maps/google.html">
                                <span class="sidebar-mini"> GM </span>
                                <span class="sidebar-normal"> Google Maps </span>
                            </a>
                        </li>
                        <li>
                            <a href="./maps/fullscreen.html">
                                <span class="sidebar-mini"> FSM </span>
                                <span class="sidebar-normal"> Full Screen Map </span>
                            </a>
                        </li>
                        <li>
                            <a href="./maps/vector.html">
                                <span class="sidebar-mini"> VM </span>
                                <span class="sidebar-normal"> Vector Map </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="./widgets.html">
                    <i class="material-icons">widgets</i>
                    <p> Widgets </p>
                </a>
            </li>
            <li>
                <a href="./charts.html">
                    <i class="material-icons">timeline</i>
                    <p> Charts </p>
                </a>
            </li>
            <li>
                <a href="./calendar.html">
                    <i class="material-icons">date_range</i>
                    <p> Calendar </p>
                </a>
            </li>
        </ul>
    </div>
</div>
