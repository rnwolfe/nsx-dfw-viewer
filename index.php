<?php require_once( "ajax/auth.php" ); ?>
<html ng-app="nsxDFWViewer">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>NSX Policy Viewer</title>
    <script src="repo/angular.min.js"></script>
    <script src="repo/angular-animate.min.js"></script>
    <script src="repo/angular-sanitize.min.js"></script>
    <script src="repo/ui-bootstrap-tpls-2.2.0.min.js"></script>
    <link rel="stylesheet" href="repo/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="repo/bootstrap-theme.min.css">
</head>
<body>
  <div class="container">
    <div class="page-header">
      <div><h1>NSX DFW Viewer<p style="margin: 10px 0 0 0;"><small>A responsive tool for viewing the NSX DFW rulebase</small></p></h1></div>
    </div>

    <rulebase></rulebase>

  </div>

  <footer class="footer" style="background-color: #EFEFEF; padding: 15px;">
    <div class="container" style="padding-left: 30px; padding-top: 15px;">
      <p class="text-muted">&copy; Force 3, 2016. Please contact <a href="mailto:rwolfe@force3.com?subject=NSX DFW Viewer Feedback">Ryan Wolfe</a> with any feedback. Licensed under <a href="https://www.gnu.org/licenses/agpl-3.0.en.html">GNU AGPLv3</a>.</p>
    </div>
  </footer>

</body>

<script src="components/rulebase/rulebase.module.js"></script>
<script src="components/rulebase/rulebase.component.js"></script>
<script src="components/core/core.module.js"></script>
<script src="components/core/obj-length/obj-length.filter.js"></script>
<script src="app.js"></script>

</html>