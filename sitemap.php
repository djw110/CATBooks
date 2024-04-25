<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DW's Sitemap</title>
    <meta name="author" content="Daniel Whooley">
    <meta name="description" content="A showcase of my first website at UVM.">
    <style>
        body {
            margin: auto;
            padding: 3%;
            width: 90%;
            display: grid;
        }

        figure {
            border: thin solid darkslategray;
            border-radius: 3%;
            padding: 3%;
            text-align: center;
        }

        figcaption {
            color: #839e99;
            font-style: italic;
            text-align: center;
        }

        img {
            border-radius: 3%;
            max-width: 100%
        }

        /* Setting up a grid layout for the sitemap page */
        body>h1 {
            grid-column: 1/2;
            grid-row: 1;

        }

        body>h2 {
            grid-column: 1/2;
            grid-row: 2;

        }

        body>p {
            grid-column: 1/2;
            grid-row: 3;
        }

        figure {
            border: thin solid darkslategray;
            border-radius: 3%;
            padding: 3%;
            text-align: center;
            grid-column: 2 / 2;
            grid-row: 1 / span 3;
        }

        .header {
            grid-area: header;
            grid-column: 1 / 3;
            padding: .5%;
            margin: .5%;
        }

        .lab-layout {
            border-bottom: thin dashed navy;
            display: inline-grid;
            grid-template-columns: 25% 25% 50%;
            grid-template-areas: "header header header"
                "public-files supporting-files grader-notes";
            padding: .5%;
            margin: .5%;
            grid-column: 1 / span 2;
        }

        .public-files {
            grid-area: public-files;
            padding: .5%;
            margin: .5%;
        }

        .supporting-files {
            grid-area: supporting-files;
            padding: .5%;
            margin: .5%;
        }

        .grader-notes {
            grid-area: grader-notes;
            padding: .5%;
            margin: .5%;
        }
    </style>
</head>

<body>
    <figure>
        <img src="Images/daniel-whooley.jpg" alt="Daniel Joseph Whooley circ- 2022" >
        <figcaption>Senior Picture Day, 2022.</figcaption>
    </figure>

    <h1>CS 1080-<em>B</em> Spring 2024</h1>
    <h2>Daniel Whooley - Site map</h2>
    <p>
        <a href="ADMIN/code-viewer.php">My Admin Folder</a>
        <a href="ADMIN/table-viewer.php?getDatabase=">Table Viewer</a>
    </p>

    
    <!--     ###########################################  -->
    <section class="lab-layout">
        <h2 class="header">Final:</h2>
        <section class="public-files">
            <h3>Public Files</h3>
            <p><a href="final/index.php">Home Page</a></p>
            <p><a href="final/library.php">Library</a></p>
            <p><a href="final/detail.php">Book Detail page</a></p>
            <p><a href="final/form.php">Form page</a></p>
        </section>

        <section class="supporting-files">
            <h3>Supporting files</h3>
            <p><a href="final/css/custom.css">CSS Style Sheet</a></p>
            <p><a href="final/css/layout-desktop.css">Desktop Layout Style sheet</a></p>
            <p><a href="final/css/layout-tablet.css">Tablet Layout Style sheet</a></p>
            <p><a href="final/css/layout-iphone.css">iPhone Layout Style sheet</a></p>
            <p><a href="final/images/desktopWireframe.pdf">Site Wireframe</a></p>
            <p><a href="final/images/mobileAndTabletWireframe.pdf">Mobile & Tablet Site Wireframe</a></p>
            <h3>Includes</h3>
            <p><a href="final/top.php">top.php</a></p>
            <p><a href="final/header.php">header.php</a></p>
            <p><a href="final/nav.php">nav.php</a></p>
            <p><a href="final/footer.php">footer.php</a></p>
            <h3>Database</h3>
            <p><a href="final/sql.php">sql.php</a></p>
            <p><a href="final/database-connect.php">database-connect.php</a></p>
            <p><a href="final/images/records.png">records.png</a></p>

        </section>

        <section class="grader-notes">
            <h3>Notes to grader</h3>
            <p></p>
        </section>
    </section>
    <!--     ###########################################  -->

    <!--     ###########################################  -->
    <section class="lab-layout">
        <h2 class="header">Lab 9:</h2>
        <section class="public-files">
            <h3>Public Files</h3>
            <p><a href="lab9/index.php">Home Page</a></p>
            <p><a href="lab9/detail.php">Detail Page</a></p>
            <p><a href="lab9/about.php">About page</a></p>
            <p><a href="lab9/array.php">Array Page</a></p>
            <p><a href="lab9/form.php">Form page</a></p>
        </section>

        <section class="supporting-files">
            <h3>Supporting files</h3>
            <p><a href="lab9/css/custom.css">CSS Style Sheet</a></p>
            <p><a href="lab9/css/layout-desktop.css">Desktop Layout Style sheet</a></p>
            <p><a href="lab9/css/layout-tablet.css">Tablet Layout Style sheet</a></p>
            <p><a href="lab9/css/layout-iphone.css">iPhone Layout Style sheet</a></p>
            <p><a href="lab9/images/desktopWireframe.pdf">Site Wireframe</a></p>
            <p><a href="lab9/images/mobileAndTabletWireframe.pdf">Mobile & Tablet Site Wireframe</a></p>
            <h3>Includes</h3>
            <p><a href="lab9/top.php">top.php</a></p>
            <p><a href="lab9/header.php">header.php</a></p>
            <p><a href="lab9/nav.php">nav.php</a></p>
            <p><a href="lab9/footer.php">footer.php</a></p>
            <h3>Database</h3>
            <p><a href="lab9/sql.php">sql.php</a></p>
            <p><a href="lab9/database-connect.php.php">database-connect.php</a></p>
            <p><a href="lab9/images/records.png">records.png</a></p>

        </section>

        <section class="grader-notes">
            <h3>Notes to grader</h3>
            <p></p>
        </section>
    </section>
    <!--     ###########################################  -->


    <!--     ###########################################  -->
    <section class="lab-layout">
        <h2 class="header">Lab 8:</h2>
        <section class="public-files">
            <h3>Public Files</h3>
            <p><a href="lab8/index.php">Home Page</a></p>
            <p><a href="lab8/detail.php">Detail Page</a></p>
            <p><a href="lab8/about.php">About page</a></p>
            <p><a href="lab8/array.php">Array Page</a></p>
            <p><a href="lab8/form.php">Form page</a></p>
        </section>

        <section class="supporting-files">
            <h3>Supporting files</h3>
            <p><a href="lab8/css/custom.css">CSS Style Sheet</a></p>
            <p><a href="lab8/css/layout-desktop.css">Desktop Layout Style sheet</a></p>
            <p><a href="lab8/css/layout-tablet.css">Tablet Layout Style sheet</a></p>
            <p><a href="lab8/css/layout-iphone.css">iPhone Layout Style sheet</a></p>
            <p><a href="lab8/images/desktopWireframe.pdf">Site Wireframe</a></p>
            <p><a href="lab8/images/mobileAndTabletWireframe.pdf">Mobile & Tablet Site Wireframe</a></p>
            <h3>Includes</h3>
            <p><a href="lab8/top.php">top.php</a></p>
            <p><a href="lab8/header.php">header.php</a></p>
            <p><a href="lab8/nav.php">nav.php</a></p>
            <p><a href="lab8/footer.php">footer.php</a></p>
            <h3>Database</h3>
            <p><a href="lab8/sql.php">sql.php</a></p>
            <p><a href="lab8/database-connect.php.php">database-connect.php</a></p>
            <p><a href="lab8/images/records.png">records.png</a></p>

        </section>

        <section class="grader-notes">
            <h3>Notes to grader</h3>
            <p></p>
        </section>
    </section>
    <!--     ###########################################  -->

    <!--     ###########################################  -->
    <section class="lab-layout">
        <h2 class="header">Lab 7:</h2>
        <section class="public-files">
            <h3>Public Files</h3>
            <p><a href="lab7/index.php">Home Page</a></p>
            <p><a href="lab7/detail.php">Detail Page</a></p>
            <p><a href="lab7/about.php">About page</a></p>
            <p><a href="lab7/array.php">Array Page</a></p>
            <p><a href="lab7/form.php">Form page</a></p>
        </section>

        <section class="supporting-files">
            <h3>Supporting files</h3>
            <p><a href="lab7/css/custom.css">CSS Style Sheet</a></p>
            <p><a href="lab7/css/layout-desktop.css">Desktop Layout Style sheet</a></p>
            <p><a href="lab7/css/layout-tablet.css">Tablet Layout Style sheet</a></p>
            <p><a href="lab7/css/layout-iphone.css">iPhone Layout Style sheet</a></p>
            <p><a href="lab7/images/desktopWireframe.pdf">Site Wireframe</a></p>
            <p><a href="lab7/images/mobileAndTabletWireframe.pdf">Mobile & Tablet Site Wireframe</a></p>
            <h3>Includes</h3>
            <p><a href="lab7/top.php">top.php</a></p>
            <p><a href="lab7/header.php">header.php</a></p>
            <p><a href="lab7/nav.php">nav.php</a></p>
            <p><a href="lab7/footer.php">footer.php</a></p>
        </section>

        <section class="grader-notes">
            <h3>Notes to grader</h3>
            <p></p>
        </section>
    </section>
    <!--     ###########################################  -->

    <!--     ###########################################  -->
    <section class="lab-layout">
        <h2 class="header">Lab 6:</h2>
        <section class="public-files">
            <h3>Public Files</h3>
            <p><a href="lab6/index.php">Home Page</a></p>
            <p><a href="lab6/detail.php">Detail Page</a></p>
            <p><a href="lab6/about.php">About page</a></p>
            <p><a href="lab6/form.php">Form page</a></p>
        </section>

        <section class="supporting-files">
            <h3>Supporting files</h3>
            <p><a href="lab6/css/custom.css">CSS Style Sheet</a></p>
            <p><a href="lab6/css/layout-desktop.css">Desktop Layout Style sheet</a></p>
            <p><a href="lab6/css/layout-tablet.css">Tablet Layout Style sheet</a></p>
            <p><a href="lab6/css/layout-iphone.css">iPhone Layout Style sheet</a></p>
            <p><a href="lab6/images/desktopWireframe.pdf">Site Wireframe</a></p>
            <p><a href="lab6/images/mobileAndTabletWireframe.pdf">Mobile & Tablet Site Wireframe</a></p>
        </section>

        <section class="grader-notes">
            <h3>Notes to grader</h3>
            <p></p>
        </section>
    </section>
    <!--     ###########################################  -->


    <!--     ###########################################  -->
    <section class="lab-layout">
        <h2 class="header">Lab 5:</h2>
        <section class="public-files">
            <h3>Public Files</h3>
            <p><a href="lab5/index.php">Home Page</a></p>
            <p><a href="lab5/detail.php">Detail Page</a></p>
            <p><a href="lab5/about.php">About page</a></p>
            <p><a href="lab5/form.php">Form page</a></p>
        </section>

        <section class="supporting-files">
            <h3>Supporting files</h3>
            <p><a href="lab5/css/custom.css">CSS Style Sheet</a></p>
            <p><a href="lab5/css/layout-desktop.css">Layout Style sheet</a></p>
            <p><a href="lab5/images/wireframe.png">Site Wireframe</a></p>
            <p><a href="lab5/images/formwireframe.png">Form Wireframe</a></p>
        </section>

        <section class="grader-notes">
            <h3>Notes to grader</h3>
            <p></p>
        </section>
    </section>
    <!--     ###########################################  -->

    <!--     ###########################################  -->
    <section class="lab-layout">
        <h2 class="header">Lab 4:</h2>
        <section class="public-files">
            <h3>Public Files</h3>
            <p><a href="lab4/index.php">Home Page</a></p>
            <p><a href="lab4/detail.php">Detail Page</a></p>
            <p><a href="lab4/about.php">About page</a></p>
            <p><a href="lab4/form.php">Form page</a></p>
        </section>

        <section class="supporting-files">
            <h3>Supporting files</h3>
            <p><a href="lab4/css/custom.css">CSS Style Sheet</a></p>
            <p><a href="lab4/images/wireframe.png">Site Wireframe</a></p>
            <p><a href="lab4/images/formwireframe.png">Form Wireframe</a></p>
        </section>

        <section class="grader-notes">
            <h3>Notes to grader</h3>
            <p></p>
        </section>
    </section>
    <!--     ###########################################  -->

    <!--     ###########################################  -->
        <section class="lab-layout">
        <h2 class="header">Lab 3.5:</h2>
        <section class="public-files">
            <h3>Public Files</h3>
            <p><a href="lab3-B/index.php">Home Page</a></p>
            <p><a href="lab3-B/detail.php">Detail Page</a></p>
            <p><a href="lab3-B/about.php">About page</a></p>
            <p><a href="lab3-B/form.php">Form page</a></p>
        </section>

        <section class="supporting-files">
            <h3>Supporting files</h3>
            <p><a href="lab3-B/css/custom.css">css style sheet</a></p>
            <p><a href="lab3-B/images/wireframe.png">Site Wireframe</a></p>
            <p><a href="lab3-B/images/formwireframe.png">Form Wireframe</a></p>
        </section>

        <section class="grader-notes">
            <h3>Notes to grader</h3>
            <p></p>
        </section>
    </section>
    <!--     ###########################################  -->

    <!--     ###########################################  -->
    <section class="lab-layout">
        <h2 class="header">Lab 3:</h2>
        <section class="public-files">
            <h3>Public Files</h3>
            <p><a href="lab3/index.php">Home Page</a></p>
            <p><a href="lab3/detail.php">Detail Page</a></p>
            <p><a href="lab3/about.php">About page</a></p>
        </section>

        <section class="supporting-files">
            <h3>Supporting files</h3>
            <p><a href="lab3/css/custom.css">css style sheet</a></p>
            <p><a href="lab3/images/wireframe.png">Wireframe</a></p>
        </section>

        <section class="grader-notes">
            <h3>Notes to grader</h3>
            <p></p>
        </section>
    </section>
    <!--     ###########################################  -->

    <!--     ###########################################  -->
    <section class="lab-layout">
        <h2 class="header">Lab 2:</h2>
        <section class="public-files">
            <h3>Public Files</h3>
            <p><a href="lab2/index.php">Home Page</a></p>
        </section>

        <section class="supporting-files">
            <h3>Supporting files</h3>
            <p></p>
        </section>

        <section class="grader-notes">
            <h3>Notes to grader</h3>
            <p>Lab topic is about volunteering.</p>
            <p>Final project is about philosophy.</p>
        </section>
    </section>
    <!--     ###########################################  -->

    <!--     ###########################################  -->
    <section class="lab-layout">
        <h2 class="header">Lab 1:</h2>
        <section class="public-files">
            <h3>Public Files</h3>
            <p><a href="sitemap.php">Site map</a></p>
        </section>

        <section class="supporting-files">
            <h3>Supporting files</h3>
            <p></p>
        </section>

        <section class="grader-notes">
            <h3>Notes to grader</h3>
        </section>
    </section>
    <!--     ###########################################  -->
</body>

</html>