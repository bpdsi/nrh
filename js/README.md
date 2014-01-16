


<!DOCTYPE html>
<html>
  <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# githubog: http://ogp.me/ns/fb/githubog#">
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>jquery.soap/README.md at master · doedje/jquery.soap · GitHub</title>
    <link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="GitHub" />
    <link rel="fluid-icon" href="https://github.com/fluidicon.png" title="GitHub" />
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-114.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-144.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144.png" />
    <link rel="logo" type="image/svg" href="https://github-media-downloads.s3.amazonaws.com/github-logo.svg" />
    <meta property="og:image" content="https://github.global.ssl.fastly.net/images/modules/logos_page/Octocat.png">
    <meta name="hostname" content="fe4.rs.github.com">
    <link rel="assets" href="https://github.global.ssl.fastly.net/">
    <link rel="xhr-socket" href="/_sockets" />
    
    


    <meta name="msapplication-TileImage" content="/windows-tile.png" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="selected-link" value="repo_source" data-pjax-transient />
    <meta content="collector.githubapp.com" name="octolytics-host" /><meta content="github" name="octolytics-app-id" />

    
    
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />

    <meta content="authenticity_token" name="csrf-param" />
<meta content="TgNhLLUaxDRI/fjJZkh2LG91ExJTYOAYUiBEe9t1pus=" name="csrf-token" />

    <link href="https://github.global.ssl.fastly.net/assets/github-c6ca95663cba6496fe7a5bdd98671b82cd956df3.css" media="all" rel="stylesheet" type="text/css" />
    <link href="https://github.global.ssl.fastly.net/assets/github2-d35b02ba3940bde9b9f2c3e58f2dfb1ceff5886c.css" media="all" rel="stylesheet" type="text/css" />
    


      <script src="https://github.global.ssl.fastly.net/assets/frameworks-eae23340ab2a6ba722166712e699c87aaf60ad8f.js" type="text/javascript"></script>
      <script src="https://github.global.ssl.fastly.net/assets/github-a9163d83d307392f83a9e5e521d11f0fea5fd274.js" type="text/javascript"></script>
      
      <meta http-equiv="x-pjax-version" content="62ceebebd58178eb42bf64d77d6e4d30">

        <link data-pjax-transient rel='permalink' href='/doedje/jquery.soap/blob/13c208a4a100134ddf9ce6751cb54c5092fd9b26/README.md'>
  <meta property="og:title" content="jquery.soap"/>
  <meta property="og:type" content="githubog:gitrepository"/>
  <meta property="og:url" content="https://github.com/doedje/jquery.soap"/>
  <meta property="og:image" content="https://github.global.ssl.fastly.net/images/gravatars/gravatar-user-420.png"/>
  <meta property="og:site_name" content="GitHub"/>
  <meta property="og:description" content="jquery.soap - This script uses $.ajax to do a soapRequest. It can take XML DOM, XML string or JSON as input and the response can be returned as either XML DOM, XML string or JSON too. Thanx to proton17, Diccon Towns and Zach Shelton! Let&#39;s $.soap()!"/>

  <meta name="description" content="jquery.soap - This script uses $.ajax to do a soapRequest. It can take XML DOM, XML string or JSON as input and the response can be returned as either XML DOM, XML string or JSON too. Thanx to proton17, Diccon Towns and Zach Shelton! Let&#39;s $.soap()!" />

  <meta content="3636611" name="octolytics-dimension-user_id" /><meta content="doedje" name="octolytics-dimension-user_login" /><meta content="8289861" name="octolytics-dimension-repository_id" /><meta content="doedje/jquery.soap" name="octolytics-dimension-repository_nwo" /><meta content="true" name="octolytics-dimension-repository_public" /><meta content="false" name="octolytics-dimension-repository_is_fork" /><meta content="8289861" name="octolytics-dimension-repository_network_root_id" /><meta content="doedje/jquery.soap" name="octolytics-dimension-repository_network_root_nwo" />
  <link href="https://github.com/doedje/jquery.soap/commits/master.atom" rel="alternate" title="Recent Commits to jquery.soap:master" type="application/atom+xml" />

  </head>


  <body class="logged_out page-blob windows vis-public env-production ">

    <div class="wrapper">
      
      
      


      
      <div class="header header-logged-out">
  <div class="container clearfix">

    <a class="header-logo-wordmark" href="https://github.com/">
      <span class="mega-octicon octicon-logo-github"></span>
    </a>

    <div class="header-actions">
        <a class="button primary" href="/signup">Sign up</a>
      <a class="button" href="/login?return_to=%2Fdoedje%2Fjquery.soap%2Fblob%2Fmaster%2FREADME.md">Sign in</a>
    </div>

    <div class="command-bar js-command-bar  in-repository">


      <ul class="top-nav">
          <li class="explore"><a href="/explore">Explore</a></li>
        <li class="features"><a href="/features">Features</a></li>
          <li class="enterprise"><a href="https://enterprise.github.com/">Enterprise</a></li>
          <li class="blog"><a href="/blog">Blog</a></li>
      </ul>
        <form accept-charset="UTF-8" action="/search" class="command-bar-form" id="top_search_form" method="get">

<input type="text" data-hotkey="/ s" name="q" id="js-command-bar-field" placeholder="Search or type a command" tabindex="1" autocapitalize="off"
    
    
      data-repo="doedje/jquery.soap"
      data-branch="master"
      data-sha="ed086bfdb9585ed95a2263d0b0080585b7e9517d"
  >

    <input type="hidden" name="nwo" value="doedje/jquery.soap" />

    <div class="select-menu js-menu-container js-select-menu search-context-select-menu">
      <span class="minibutton select-menu-button js-menu-target">
        <span class="js-select-button">This repository</span>
      </span>

      <div class="select-menu-modal-holder js-menu-content js-navigation-container">
        <div class="select-menu-modal">

          <div class="select-menu-item js-navigation-item js-this-repository-navigation-item selected">
            <span class="select-menu-item-icon octicon octicon-check"></span>
            <input type="radio" class="js-search-this-repository" name="search_target" value="repository" checked="checked" />
            <div class="select-menu-item-text js-select-button-text">This repository</div>
          </div> <!-- /.select-menu-item -->

          <div class="select-menu-item js-navigation-item js-all-repositories-navigation-item">
            <span class="select-menu-item-icon octicon octicon-check"></span>
            <input type="radio" name="search_target" value="global" />
            <div class="select-menu-item-text js-select-button-text">All repositories</div>
          </div> <!-- /.select-menu-item -->

        </div>
      </div>
    </div>

  <span class="octicon help tooltipped downwards" title="Show command bar help">
    <span class="octicon octicon-question"></span>
  </span>


  <input type="hidden" name="ref" value="cmdform">

</form>
    </div>

  </div>
</div>


      


          <div class="site" itemscope itemtype="http://schema.org/WebPage">
    
    <div class="pagehead repohead instapaper_ignore readability-menu">
      <div class="container">
        

<ul class="pagehead-actions">


  <li>
  <a href="/login?return_to=%2Fdoedje%2Fjquery.soap"
  class="minibutton with-count js-toggler-target star-button entice tooltipped upwards "
  title="You must be signed in to use this feature" rel="nofollow">
  <span class="octicon octicon-star"></span>Star
</a>
<a class="social-count js-social-count" href="/doedje/jquery.soap/stargazers">
  17
</a>

  </li>

    <li>
      <a href="/login?return_to=%2Fdoedje%2Fjquery.soap"
        class="minibutton with-count js-toggler-target fork-button entice tooltipped upwards"
        title="You must be signed in to fork a repository" rel="nofollow">
        <span class="octicon octicon-git-branch"></span>Fork
      </a>
      <a href="/doedje/jquery.soap/network" class="social-count">
        15
      </a>
    </li>
</ul>

        <h1 itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="entry-title public">
          <span class="repo-label"><span>public</span></span>
          <span class="mega-octicon octicon-repo"></span>
          <span class="author">
            <a href="/doedje" class="url fn" itemprop="url" rel="author"><span itemprop="title">doedje</span></a></span
          ><span class="repohead-name-divider">/</span><strong
          ><a href="/doedje/jquery.soap" class="js-current-repository js-repo-home-link">jquery.soap</a></strong>

          <span class="page-context-loader">
            <img alt="Octocat-spinner-32" height="16" src="https://github.global.ssl.fastly.net/images/spinners/octocat-spinner-32.gif" width="16" />
          </span>

        </h1>
      </div><!-- /.container -->
    </div><!-- /.repohead -->

    <div class="container">

      <div class="repository-with-sidebar repo-container ">

        <div class="repository-sidebar">
            

<div class="repo-nav repo-nav-full js-repository-container-pjax js-octicon-loaders">
  <div class="repo-nav-contents">
    <ul class="repo-menu">
      <li class="tooltipped leftwards" title="Code">
        <a href="/doedje/jquery.soap" aria-label="Code" class="js-selected-navigation-item selected" data-gotokey="c" data-pjax="true" data-selected-links="repo_source repo_downloads repo_commits repo_tags repo_branches /doedje/jquery.soap">
          <span class="octicon octicon-code"></span> <span class="full-word">Code</span>
          <img alt="Octocat-spinner-32" class="mini-loader" height="16" src="https://github.global.ssl.fastly.net/images/spinners/octocat-spinner-32.gif" width="16" />
</a>      </li>

        <li class="tooltipped leftwards" title="Issues">
          <a href="/doedje/jquery.soap/issues" aria-label="Issues" class="js-selected-navigation-item js-disable-pjax" data-gotokey="i" data-selected-links="repo_issues /doedje/jquery.soap/issues">
            <span class="octicon octicon-issue-opened"></span> <span class="full-word">Issues</span>
            <span class='counter'>3</span>
            <img alt="Octocat-spinner-32" class="mini-loader" height="16" src="https://github.global.ssl.fastly.net/images/spinners/octocat-spinner-32.gif" width="16" />
</a>        </li>

      <li class="tooltipped leftwards" title="Pull Requests"><a href="/doedje/jquery.soap/pulls" aria-label="Pull Requests" class="js-selected-navigation-item js-disable-pjax" data-gotokey="p" data-selected-links="repo_pulls /doedje/jquery.soap/pulls">
            <span class="octicon octicon-git-pull-request"></span> <span class="full-word">Pull Requests</span>
            <span class='counter'>1</span>
            <img alt="Octocat-spinner-32" class="mini-loader" height="16" src="https://github.global.ssl.fastly.net/images/spinners/octocat-spinner-32.gif" width="16" />
</a>      </li>


    </ul>
    <div class="repo-menu-separator"></div>
    <ul class="repo-menu">

      <li class="tooltipped leftwards" title="Pulse">
        <a href="/doedje/jquery.soap/pulse" aria-label="Pulse" class="js-selected-navigation-item " data-pjax="true" data-selected-links="pulse /doedje/jquery.soap/pulse">
          <span class="octicon octicon-pulse"></span> <span class="full-word">Pulse</span>
          <img alt="Octocat-spinner-32" class="mini-loader" height="16" src="https://github.global.ssl.fastly.net/images/spinners/octocat-spinner-32.gif" width="16" />
</a>      </li>

      <li class="tooltipped leftwards" title="Graphs">
        <a href="/doedje/jquery.soap/graphs" aria-label="Graphs" class="js-selected-navigation-item " data-pjax="true" data-selected-links="repo_graphs repo_contributors /doedje/jquery.soap/graphs">
          <span class="octicon octicon-graph"></span> <span class="full-word">Graphs</span>
          <img alt="Octocat-spinner-32" class="mini-loader" height="16" src="https://github.global.ssl.fastly.net/images/spinners/octocat-spinner-32.gif" width="16" />
</a>      </li>

      <li class="tooltipped leftwards" title="Network">
        <a href="/doedje/jquery.soap/network" aria-label="Network" class="js-selected-navigation-item js-disable-pjax" data-selected-links="repo_network /doedje/jquery.soap/network">
          <span class="octicon octicon-git-branch"></span> <span class="full-word">Network</span>
          <img alt="Octocat-spinner-32" class="mini-loader" height="16" src="https://github.global.ssl.fastly.net/images/spinners/octocat-spinner-32.gif" width="16" />
</a>      </li>

    </ul>

  </div>
</div>

            <div class="only-with-full-nav">
              

  

<div class="clone-url open"
  data-protocol-type="http"
  data-url="/users/set_protocol?protocol_selector=http&amp;protocol_type=clone">
  <h3><strong>HTTPS</strong> clone URL</h3>

  <input type="text" class="clone js-url-field"
         value="https://github.com/doedje/jquery.soap.git" readonly="readonly">

  <span class="js-zeroclipboard url-box-clippy minibutton zeroclipboard-button" data-clipboard-text="https://github.com/doedje/jquery.soap.git" data-copied-hint="copied!" title="copy to clipboard"><span class="octicon octicon-clippy"></span></span>
</div>

  

<div class="clone-url "
  data-protocol-type="subversion"
  data-url="/users/set_protocol?protocol_selector=subversion&amp;protocol_type=clone">
  <h3><strong>Subversion</strong> checkout URL</h3>

  <input type="text" class="clone js-url-field"
         value="https://github.com/doedje/jquery.soap" readonly="readonly">

  <span class="js-zeroclipboard url-box-clippy minibutton zeroclipboard-button" data-clipboard-text="https://github.com/doedje/jquery.soap" data-copied-hint="copied!" title="copy to clipboard"><span class="octicon octicon-clippy"></span></span>
</div>



<p class="clone-options">You can clone with
    <a href="#" class="js-clone-selector" data-protocol="http">HTTPS</a>,
    <a href="#" class="js-clone-selector" data-protocol="subversion">Subversion</a>,
  and <a href="https://help.github.com/articles/which-remote-url-should-i-use">other methods.</a>
</p>


  <a href="http://windows.github.com" class="minibutton sidebar-button">
    <span class="octicon octicon-device-desktop"></span>
    Clone in Desktop
  </a>

                <a href="/doedje/jquery.soap/archive/master.zip"
                   class="minibutton sidebar-button"
                   title="Download this repository as a zip file"
                   rel="nofollow">
                  <span class="octicon octicon-cloud-download"></span>
                  Download ZIP
                </a>
            </div>
        </div><!-- /.repository-sidebar -->

        <div id="js-repo-pjax-container" class="repository-content context-loader-container" data-pjax-container>
          


<!-- blob contrib key: blob_contributors:v21:64370b79a544234dbedd5e66cb0e1990 -->
<!-- blob contrib frag key: views10/v8/blob_contributors:v21:64370b79a544234dbedd5e66cb0e1990 -->

<p title="This is a placeholder element" class="js-history-link-replace hidden"></p>

<a href="/doedje/jquery.soap/find/master" data-pjax data-hotkey="t" style="display:none">Show File Finder</a>

<div class="file-navigation">
  


<div class="select-menu js-menu-container js-select-menu" >
  <span class="minibutton select-menu-button js-menu-target" data-hotkey="w"
    data-master-branch="master"
    data-ref="master">
    <span class="octicon octicon-git-branch"></span>
    <i>branch:</i>
    <span class="js-select-button">master</span>
  </span>

  <div class="select-menu-modal-holder js-menu-content js-navigation-container" data-pjax>

    <div class="select-menu-modal">
      <div class="select-menu-header">
        <span class="select-menu-title">Switch branches/tags</span>
        <span class="octicon octicon-remove-close js-menu-close"></span>
      </div> <!-- /.select-menu-header -->

      <div class="select-menu-filters">
        <div class="select-menu-text-filter">
          <input type="text" id="context-commitish-filter-field" class="js-filterable-field js-navigation-enable" placeholder="Filter branches/tags">
        </div>
        <div class="select-menu-tabs">
          <ul>
            <li class="select-menu-tab">
              <a href="#" data-tab-filter="branches" class="js-select-menu-tab">Branches</a>
            </li>
            <li class="select-menu-tab">
              <a href="#" data-tab-filter="tags" class="js-select-menu-tab">Tags</a>
            </li>
          </ul>
        </div><!-- /.select-menu-tabs -->
      </div><!-- /.select-menu-filters -->

      <div class="select-menu-list select-menu-tab-bucket js-select-menu-tab-bucket" data-tab-filter="branches">

        <div data-filterable-for="context-commitish-filter-field" data-filterable-type="substring">


            <div class="select-menu-item js-navigation-item selected">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/doedje/jquery.soap/blob/master/README.md" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="master" data-skip-pjax="true" rel="nofollow" title="master">master</a>
            </div> <!-- /.select-menu-item -->
        </div>

          <div class="select-menu-no-results">Nothing to show</div>
      </div> <!-- /.select-menu-list -->

      <div class="select-menu-list select-menu-tab-bucket js-select-menu-tab-bucket" data-tab-filter="tags">
        <div data-filterable-for="context-commitish-filter-field" data-filterable-type="substring">


            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/doedje/jquery.soap/blob/1.1.0/README.md" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.1.0" data-skip-pjax="true" rel="nofollow" title="1.1.0">1.1.0</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/doedje/jquery.soap/blob/1.0.7/README.md" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.0.7" data-skip-pjax="true" rel="nofollow" title="1.0.7">1.0.7</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/doedje/jquery.soap/blob/1.0.6/README.md" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.0.6" data-skip-pjax="true" rel="nofollow" title="1.0.6">1.0.6</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/doedje/jquery.soap/blob/1.0.5/README.md" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.0.5" data-skip-pjax="true" rel="nofollow" title="1.0.5">1.0.5</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/doedje/jquery.soap/blob/1.0.4/README.md" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.0.4" data-skip-pjax="true" rel="nofollow" title="1.0.4">1.0.4</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/doedje/jquery.soap/blob/1.0.3/README.md" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.0.3" data-skip-pjax="true" rel="nofollow" title="1.0.3">1.0.3</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/doedje/jquery.soap/blob/1.0.2/README.md" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.0.2" data-skip-pjax="true" rel="nofollow" title="1.0.2">1.0.2</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/doedje/jquery.soap/blob/1.0.1/README.md" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.0.1" data-skip-pjax="true" rel="nofollow" title="1.0.1">1.0.1</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/doedje/jquery.soap/blob/1.0.0/README.md" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="1.0.0" data-skip-pjax="true" rel="nofollow" title="1.0.0">1.0.0</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/doedje/jquery.soap/blob/0.10.0/README.md" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="0.10.0" data-skip-pjax="true" rel="nofollow" title="0.10.0">0.10.0</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/doedje/jquery.soap/blob/0.9.4/README.md" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="0.9.4" data-skip-pjax="true" rel="nofollow" title="0.9.4">0.9.4</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/doedje/jquery.soap/blob/0.9.3/README.md" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="0.9.3" data-skip-pjax="true" rel="nofollow" title="0.9.3">0.9.3</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/doedje/jquery.soap/blob/0.9.2/README.md" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="0.9.2" data-skip-pjax="true" rel="nofollow" title="0.9.2">0.9.2</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/doedje/jquery.soap/blob/0.9.1/README.md" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="0.9.1" data-skip-pjax="true" rel="nofollow" title="0.9.1">0.9.1</a>
            </div> <!-- /.select-menu-item -->
            <div class="select-menu-item js-navigation-item ">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <a href="/doedje/jquery.soap/blob/0.9.0/README.md" class="js-navigation-open select-menu-item-text js-select-button-text css-truncate-target" data-name="0.9.0" data-skip-pjax="true" rel="nofollow" title="0.9.0">0.9.0</a>
            </div> <!-- /.select-menu-item -->
        </div>

        <div class="select-menu-no-results">Nothing to show</div>
      </div> <!-- /.select-menu-list -->

    </div> <!-- /.select-menu-modal -->
  </div> <!-- /.select-menu-modal-holder -->
</div> <!-- /.select-menu -->

  <div class="breadcrumb">
    <span class='repo-root js-repo-root'><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="/doedje/jquery.soap" data-branch="master" data-direction="back" data-pjax="true" itemscope="url"><span itemprop="title">jquery.soap</span></a></span></span><span class="separator"> / </span><strong class="final-path">README.md</strong> <span class="js-zeroclipboard minibutton zeroclipboard-button" data-clipboard-text="README.md" data-copied-hint="copied!" title="copy to clipboard"><span class="octicon octicon-clippy"></span></span>
  </div>
</div>


  
  <div class="commit file-history-tease">
    <img class="main-avatar" height="24" src="https://secure.gravatar.com/avatar/f4a2521253b521c56fae842e76d5e5d7?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="24" />
    <span class="author"><a href="/doedje" rel="author">doedje</a></span>
    <time class="js-relative-date" datetime="2013-07-11T00:57:40-07:00" title="2013-07-11 00:57:40">July 11, 2013</time>
    <div class="commit-title">
        <a href="/doedje/jquery.soap/commit/46a22463471dc3f8d8b0e3d19d7e33dd19d32f0e" class="message" data-pjax="true">- preparing version 1.1.0 (Added WSS)</a>
    </div>

    <div class="participation">
      <p class="quickstat"><a href="#blob_contributors_box" rel="facebox"><strong>2</strong> contributors</a></p>
          <a class="avatar tooltipped downwards" title="doedje" href="/doedje/jquery.soap/commits/master/README.md?author=doedje"><img height="20" src="https://secure.gravatar.com/avatar/f4a2521253b521c56fae842e76d5e5d7?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="20" /></a>
    <a class="avatar tooltipped downwards" title="wibron" href="/doedje/jquery.soap/commits/master/README.md?author=wibron"><img height="20" src="https://secure.gravatar.com/avatar/fcc8322bbea6af06abbcb437d42f894a?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="20" /></a>


    </div>
    <div id="blob_contributors_box" style="display:none">
      <h2 class="facebox-header">Users who have contributed to this file</h2>
      <ul class="facebox-user-list">
        <li class="facebox-user-list-item">
          <img height="24" src="https://secure.gravatar.com/avatar/f4a2521253b521c56fae842e76d5e5d7?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="24" />
          <a href="/doedje">doedje</a>
        </li>
        <li class="facebox-user-list-item">
          <img height="24" src="https://secure.gravatar.com/avatar/fcc8322bbea6af06abbcb437d42f894a?s=140&amp;d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" width="24" />
          <a href="/wibron">wibron</a>
        </li>
      </ul>
    </div>
  </div>


<div id="files" class="bubble">
  <div class="file">
    <div class="meta">
      <div class="info">
        <span class="icon"><b class="octicon octicon-file-text"></b></span>
        <span class="mode" title="File Mode">file</span>
          <span>265 lines (218 sloc)</span>
        <span>10.461 kb</span>
      </div>
      <div class="actions">
        <div class="button-group">
              <a class="minibutton js-entice" href=""
                 data-entice="You must be signed in to make or propose changes">Edit</a>
          <a href="/doedje/jquery.soap/raw/master/README.md" class="button minibutton " id="raw-url">Raw</a>
            <a href="/doedje/jquery.soap/blame/master/README.md" class="button minibutton ">Blame</a>
          <a href="/doedje/jquery.soap/commits/master/README.md" class="button minibutton " rel="nofollow">History</a>
        </div><!-- /.button-group -->
            <a class="minibutton danger empty-icon js-entice" href=""
               data-entice="You must be signed in and on a branch to make or propose changes">
            Delete
          </a>
      </div><!-- /.actions -->

    </div>
      
  <div id="readme" class="blob instapaper_body">
    <article class="markdown-body entry-content" itemprop="mainContentOfPage"><h1>
<a name="jquery-soap" class="anchor" href="#jquery-soap"><span class="octicon octicon-link"></span></a>jQuery Soap</h1>

<p><strong>file:</strong> jquery.soap.js<br><strong>version:</strong> 1.1.0</p>

<h2>
<a name="jquery-plugin-for-communicating-with-a-web-service-using-soap" class="anchor" href="#jquery-plugin-for-communicating-with-a-web-service-using-soap"><span class="octicon octicon-link"></span></a>jQuery plugin for communicating with a web service using SOAP.</h2>

<p>This script uses $.ajax to do a soapRequest. It can take XML DOM, XML string or JSON as input and the response can be returned as either XML DOM, XML string or JSON too.</p>

<p>Thanx to proton17, Diccon Towns and Zach Shelton!</p>

<p><strong>Let's $.soap()!</strong></p>

<p><em><strong>NOTE:</strong> Please see my note on contacting me about issues, bugs, problems or any other questions below before sending me mail....</em></p>

<h2>
<a name="example" class="anchor" href="#example"><span class="octicon octicon-link"></span></a>Example</h2>

<div class="highlight"><pre><span class="nx">$</span><span class="p">.</span><span class="nx">soap</span><span class="p">({</span>
    <span class="nx">url</span><span class="o">:</span> <span class="s1">'http://my.server.com/soapservices/'</span><span class="p">,</span>
    <span class="nx">method</span><span class="o">:</span> <span class="s1">'helloWorld'</span><span class="p">,</span>

    <span class="nx">params</span><span class="o">:</span> <span class="p">{</span>
        <span class="nx">name</span><span class="o">:</span> <span class="s1">'Remy Blom'</span><span class="p">,</span>
        <span class="nx">msg</span><span class="o">:</span> <span class="s1">'Hi!'</span>
    <span class="p">},</span>

    <span class="nx">success</span><span class="o">:</span> <span class="kd">function</span> <span class="p">(</span><span class="nx">soapResponse</span><span class="p">)</span> <span class="p">{</span>
        <span class="c1">// do stuff with soapResponse</span>
        <span class="c1">// if you want to have the response as JSON use soapResponse.toJSON();</span>
        <span class="c1">// or soapResponse.toString() to get XML string</span>
        <span class="c1">// or soapResponse.toXML() to get XML DOM</span>
    <span class="p">},</span>
    <span class="nx">error</span><span class="o">:</span> <span class="kd">function</span> <span class="p">(</span><span class="nx">SOAPResponse</span><span class="p">)</span> <span class="p">{</span>
        <span class="c1">// show error</span>
    <span class="p">}</span>
<span class="p">});</span>
</pre></div>

<p>This will create the following XML:</p>

<div class="highlight"><pre><span class="nt">&lt;soap:Envelope</span>
    <span class="na">xmlns:soap=</span><span class="s">"http://schemas.xmlsoap.org/soap/envelope/"</span><span class="nt">&gt;</span>
    <span class="nt">&lt;soap:Body&gt;</span>
        <span class="nt">&lt;helloWorld&gt;</span>
            <span class="nt">&lt;name&gt;</span>Remy Blom<span class="nt">&lt;/name&gt;</span>
            <span class="nt">&lt;msg&gt;</span>Hi!<span class="nt">&lt;/msg&gt;</span>
        <span class="nt">&lt;/helloWorld&gt;</span>
    <span class="nt">&lt;/soap:Body&gt;</span>
<span class="nt">&lt;/soap:Envelope&gt;</span>
</pre></div>

<p>And this will be send to: url + method
<a href="http://my.server.com/soapservices/helloWorld">http://my.server.com/soapservices/helloWorld</a></p>

<h2>
<a name="options" class="anchor" href="#options"><span class="octicon octicon-link"></span></a>Options</h2>

<div class="highlight"><pre><span class="p">{</span>
    <span class="nx">url</span><span class="o">:</span> <span class="s1">'http://my.server.com/soapservices/'</span><span class="p">,</span>      <span class="c1">//endpoint address for the service</span>
    <span class="nx">method</span><span class="o">:</span> <span class="s1">'helloWorld'</span><span class="p">,</span>                           <span class="c1">// service operation name</span>
                                                    <span class="c1">// 1) will be appended to url if appendMethodToURL=true</span>
                                                    <span class="c1">// 2) will be used for request element name when building xml from JSON 'params' (unless 'elementName' is provided)</span>
    <span class="nx">appendMethodToURL</span><span class="o">:</span> <span class="kc">true</span><span class="p">,</span>                        <span class="c1">// method name will be appended to URL defaults to true</span>
    <span class="nx">SOAPAction</span><span class="o">:</span> <span class="s1">'action'</span><span class="p">,</span>                           <span class="c1">// manually set the Request Header 'SOAPAction', defaults to the method specified above (optional)</span>
    <span class="nx">soap12</span><span class="o">:</span> <span class="kc">false</span><span class="p">,</span>                                  <span class="c1">// use SOAP 1.2 namespace and HTTP headers - default to false</span>

    <span class="c1">//params can be XML DOM, XML String, or JSON</span>
    <span class="nx">params</span><span class="o">:</span> <span class="nx">domXmlObject</span><span class="p">,</span>                           <span class="c1">// XML DOM object</span>
    <span class="nx">params</span><span class="o">:</span> <span class="nx">xmlString</span><span class="p">,</span>                              <span class="c1">// XML String for request (alternative to internal build of XML from JSON 'params')</span>
    <span class="nx">params</span><span class="o">:</span> <span class="p">{</span>                                       <span class="c1">// JSON structure used to build request XML - SHOULD be coupled with ('namespaceQualifier' AND 'namespaceURL') AND ('method' OR 'elementName')</span>
        <span class="nx">name</span><span class="o">:</span> <span class="s1">'Remy Blom'</span><span class="p">,</span>
        <span class="nx">msg</span><span class="o">:</span> <span class="s1">'Hi!'</span>
    <span class="p">},</span>

    <span class="c1">//these options ONLY apply when the request XML is going to be built from JSON 'params'</span>
    <span class="nx">namespaceQualifier</span><span class="o">:</span> <span class="s1">'myns'</span><span class="p">,</span>                     <span class="c1">// used as namespace prefix for all elements in request (optional)</span>
    <span class="nx">namespaceURL</span><span class="o">:</span> <span class="s1">'urn://service.my.server.com'</span><span class="p">,</span>    <span class="c1">// namespace url added to parent request element (optional)</span>
    <span class="nx">elementName</span><span class="o">:</span> <span class="s1">'requestElementName'</span><span class="p">,</span>              <span class="c1">// override 'method' as outer element (optional)</span>

    <span class="c1">// WS-Security</span>
    <span class="nx">wss</span><span class="o">:</span> <span class="p">{</span>
        <span class="nx">username</span><span class="o">:</span> <span class="s1">'user'</span><span class="p">,</span>
        <span class="nx">password</span><span class="o">:</span> <span class="s1">'pass'</span><span class="p">,</span>
        <span class="nx">nonce</span><span class="o">:</span> <span class="s1">'w08370jf7340qephufqp3r4'</span><span class="p">,</span>
        <span class="nx">created</span><span class="o">:</span> <span class="k">new</span> <span class="nb">Date</span><span class="p">().</span><span class="nx">getTime</span><span class="p">()</span>
    <span class="p">},</span>

    <span class="c1">//callback functions</span>
    <span class="nx">request</span><span class="o">:</span> <span class="kd">function</span> <span class="p">(</span><span class="nx">SOAPRequest</span><span class="p">)</span>  <span class="p">{},</span>            <span class="c1">// callback function - request object is passed back prior to ajax call (optional)</span>
    <span class="nx">success</span><span class="o">:</span> <span class="kd">function</span> <span class="p">(</span><span class="nx">SOAPResponse</span><span class="p">)</span> <span class="p">{},</span>            <span class="c1">// callback function to handle successful return (required)</span>
    <span class="nx">error</span><span class="o">:</span>   <span class="kd">function</span> <span class="p">(</span><span class="nx">SOAPResponse</span><span class="p">)</span> <span class="p">{},</span>            <span class="c1">// callback function to handle fault return (required)</span>

    <span class="c1">// debugging</span>
    <span class="nx">enableLogging</span><span class="o">:</span> <span class="kc">true</span>                             <span class="c1">// to enable the local log function set to true, defaults to false (optional)</span>
<span class="p">}</span>
</pre></div>

<h2>
<a name="config-call" class="anchor" href="#config-call"><span class="octicon octicon-link"></span></a>Config call</h2>

<p>Since version 0.9.3 it is possible to make a call to <strong>$.soap</strong> just to set extra config values. When you have a lot of calls to $.soap and are tired of repeating the same values for url, returnJson, namespace and error for instance, this new approach can come in handy:</p>

<div class="highlight"><pre><span class="nx">$</span><span class="p">.</span><span class="nx">soap</span><span class="p">({</span>
    <span class="nx">url</span><span class="o">:</span> <span class="s1">'http://my.server.com/soapservices/'</span><span class="p">,</span>
    <span class="nx">namespaceQualifier</span><span class="o">:</span> <span class="s1">'myns'</span><span class="p">,</span>
    <span class="nx">namespaceURL</span><span class="o">:</span> <span class="s1">'urn://service.my.server.com'</span><span class="p">,</span>
    <span class="nx">error</span><span class="o">:</span> <span class="kd">function</span> <span class="p">(</span><span class="nx">soapResponse</span><span class="p">)</span> <span class="p">{</span>
        <span class="c1">// show error</span>
    <span class="p">}</span>
<span class="p">});</span>

<span class="nx">$</span><span class="p">.</span><span class="nx">soap</span><span class="p">({</span>
    <span class="nx">method</span><span class="o">:</span> <span class="s1">'helloWorld'</span><span class="p">,</span>
    <span class="nx">params</span><span class="o">:</span> <span class="p">{</span>
        <span class="nx">name</span><span class="o">:</span> <span class="s1">'Remy Blom'</span><span class="p">,</span>
        <span class="nx">msg</span><span class="o">:</span> <span class="s1">'Hi!'</span>
    <span class="p">},</span>
    <span class="nx">success</span><span class="o">:</span> <span class="kd">function</span> <span class="p">(</span><span class="nx">soapResponse</span><span class="p">)</span> <span class="p">{</span>
        <span class="c1">// do stuff with soapResponse</span>
    <span class="p">}</span>
<span class="p">});</span>
</pre></div>

<p>The code above will do exactly the same as the first example, but when you want to do another call to the same soapserver you only have to specify the changed values:</p>

<div class="highlight"><pre><span class="nx">$</span><span class="p">.</span><span class="nx">soap</span><span class="p">({</span>
    <span class="nx">method</span><span class="o">:</span> <span class="s1">'doSomethingElse'</span><span class="p">,</span>
    <span class="nx">params</span><span class="o">:</span> <span class="p">{...},</span>
    <span class="nx">success</span><span class="o">:</span> <span class="kd">function</span> <span class="p">(</span><span class="nx">soapResponse</span><span class="p">)</span> <span class="p">{</span>
        <span class="c1">// do stuff with soapResponse</span>
    <span class="p">}</span>
<span class="p">});</span>
</pre></div>

<p>But it won't stop you from doing a call to a completely different soapserver with a different error handler for instance, like so:</p>

<div class="highlight"><pre><span class="nx">$</span><span class="p">.</span><span class="nx">soap</span><span class="p">({</span>
    <span class="nx">url</span><span class="o">:</span> <span class="s1">'http://another.server.com/anotherService'</span>
    <span class="nx">method</span><span class="o">:</span> <span class="s1">'helloWorld'</span><span class="p">,</span>
    <span class="nx">params</span><span class="o">:</span> <span class="p">{</span>
        <span class="nx">name</span><span class="o">:</span> <span class="s1">'Remy Blom'</span><span class="p">,</span>
        <span class="nx">msg</span><span class="o">:</span> <span class="s1">'Hi!'</span>
    <span class="p">},</span>
    <span class="nx">success</span><span class="o">:</span> <span class="kd">function</span> <span class="p">(</span><span class="nx">soapResponse</span><span class="p">)</span> <span class="p">{</span>
        <span class="c1">// do stuff with soapResponse</span>
    <span class="p">},</span>
    <span class="nx">error</span><span class="o">:</span> <span class="kd">function</span> <span class="p">(</span><span class="nx">soapResponse</span><span class="p">)</span> <span class="p">{</span>
        <span class="nx">alert</span><span class="p">(</span><span class="s1">'that other server might be down...'</span><span class="p">)</span>
    <span class="p">}</span>
<span class="p">});</span>
</pre></div>

<p><em><strong>NOTE</strong>: the <strong>param</strong> is used as a key. If no param is specified in the options passed to <strong>$.soap</strong> all options are stored in the globalConfig, there won't be a soapRequest. When a method is specified the globalConfig will be used and all options passed to <strong>$.soap</strong> will overrule those in globalConfig, but keep in mind, they won't be overwritten!</em></p>

<h2>
<a name="ws-security" class="anchor" href="#ws-security"><span class="octicon octicon-link"></span></a>WS-Security</h2>

<p>As from version 1.1.0 jQuery.soap supports a very basic form of WSS. This feature was requested (issue #9) and rather easy to implement, but I don't have a way to test it properly. So if you run into problems, please let me know (see below)</p>

<pre><code>$.soap({
    // other parameters..

    // WS-Security
    wss: {
        username: 'user',
        password: 'pass',
        nonce: 'w08370jf7340qephufqp3r4',
        created: new Date().getTime()
    }
});
</code></pre>

<h2>
<a name="same-origin-policy" class="anchor" href="#same-origin-policy"><span class="octicon octicon-link"></span></a>Same Origin Policy</h2>

<p>You won't be able to have a page on <a href="http://www.example.com">http://www.example.com</a> do an ajax call ($.soap is using $.ajax internally) to <a href="http://www.anotherdomain.com">http://www.anotherdomain.com</a> due to Same Origin Policy. To overcome this you should either install a proxy on <a href="http://www.example.com">http://www.example.com</a> or use CORS. Keep in mind that it also not allowed to go from <a href="http://www.example.com">http://www.example.com</a> to <a href="http://soap.example.com">http://soap.example.com</a> or even to <a href="http://www.example.com:8080">http://www.example.com:8080</a></p>

<h2>
<a name="demo-page" class="anchor" href="#demo-page"><span class="octicon octicon-link"></span></a>Demo page</h2>

<p>I included a simple demo page that you can use for testing. It allows you to play around with all the options for $.soap. Please take note that to make it work with your SOAP services you are bound by the same origin policy.</p>

<h2>
<a name="dependencies" class="anchor" href="#dependencies"><span class="octicon octicon-link"></span></a>Dependencies</h2>

<p>jQuery -- built and tested with v1.9.1, MAY work back to v1.6<br>
SOAPResponse.toJSON() depends on <strong>jQuery.xml2json.js</strong></p>

<h2>
<a name="contacting-me" class="anchor" href="#contacting-me"><span class="octicon octicon-link"></span></a>Contacting me</h2>

<p>Please note I don't mind you contacting me when you run into trouble implementing this plugin. But to keep things nice for me too, just follow these simple guidelines when you do:</p>

<ul>
<li>check the issues on <a href="https://github.com/doedje/jquery.soap/issues/">https://github.com/doedje/jquery.soap/issues/</a> to see if someone else already had your problem, if not</li>
<li>open an issue on <a href="https://github.com/doedje/jquery.soap/issues/">https://github.com/doedje/jquery.soap/issues/</a> instead of sending me mail. This way others can learn from your case too! Please include the following:

<ul>
<li>the versions of your jquery and jquery.soap</li>
<li>your $.soap call</li>
<li>the request as sent to the server</li>
<li>the response from the server</li>
</ul>
</li>
</ul><p><em>I also have a dayjob with deadlines and I'm a dad of two lovely little girls, so please understand I am not always able to reply to you... <strong>Thanx for understanding!! =]</strong></em></p>

<h2>
<a name="license" class="anchor" href="#license"><span class="octicon octicon-link"></span></a>License</h2>

<p>jquery.soap is based on jqSOAPClient.beta.js which was licensed under GNU/GPLv3</p>

<p>This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.</p>

<p>This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.</p>

<p>You should have received a copy of the GNU General Public License
along with this program. If not, see <a href="http://www.gnu.org/licenses/">http://www.gnu.org/licenses/</a>.</p>

<p><strong>I may consider permitting uses outside of the license terms on a by-case basis.</strong></p>

<h2>
<a name="authors--history" class="anchor" href="#authors--history"><span class="octicon octicon-link"></span></a>Authors / History</h2>

<p>2013-06 &gt;&gt; fix for SOAPServer and SOAPAction headers, better params object to SOAPObject function<br>
Remy Blom == <a href="http://www.hku.nl">www.hku.nl</a> == <a href="mailto:remy.blom@kmt.hku.nl">remy.blom@kmt.hku.nl</a><br>
Utrecht School of Arts,The Netherlands</p>

<p>2013-03 &gt;&gt; update internal OO structure, enable XML &amp; object input as well as JSON<br>
Zach Shelton == zachofalltrades.net<br><a href="https://github.com/zachofalltrades/jquery.soap">https://github.com/zachofalltrades/jquery.soap</a></p>

<p>2013-02-19 &gt;&gt; published to plugins.jquery.com/soap/<br>
Remy Blom == <a href="https://github.com/doedje/jquery.soap">https://github.com/doedje/jquery.soap</a></p>

<p>2011-10-31 &gt;&gt; fix handling of arrays in JSON paramaters<br>
Diccon Towns == <a href="mailto:dtowns@reapit.com">dtowns@reapit.com</a></p>

<p>2009-12-03 &gt;&gt; wrap jqSOAPClient as plugin<br>
Remy Blom == <a href="http://www.hku.nl">www.hku.nl</a> == <a href="mailto:remy.blom@kmt.hku.nl">remy.blom@kmt.hku.nl</a><br>
Utrecht School of Arts,The Netherlands</p>

<p>2007-12-20 &gt;&gt; jqSOAPClient.beta.js by proton17<br><a href="http://archive.plugins.jquery.com/project/jqSOAPClient">http://archive.plugins.jquery.com/project/jqSOAPClient</a></p>

<h2>
<a name="changelog" class="anchor" href="#changelog"><span class="octicon octicon-link"></span></a>Changelog</h2>

<table>
<thead><tr>
<th>Version</th>
<th>Date</th>
<th>Changes</th>
</tr></thead>
<tbody>
<tr>
<td>1.1.0</td>
<td>2013-07-11</td>
<td>Added WSS functionality</td>
</tr>
<tr>
<td>1.0.7</td>
<td>2013-07-03</td>
<td>Changed the license to GNU GPLv3, I could never have used the MIT license since jqSOAPClient.beta.js is already licensed GNU GPLv3</td>
</tr>
<tr>
<td>1.0.6</td>
<td>2013-06-27</td>
<td>params object to SOAPObject code fixed for complex object/array combi's</td>
</tr>
<tr>
<td>1.0.5</td>
<td>2013-06-20</td>
<td>enableLogging is an option, changed namespaceUrl to namespaceURL (with fallback)</td>
</tr>
<tr>
<td>1.0.4</td>
<td>2013-06-20</td>
<td>Fix to the manifest file, new version# needed to publish to plugins.jquery.com</td>
</tr>
<tr>
<td>1.0.3</td>
<td>2013-06-20</td>
<td>Included a little demo and fixed SOAPServer and SOAPAction request headers</td>
</tr>
<tr>
<td>1.0.2</td>
<td>2013-04-02</td>
<td>Fix to the manifest file, new version# needed to publish to plugins.jquery.com</td>
</tr>
<tr>
<td>1.0.1</td>
<td>2013-04-02</td>
<td>Fix to the manifest file, new version# needed to publish to plugins.jquery.com</td>
</tr>
<tr>
<td>1.0.0</td>
<td>2013-04-02</td>
<td>Minor fix (return for dom2string in reponse)</td>
</tr>
<tr>
<td>0.10.0</td>
<td>2013-03-29</td>
<td>The <strong>First Zach Shelton version</strong>, better code, XML DOM, XML string and JSON in and out</td>
</tr>
<tr>
<td>0.9.4</td>
<td>2013-02-26</td>
<td>changed the charset of soapRequest to UTF-8 and removed the " quotes</td>
</tr>
<tr>
<td>0.9.3</td>
<td>2013-02-26</td>
<td>Added the possibility to call <strong>$.soap</strong> just to set extra config values.</td>
</tr>
<tr>
<td>0.9.2</td>
<td>2013-02-21</td>
<td>some extra cleaning of stupid code in my part of the script. Now it uses the addNamespace function to properly set namespaces.</td>
</tr>
<tr>
<td>0.9.1</td>
<td>2013-02-20</td>
<td>minor changes to keep LINT happy.</td>
</tr>
<tr>
<td>0.9.0</td>
<td>2013-02-20</td>
<td>first version to go on the new jQuery plugin page, changed the name of the function from $.soapRequest to <strong>$.soap</strong>
</td>
</tr>
</tbody>
</table></article>
  </div>

  </div>
</div>

<a href="#jump-to-line" rel="facebox[.linejump]" data-hotkey="l" class="js-jump-to-line" style="display:none">Jump to Line</a>
<div id="jump-to-line" style="display:none">
  <form accept-charset="UTF-8" class="js-jump-to-line-form">
    <input class="linejump-input js-jump-to-line-field" type="text" placeholder="Jump to line&hellip;" autofocus>
    <button type="submit" class="button">Go</button>
  </form>
</div>

        </div>

      </div><!-- /.repo-container -->
      <div class="modal-backdrop"></div>
    </div><!-- /.container -->
  </div><!-- /.site -->


    </div><!-- /.wrapper -->

      <div class="container">
  <div class="site-footer">
    <ul class="site-footer-links right">
      <li><a href="https://status.github.com/">Status</a></li>
      <li><a href="http://developer.github.com">API</a></li>
      <li><a href="http://training.github.com">Training</a></li>
      <li><a href="http://shop.github.com">Shop</a></li>
      <li><a href="/blog">Blog</a></li>
      <li><a href="/about">About</a></li>

    </ul>

    <a href="/">
      <span class="mega-octicon octicon-mark-github"></span>
    </a>

    <ul class="site-footer-links">
      <li>&copy; 2013 <span title="0.03775s from fe4.rs.github.com">GitHub</span>, Inc.</li>
        <li><a href="/site/terms">Terms</a></li>
        <li><a href="/site/privacy">Privacy</a></li>
        <li><a href="/security">Security</a></li>
        <li><a href="/contact">Contact</a></li>
    </ul>
  </div><!-- /.site-footer -->
</div><!-- /.container -->


    <div class="fullscreen-overlay js-fullscreen-overlay" id="fullscreen_overlay">
  <div class="fullscreen-container js-fullscreen-container">
    <div class="textarea-wrap">
      <textarea name="fullscreen-contents" id="fullscreen-contents" class="js-fullscreen-contents" placeholder="" data-suggester="fullscreen_suggester"></textarea>
          <div class="suggester-container">
              <div class="suggester fullscreen-suggester js-navigation-container" id="fullscreen_suggester"
                 data-url="/doedje/jquery.soap/suggestions/commit">
              </div>
          </div>
    </div>
  </div>
  <div class="fullscreen-sidebar">
    <a href="#" class="exit-fullscreen js-exit-fullscreen tooltipped leftwards" title="Exit Zen Mode">
      <span class="mega-octicon octicon-screen-normal"></span>
    </a>
    <a href="#" class="theme-switcher js-theme-switcher tooltipped leftwards"
      title="Switch themes">
      <span class="octicon octicon-color-mode"></span>
    </a>
  </div>
</div>



    <div id="ajax-error-message" class="flash flash-error">
      <span class="octicon octicon-alert"></span>
      <a href="#" class="octicon octicon-remove-close close ajax-error-dismiss"></a>
      Something went wrong with that request. Please try again.
    </div>

    
  </body>
</html>

