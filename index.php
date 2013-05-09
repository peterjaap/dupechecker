<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dupe-checker.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Web-based tool to check your listing for duplicates">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="ico/favicon.png">
    <style>
        body { padding:0; }
        .hero-unit {padding-top:30px; }
        div.navbar { position: static; }
        div.textarea textarea { width:100%; height:350px; }
        div.textarea input[type="radio"] { float:left; }
        div.textarea label { float:left; margin-left: 5px; margin-top: 1px;}
        div.textarea p { clear:both; }
        div.output { display:block; }
        p.replacementValues { display:none ;}
        small { font-size:12px; }
        p.delimiter_other { display:none ;}
    </style>                       
    <script>
        function toggleReplaceFields() {
            $('p.replacementValues').toggle();
        }
        $(window).ready(function () {
            $('input[name="replace"]').change(function () {
                toggleReplaceFields();
            });
        });
        function checkDelimiterOther() {
            if($('select[name="delimiter"]').val() == 'other') {
                $('p.delimiter_other').show();
                $('input[name="delimiter_other"]').focus();
            } else {
                $('p.delimiter_other').hide();
            }
        }
    </script>
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">Dupe-checker.com</a>
          <!--div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li class="nav-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
            </ul>
            <form class="navbar-form pull-right">
              <input class="span2" type="text" placeholder="Email">
              <input class="span2" type="password" placeholder="Password">
              <button type="submit" class="btn">Sign in</button>
            </form>
          </div-->
        </div>
      </div>
    </div>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1>Dupe-checker</h1>
        <p>With this web-based tool, you can check your list of entries for duplicates.</p>
        <?php if(!isset($_POST['submit'])): ?>
        <div class="textarea">
            <form action="/" method="post">
                <p class="textarea">
                    <textarea name="input"></textarea>
                </p>
                <div class="row-fluid">
                    <div class="span3">
                        <h3>Filtering</h3>
                        <p>
                            <input type="radio" name="filtering" value="filter" id="filter" checked="checked"/><label for="filter"> List without the duplicate lines</label>
                        </p>
                        <p>
                            <input type="radio" name="filtering" value="find_lines" id="find_lines" /><label for="find_lines"> List of the duplicate lines</label>
                        </p>
                        <p>
                            <input type="radio" name="filtering" value="find_values" id="find_values" /><label for="find_values"> List of the duplicate values</label>
                        </p>
                    </div>
                    <div class="span3">
                        <h3>Sorting</h3>
                        <p>
                            <input type="radio" name="sorting" value="no" id="no" checked="checked" /><label for="no"> Don't sort</label>
                        </p>
                        <p>
                            <input type="radio" name="sorting" value="reverse" id="reverse" /><label for="reverse"> Reverse</label>
                        </p>
                        <p>
                            <input type="radio" name="sorting" value="alphabetically" id="alphabetically" /><label for="alphabetically"> Alphabetically</label>
                        </p>
                        <p>
                            <input type="radio" name="sorting" value="alphabetically_reverse" id="alphabetically_reverse" /><label for="alphabetically_reverse"> Alphabetically reverse</label>
                        </p>
                    </div>
                    <div class="span3">
                        <h3>Replace</h3>
                        <p>
                            <input type="hidden" name="replace" value="no" />
                            <input type="radio" name="replace" value="yes" id="replace_yes" /><label for="replace_yes" id="label_replace_yes"> Replace values in whole input</label>
                        </p>
                        <p class="replacementValues">
                            Replace <input type="text" name="replaceThis" /><br /> with <input type="text" name="replaceWith" />
                            <br /><small>The first box can be a <a href="http://www.regular-expressions.info/">regex</a>.</small>
                        </p>
                    </div>
                    <div class="span3">
                        <h3>Delimiter</h3>
                        <p>
                            <select name="delimiter" onchange="checkDelimiterOther()">
                                <option value="newline">New line</option>
                                <option value=",">Comma</option>
                                <option value=";">Semi-colon</option>
                                <option value="-">Dash</option>
                                <option value="_">Underscore</option>
                                <option value="other">Other;</option>
                            </select>
                        </p>
                        <p class="delimiter_other">
                            <input type="text" name="delimiter_other" />
                        </p>
                    </div>
                </div>
                <p>
                    <input type="submit" class="btn btn-primary btn-large" name="submit" value="Run" />
                </p>
            </form>
        </div>
        <?php else: ?>
        <div class="textarea output">
            <?php
            
            if($_POST['delimiter'] == 'newline') {
                $delimiter = "\n";
            } elseif($_POST['delimiter'] != 'other') {
                $delimiter = $_POST['delimiter'];
            } else {
                $delimiter = $_POST['delimiter_other'];
            }
            $array = explode($delimiter,$_POST['input']);
            
            /* Clean up */
            foreach($array as &$item) {
                $item = trim($item);
            }

            /* Filtering */
            if($_POST['filtering']=='filter') {
                $output = array_unique($array);
                $message = 'Filtered out '.(count($array)-count($output)).' duplicate lines in  your input.';
            } elseif(stripos($_POST['filtering'],'find')!==false) {
                $foundDupes = array();
                foreach($array as $value) {
                    if (count(array_keys($array, $value)) > 1) {
                        if($_POST['filtering']=='find_lines') {
                            $foundDupes[] = $value;
                            $message = 'Found '.count($foundDupes).' duplicate lines in  your input.';
                        } elseif($_POST['filtering']=='find_values') {
                            $foundDupes[$value] = $value;
                            $message = 'Found '.count($foundDupes).' duplicate values in  your input.';
                        }
                    }
                }
                $output = implode($delimiter,$output);
            }
            
            /* Replace */
            if($_POST['replace'] == 'yes') {
                print_r($_POST);
                foreach($output as &$line) {
                    $line = preg_replace('/'.$_POST['replaceThis'].'/',$_POST['replaceWith'],$line);
                }
            }
            
            /* Sorting */
            if(stripos($_POST['sorting'],'alphabetically')!==false) {
                sort($output);
            }
            
            if(stripos($_POST['sorting'],'reverse')!==false) {
                $output = array_reverse($output);
            }
            
            $output = implode($delimiter,$output);
            ?>
            <textarea><?php echo $output; ?></textarea>
            <?php echo $message; ?> <a href="javascript:history.go(-1)">Back.</a>
        </div>
        <?php endif;?>
      </div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="span4">
          <h2>Why?</h2>
          <p><ul>
              <li>Because I'm usually too lazy to install a desktop tool</li>
              <li>Excel doesn't have a built in feature to do this</li>
              <li>Writing a script everytime is a waste of time</li>
              <li>Not everybody knows the glorious awesomeness of <a href="http://www.grymoire.com/Unix/Sed.html">sed</a>, <a href="http://www.linuxjournal.com/article/8913">awk</a>, <a href="http://www.cyberciti.biz/faq/howto-use-grep-command-in-linux-unix/:">grep</a> &amp; <a href="http://linux.about.com/library/cmd/blcmdl1_wc.htm">wc</a></li>
              <li>Because I can</li>
          </ul></p>
        </div>
        <div class="span4">
          <h2>How?</h2>
          <p>Paste your stuff in the textarea above. Then choose some options, hit Run and have some pie for a job well done.</p>
       </div>
        <div class="span4">
          <h2>Wait, wut?</h2>
          <p>Move along people, nothing to see here.</p>
        </div>
      </div>

      <hr>

      <footer>
        <p>&copy; <a href="http://twitter.com/peterjaap">@PeterJaap</a> 2013 / open sourced on <a href="https://github.com/peterjaap/dupechecker">Github</a></p>
      </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>

  </body>
</html>
