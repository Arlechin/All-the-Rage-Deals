# All-the-Rage-Deals
My second attempt at developing a website. Visually simple yet fully functional so far. An ongoing project.

The goal of this project is to develop a collaborative system through which we can insert, search for and evaluate deals of a wide variety of super-market products among users.

A user can inform others of the existence of well-priced products in the local area supermarkets. Later on in development there will also be a map visualization of such products in locally available stores along with related information.

The products and categories used were scraped off of [e-katanalotis](https://e-katanalotis.gov.gr/) using a web scraper made by CEID Professor Andreas Komninos [https://github.com/komis1](https://github.com/komis1/e-katanalotis-data).

So far, I have implemented the following:
    A fully functional signup/login system, both its frontend and backend.
    A visually simplistic front-end design that does not lack functionality and ease of use.
    There is also a fully functional system for managing Hierachical Data using the Nested Set Model. This is being used to store categories and subcategories not as nodes and lines but as nested containers avoiding in that way the caveats of the Adjacency List Model(orphaning an entire sub-tree when deleting nodes, full path discovery requires knowledge of the level the category resides in, etc.).
    

    
