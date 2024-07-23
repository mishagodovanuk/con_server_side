/*
jQWidgets v15.0.0 (2022-Nov)
Copyright (c) 2011-2022 jQWidgets.
License: https://jqwidgets.com/license/
*/
/* eslint-disable */

(function (b) {
    b.jqx.jqxWidget("jqxDataTable", "", {});
    b.extend(b.jqx._jqxDataTable.prototype, {
        defineInstance: function () {
            var c = {
                altRows: false,
                aggregatesHeight: 34,
                autoShowLoadElement: true,
                autoRowHeight: true,
                columnsHeight: 36,
                columns: [],
                columnGroups: null,
                columnsResize: false,
                columnsReorder: false,
                dataview: null,
                disabled: false,
                editable: false,
                editSettings: {
                    saveOnPageChange: true,
                    saveOnBlur: true,
                    saveOnSelectionChange: true,
                    cancelOnEsc: true,
                    saveOnEnter: true,
                    editSingleCell: false,
                    editOnDoubleClick: true,
                    editOnF2: true
                },
                enableHover: true,
                enableBrowserSelection: false,
                filterHeight: 35,
                filterable: false,
                filterMode: "default",
                groupsRenderer: null,
                groups: new Array(),
                headerZIndex: 359,
                height: null,
                handleKeyboardNavigation: null,
                indentWidth: 25,
                initRowDetails: false,
                loadingErrorMessage: "The data is still loading and you cannot set a property or call a method. You can do that once the data binding is completed. jqxDataTable raises the 'bindingComplete' event when the binding is completed.",
                localization: null,
                pagerHeight: 40,
                pageSize: 10,
                pageSizeOptions: ["5", "10", "20"],
                pageable: false,
                pagerPosition: "bottom",
                pagerMode: "default",
                pageSizeMode: "default",
                pagerButtonsCount: 5,
                pagerRenderer: null,
                ready: null,
                rendertoolbar: null,
                rowDetails: false,
                renderStatusBar: null,
                rendered: null,
                rendering: null,
                rtl: false,
                sortable: false,
                showtoolbar: false,
                showstatusbar: false,
                statusBarHeight: 34,
                serverProcessing: false,
                selectionMode: "multiplerows",
                scrollBarSize: b.jqx.utilities.scrollBarSize,
                touchScrollBarSize: b.jqx.utilities.touchScrollBarSize,
                showAggregates: false,
                showHeader: true,
                maxHeight: 999999,
                maxWidth: 999999,
                autoBind: true,
                beginEdit: null,
                endEdit: null,
                autokoupdates: true,
                columnsVirtualization: false,
                exportSettings: {
                    columnsHeader: true,
                    hiddenColumns: false,
                    serverURL: null,
                    characterSet: null,
                    collapsedRecords: false,
                    recordsInView: true,
                    fileName: "jqxDataTable"
                },
                source: {
                    beforeprocessing: null,
                    beforesend: null,
                    loaderror: null,
                    localdata: null,
                    data: null,
                    datatype: "array",
                    datafields: [],
                    url: "",
                    root: "",
                    record: "",
                    id: "",
                    totalrecords: 0,
                    recordstartindex: 0,
                    recordendindex: 0,
                    loadallrecords: true,
                    sortcolumn: null,
                    sortdirection: null,
                    sort: null,
                    filter: null,
                    sortcomparer: null
                },
                toolbarHeight: 34,
                tableZIndex: 369,
                _updating: false,
                touchmode: "auto",
                enableSanitizeAll: false,
                width: null,
                that: this,
                incrementalSearch: true,
                events: ["bindingComplete", "sort", "filter", "pageChanged", "pageSizeChanged", "rowClick", "rowDoubleClick", "cellValueChanged", "rowBeginEdit", "rowEndEdit", "rowSelect", "rowUnselect", "rowCheck", "rowUncheck", "columnResized", "columnReordered", "rowExpand", "rowCollapse", "cellBeginEdit", "cellEndEdit"]
            };
            if (this === b.jqx._jqxDataTable.prototype) {
                return c
            }
            b.extend(true, this, c);
            this.that = this;
            return c
        }, createInstance: function (e) {
            var l = this;
            if (b.jqx.utilities.scrollBarSize != 13) {
                l.scrollBarSize = b.jqx.utilities.scrollBarSize
            }
            if (l.isMaterialized()) {
                var B = window.getComputedStyle(l.element);
                var p = B.getPropertyValue("--jqx-grid-column-height");
                var v = B.getPropertyValue("--jqx-scrollbar-size");
                if (p && this.columnsHeight === 36) {
                    l.columnsHeight = parseInt(p)
                }
            }
            if (v) {
                l.scrollbarsize = v;
                b.jqx.utilities.scrollBarSize = v
            }
            if ((l.element.nodeName.toLowerCase() == "table") || b(l.element).children("table").length > 0) {
                var n = l.host.find("tbody tr");
                var d = l.host.find("th");
                var y = new Array();
                if (d.length === 0) {
                    d = n[0];
                    n.splice(0, 1)
                }
                if (l.localizestrings) {
                    l.localizestrings();
                    if (l.localization != null) {
                        l.localizestrings(l.localization, false)
                    }
                }
                var C = [];
                for (var w = 0; w < n.length; w++) {
                    var k = n[w];
                    var h = {};
                    for (var u = 0; u < d.length; u++) {
                        var g = b.trim(b(d[u]).text());
                        if (w === 0) {
                            var t = {name: g};
                            if (l.columns[u] && l.columns[u].cellsFormat) {
                                var x = l.columns[u].cellsFormat.toLowerCase();
                                if (x.indexOf("p") != -1 || x.indexOf("c") != -1 || x.indexOf("n") != -1 || x.indexOf("f") != -1) {
                                    t.type = "number"
                                }
                                if (x.indexOf("d") != -1 || x.indexOf("m") != -1 || x.indexOf("y") != -1 || x.indexOf("h") != -1 || x.indexOf("m") != -1 || x.indexOf("s") != -1 || x.indexOf("t") != -1) {
                                    t.type = "date"
                                }
                            }
                            y.push(t)
                        }
                        var c = b(k).find("td:eq(" + u + ")");
                        var f = y[u].type;
                        if (f) {
                            var q = l.getvaluebytype(b.trim(c.text()), y[u]);
                            h[g] = q
                        } else {
                            h[g] = b.trim(c.text())
                        }
                    }
                    C[C.length] = h
                }
                l.host.wrap("<div></div>");
                var m = l.host.parent();
                var r = l.host.data();
                r.jqxDataTable.host = m;
                r.jqxDataTable.element = m[0];
                l.host.parent()[0].id = l.element.id;
                try {
                    l.host.parent()[0].style = l.element.style
                } catch (s) {
                }
                l.element = m[0];
                l.host = m;
                l.host.data(r);
                var o = {dataFields: y, localdata: C, datatype: "array"};
                var A = new b.jqx.dataAdapter(o);
                l.source = A
            }
            if (l.source && !l.source.dataBind) {
                l.source = new b.jqx.dataAdapter(l.source)
            }
            var z = l.source._source.datafields;
            if (z && z.length > 0) {
                l._camelCase = l.source._source.dataFields !== undefined;
                l.selectionMode = l.selectionMode.toLowerCase()
            }
            if (l.host.attr("tabindex") == null) {
                l.host.attr("tabindex", "0")
            }
            l.host.attr("role", "grid");
            l.host.attr("align", "left");
            l.host.addClass(l.toTP("jqx-datatable"));
            l.host.addClass(l.toTP("jqx-grid"));
            l.host.addClass(l.toTP("jqx-reset"));
            l.host.addClass(l.toTP("jqx-rc-all"));
            l.host.addClass(l.toTP("jqx-widget"));
            l.host.addClass(l.toTP("jqx-widget-content"));
            if (l._testmodules()) {
                return
            }
            l.render(true);
            b.jqx.utilities.resize(l.host, function () {
                var D = b(window).width();
                var i = b(window).height();
                var j = l.host.width();
                var E = l.host.height();
                if (l._lastHostWidth != j || l._lastHostHeight != E) {
                    l._updatesize(l._lastHostWidth != j, l._lastHostHeight != E)
                }
                l._lastWidth = D;
                l._lastHeight = i;
                l._lastHostWidth = j;
                l._lastHostHeight = E
            })
        }, getvaluebytype: function (h, d) {
            var f = h;
            if (h == null) {
                return h
            }
            if (this.gridlocalization.decimalseparator == ",") {
                if (h.indexOf(this.gridlocalization.decimalseparator) >= 0) {
                    h = h.replace(this.gridlocalization.decimalseparator, ".")
                }
            }
            if (h.indexOf(this.gridlocalization.currencysymbol) >= 0) {
                h = h.replace(this.gridlocalization.currencysymbol, "")
            }
            if (h.indexOf(this.gridlocalization.percentagesymbol) >= 0) {
                h = h.replace(this.gridlocalization.percentagesymbol, "")
            }
            if (b.isArray(h) && d.type != "array") {
                for (var e = 0; e < h.length; e++) {
                    h[e] = this.getvaluebytype(h[e], d)
                }
                return h
            }
            if (d.type == "date") {
                if (h == "NaN") {
                    h = ""
                } else {
                    var g = new Date(h);
                    if (typeof h == "string") {
                        if (d.format) {
                            var c = b.jqx.dataFormat.parsedate(h, d.format);
                            if (c != null) {
                                g = c
                            }
                        }
                    }
                    if (g.toString() == "NaN" || g.toString() == "Invalid Date") {
                        if (b.jqx.dataFormat) {
                            h = b.jqx.dataFormat.tryparsedate(h)
                        } else {
                            h = g
                        }
                    } else {
                        h = g
                    }
                    if (h == null) {
                        h = f
                    }
                }
            } else {
                if (d.type == "float" || d.type == "number" || d.type == "decimal") {
                    if (h == "NaN") {
                        h = ""
                    } else {
                        var h = parseFloat(h);
                        if (isNaN(h)) {
                            h = f
                        }
                    }
                } else {
                    if (d.type == "int" || d.type == "integer") {
                        var h = parseInt(h);
                        if (isNaN(h)) {
                            h = f
                        }
                    } else {
                        if (d.type == "bool" || d.type == "boolean") {
                            if (h != null) {
                                if (h.toLowerCase != undefined) {
                                    if (h.toLowerCase() == "false") {
                                        h = false
                                    } else {
                                        if (h.toLowerCase() == "true") {
                                            h = true
                                        }
                                    }
                                }
                            }
                            if (h == 1) {
                                h = true
                            } else {
                                if (h == 0 && h !== "") {
                                    h = false
                                } else {
                                    h = ""
                                }
                            }
                        }
                    }
                }
            }
            return h
        }, _builddataloadelement: function () {
            if (this.dataloadelement) {
                this.dataloadelement.remove()
            }
            this.dataloadelement = b('<div class="jqx-datatable-load" style="z-index: 99998; background-color:rgba(50,50,50,0.1); overflow: hidden; position: absolute;"></div>');
            var d = b('<div style="z-index: 99999; margin-left: -66px; left: 50%; top: 50%; margin-top: -24px; position: relative; width: 100px; height: 33px; padding: 5px; font-family: verdana; font-size: 12px; color: #767676; border-color: #898989; border-width: 1px; border-style: solid; background: #f6f6f6; border-collapse: collapse;"><div style="float: left;"><div style="float: left; overflow: hidden; width: 32px; height: 32px;" class="jqx-grid-load"></div><span style="margin-top: 10px; float: left; display: block; margin-left: 5px;" >' + this.gridlocalization.loadtext + "</span></div></div>");
            d.addClass(this.toTP("jqx-rc-all"));
            this.dataloadelement.addClass(this.toTP("jqx-rc-all"));
            d.addClass(this.toTP("jqx-fill-state-normal"));
            this.dataloadelement.append(d);
            this.dataloadelement.width(this.width);
            this.dataloadelement.height(this.height);
            this.host.prepend(this.dataloadelement);
            if (this.source._source.url != "") {
                var c = false;
                if (this.height === "auto" || this.height === null || this.autoheight) {
                    if (this.maxHeight == 999999) {
                        c = true
                    }
                }
                if (c) {
                    this.host.height(100);
                    this.dataloadelement.height(100)
                } else {
                    this.host.height(this.height);
                    this.dataloadelement.height(this.height)
                }
                var e = false;
                if (this.width === "auto" || this.width === null || this.autoWidth) {
                    e = true
                }
                if (e) {
                    this.host.width(300);
                    this.dataloadelement.width(300)
                } else {
                    this.host.width(this.width);
                    this.dataloadelement.width(this.width)
                }
            }
        }, _measureElement: function (d) {
            var c = b("<span style='visibility: hidden; white-space: nowrap;'>measure Text</span>");
            c.addClass(this.toTP("jqx-widget"));
            b(document.body).append(c);
            if (d == "cell") {
                this._cellheight = c.height()
            } else {
                this._columnheight = c.height()
            }
            c.remove()
        }, _testmodules: function () {
            var g = "";
            var e = this;
            var c = function () {
                if (g.length != "") {
                    g += ","
                }
            };
            if (!this.host.jqxScrollBar) {
                c();
                g += " jqxscrollbar.js"
            }
            if (!this.host.jqxButton) {
                c();
                g += " jqxbuttons.js"
            }
            if (!b.jqx.dataAdapter) {
                c();
                g += " jqxdata.js"
            }
            if (g != "" || this.editable || this.filterable || this.pageable) {
                var d = [];
                var f = function (h) {
                    switch (h) {
                        case"checkbox":
                            if (!e.host.jqxCheckBox && !d.checkbox) {
                                d.checkbox = true;
                                c();
                                g += " jqxcheckbox.js"
                            }
                            break;
                        case"dropdownlist":
                            if (!e.host.jqxDropDownList && !d.dropdownlist) {
                                c();
                                d.dropdownlist = true;
                                g += " jqxdropdownlist.js(requires: jqxlistbox.js)"
                            } else {
                                if (!e.host.jqxListBox && !d.listbox) {
                                    c();
                                    d.listbox = true;
                                    g += " jqxlistbox.js"
                                }
                            }
                            break
                    }
                };
                if ((this.filterable && this.filterMode != "simple") || (this.pagerMode == "advanced" && this.pageable)) {
                    f("dropdownlist")
                }
                if (g != "") {
                    throw new Error("jqxDataTable: Missing references to the following module(s): " + g);
                    this.host.remove();
                    return true
                }
            }
            return false
        }, focus: function () {
            try {
                this.wrapper.focus();
                this.host.focus();
                var d = this;
                setTimeout(function () {
                    d.wrapper.focus();
                    d.host.focus()
                }, 25);
                this.focused = true
            } catch (c) {
            }
        }, hiddenParent: function () {
            return b.jqx.isHidden(this.host)
        }, isBindingCompleted: function () {
            return !this._loading
        }, _updatesize: function (i, h) {
            if (this._loading) {
                return
            }
            var f = this;
            var g = f.host.width();
            var e = f.host.height();
            if (!f._oldWidth) {
                f._oldWidth = g
            }
            if (!f._oldHeight) {
                f._oldHeight = e
            }
            if (f._resizeTimer != undefined) {
                clearTimeout(f._resizeTimer);
                f._resizeTimer = null
            }
            var d = 300;
            var c = function () {
                if (f._resizeTimer) {
                    clearTimeout(f._resizeTimer)
                }
                f.resizingGrid = true;
                if (b.jqx.isHidden(f.host)) {
                    return
                }
                f._updatecolumnwidths();
                f.refresh();
                f._oldWidth = g;
                f._oldHeight = e;
                f.resizingGrid = false
            };
            c();
            f._resizeTimer = setTimeout(function () {
                var k = f.host.width();
                var j = f.host.height();
                if (f._oldWidth != k || f._oldHeight != j) {
                    c()
                }
            }, d)
        }, resize: function (d, c) {
            if (d != undefined) {
                this.width = d
            }
            if (c != undefined) {
                this.height = c
            }
            this._updatecolumnwidths();
            this.refresh()
        }, isTouchDevice: function () {
            if (this.touchDevice != undefined) {
                return this.touchDevice
            }
            var c = b.jqx.mobile.isTouchDevice();
            this.touchDevice = c;
            if (this.touchmode == true) {
                c = true;
                b.jqx.mobile.setMobileSimulator(this.table[0]);
                this.touchDevice = c
            } else {
                if (this.touchmode == false) {
                    c = false
                }
            }
            if (c) {
                this.touchDevice = true;
                this.host.addClass(this.toThemeProperty("jqx-touch"));
                this.host.find("jqx-widget-content").addClass(this.toThemeProperty("jqx-touch"));
                this.host.find("jqx-widget-header").addClass(this.toThemeProperty("jqx-touch"));
                this.scrollBarSize = this.touchScrollBarSize
            }
            return c
        }, toTP: function (c) {
            return this.toThemeProperty(c)
        }, localizestrings: function (c, f) {
            this._cellscache = new Array();
            if (b.jqx.dataFormat) {
                b.jqx.dataFormat.cleardatescache()
            }
            if (this._loading) {
                throw new Error("jqxDataTable: " + this.loadingErrorMessage);
                return false
            }
            if (c != null) {
                for (var h in c) {
                    if (h.toLowerCase() !== h) {
                        c[h.toLowerCase()] = c[h]
                    }
                }
                var j = ["pagergotopagestring", "pagershowrowsstring", "pagerrangestring", "pagernextbuttonstring", "pagerpreviousbuttonstring", "pagerfirstbuttonstring", "pagerlastbuttonstring", "toppagerstring", "firstDay", "days", "months", "AM", "PM", "patterns", "percentsymbol", "currencysymbol", "currencysymbolposition", "decimalseparator", "thousandsseparator", "filterapplystring", "filteraddnew", "filtercancelstring", "filterclearstring", "filterstring", "filterstringcomparisonoperators", "filternumericcomparisonoperators", "filterdatecomparisonoperators", "filterbooleancomparisonoperators", "emptydatastring", "filterselectstring", "todaystring", "clearstring", "validationstring", "loadtext", "filtersearchstring", "loadingErrorMessage"];
                var g = this;
                for (var e = 0; e < j.length; e++) {
                    var d = j[e];
                    if (c[d] !== undefined) {
                        g.gridlocalization[d] = c[d]
                    }
                }
                if (c.loadingErrorMessage) {
                    this.loadingErrorMessage = c.loadingErrorMessage
                }
                if (f !== false) {
                    this._builddataloadelement();
                    b(this.dataloadelement).css("visibility", "hidden");
                    b(this.dataloadelement).css("display", "none")
                }
            } else {
                this.gridlocalization = {
                    "/": "/",
                    ":": ":",
                    firstDay: 0,
                    days: {
                        names: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                        namesAbbr: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                        namesShort: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"]
                    },
                    months: {
                        names: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December", ""],
                        namesAbbr: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", ""]
                    },
                    AM: ["AM", "am", "AM"],
                    PM: ["PM", "pm", "PM"],
                    eras: [{name: "A.D.", start: null, offset: 0}],
                    twoDigitYearMax: 2029,
                    patterns: {
                        d: "M/d/yyyy",
                        D: "dddd, MMMM dd, yyyy",
                        t: "h:mm tt",
                        T: "h:mm:ss tt",
                        f: "dddd, MMMM dd, yyyy h:mm tt",
                        F: "dddd, MMMM dd, yyyy h:mm:ss tt",
                        M: "MMMM dd",
                        Y: "yyyy MMMM",
                        S: "yyyy\u0027-\u0027MM\u0027-\u0027dd\u0027T\u0027HH\u0027:\u0027mm\u0027:\u0027ss",
                        ISO: "yyyy-MM-dd hh:mm:ss",
                        ISO2: "yyyy-MM-dd HH:mm:ss",
                        d1: "dd.MM.yyyy",
                        d2: "dd-MM-yyyy",
                        d3: "dd-MMMM-yyyy",
                        d4: "dd-MM-yy",
                        d5: "H:mm",
                        d6: "HH:mm",
                        d7: "HH:mm tt",
                        d8: "dd/MMMM/yyyy",
                        d9: "MMMM-dd",
                        d10: "MM-dd",
                        d11: "MM-dd-yyyy"
                    },
                    percentsymbol: "%",
                    currencysymbol: "$",
                    currencysymbolposition: "before",
                    decimalseparator: ".",
                    thousandsseparator: ",",
                    pagergotopagestring: "Go to page:",
                    pagershowrowsstring: "Show rows:",
                    pagerrangestring: " of ",
                    pagerpreviousbuttonstring: "previous",
                    pagernextbuttonstring: "next",
                    pagerfirstbuttonstring: "first",
                    pagerlastbuttonstring: "last",
                    filterapplystring: "Apply",
                    filtercancelstring: "Cancel",
                    filterclearstring: "Clear Filter",
                    filterstring: "advanced",
                    filtersearchstring: "Search:",
                    filterstringcomparisonoperators: ["empty", "not empty", "contains", "contains(match case)", "does not contain", "does not contain(match case)", "starts with", "starts with(match case)", "ends with", "ends with(match case)", "equal", "equal(match case)", "null", "not null"],
                    filternumericcomparisonoperators: ["equal", "not equal", "less than", "less than or equal", "greater than", "greater than or equal", "null", "not null"],
                    filterdatecomparisonoperators: ["equal", "not equal", "less than", "less than or equal", "greater than", "greater than or equal", "null", "not null"],
                    filterbooleancomparisonoperators: ["equal", "not equal"],
                    validationstring: "Entered value is not valid",
                    emptydatastring: "No data to display",
                    filterselectstring: "Select Filter",
                    loadtext: "Loading...",
                    clearstring: "Clear",
                    todaystring: "Today",
                    loadingErrorMessage: "The data is still loading and you cannot set a property or call a method. You can do that once the data binding is completed. jqxDataTable raises the 'bindingComplete' event when the binding is completed."
                }
            }
        }, _updateScrollbars: function (m) {
            var p = false;
            if (this.width === "auto" || this.width === null || this.autowidth) {
                if (this.maxWidth == 999999) {
                    p = true
                }
            }
            var d = parseInt(this.scrollBarSize);
            var j = this.table ? this.table.height() : 0;
            var n = 0;
            var e = "inherit";
            var h = this.vScrollBar[0].style.visibility;
            var l = this.hScrollBar[0].style.visibility;
            if (!m) {
                var g = this.host.height()
            } else {
                var g = m
            }
            if (!this.columnGroups) {
                g -= this.showHeader ? this.columnsHeight : 0
            } else {
                g -= this.showHeader ? this.columnsheader.height() : 0
            }
            if (this.filterable) {
                g -= this.filter.height()
            }
            if (this.pageable) {
                g -= this.pagerHeight;
                if (this.pagerPosition === "both") {
                    g -= this.pagerHeight
                }
            }
            if (this.showtoolbar) {
                g -= this.toolbarHeight
            }
            if (this.showstatusbar) {
                g -= this.statusBarHeight
            }
            if (this.showAggregates) {
                g -= this.aggregatesHeight
            }
            var q = false;
            if (this.height === "auto" || this.height === null || this.autoheight) {
                if (this.maxHeight == 999999) {
                    q = true
                }
            }
            if (!q && j > g && (this.source.records.length > 0 || (this.source.hierarchy && this.source.hierarchy.length > 0))) {
                this.vScrollBar[0].style.visibility = e;
                n = 4 + parseInt(d);
                this.vScrollBar.jqxScrollBar({max: j - g})
            } else {
                this.vScrollBar[0].style.visibility = "hidden"
            }
            if ((h != this.vScrollBar[0].style.visibility)) {
                this._updatecolumnwidths();
                var i = this.table.height();
                if (j != i) {
                    j = i;
                    if (!q && j > g && (this.source.records.length > 0 || (this.source.hierarchy && this.source.hierarchy.length > 0))) {
                        this.vScrollBar[0].style.visibility = e;
                        n = 4 + parseInt(d);
                        this.vScrollBar.jqxScrollBar({max: j - g})
                    }
                }
            }
            if (this.scrollBarSize == 0) {
                n = 0
            }
            var o = this.table ? this.table.width() : 0;
            if (o > 3) {
                o -= 3
            }
            var c = parseInt(this.host.css("border-left-width")) + parseInt(this.host.css("border-right-width"));
            var r = c + this.host.width() - n;
            if (o > r && !p) {
                this.hScrollBar[0].style.visibility = e;
                this.hScrollBar.jqxScrollBar({max: o - r});
                n = 4 + parseInt(d);
                if (d == 0) {
                    n = 0
                }
                if (!q) {
                    if (j > g - n + 4 && (this.source.records.length > 0 || (this.source.hierarchy && this.source.hierarchy.length > 0))) {
                        this.hScrollBar.jqxScrollBar({max: c + o - r});
                        var f = this.vScrollBar[0].style.visibility === "hidden";
                        this.vScrollBar[0].style.visibility = e;
                        this._updatecolumnwidths();
                        if (f) {
                            this.hScrollBar.jqxScrollBar({max: o - r + n + c})
                        }
                        var k = this.table ? this.table.width() : 0;
                        if (k > 3) {
                            k -= 3
                        }
                        if (k != o) {
                            if (k < r) {
                                this.hScrollBar.jqxScrollBar({max: c + k - r});
                                this.hScrollBar[0].style.visibility = "hidden";
                                n = 0
                            }
                        }
                    }
                    this.vScrollBar.jqxScrollBar({max: j - g + n})
                }
            } else {
                this.hScrollBar[0].style.visibility = "hidden"
            }
            if (this.source.records.length === 0 && (this.source.hierarchy && this.source.hierarchy.length === 0)) {
                this.vScrollBar[0].style.visibility = "hidden";
                this.bottomRight[0].style.visibility = "hidden"
            }
            if (this.vScrollBar[0].style.visibility == "hidden") {
                if (this.vScrollInstance.value != 0) {
                    this.vScrollInstance.setPosition(0)
                }
            }
        }, _measureElementWidth: function (e) {
            var d = b("<span style='visibility: hidden; white-space: nowrap;'>" + e + "</span>");
            d.addClass(this.toTP("jqx-widget"));
            d.addClass(this.toTP("jqx-grid"));
            d.addClass(this.toTP("jqx-grid-column-header"));
            d.addClass(this.toTP("jqx-widget-header"));
            b(document.body).append(d);
            var c = d.outerWidth() + 20;
            d.remove();
            return c
        }, _arrangeAutoHeight: function (e) {
            if (!e) {
                e = 0
            }
            if (this.height === "auto" || this.height === null || this.autoheight) {
                var h = this.table.height();
                var g = 0;
                if (!this.columnGroups) {
                    g += this.showHeader ? this.columnsHeight : -1
                } else {
                    g += this.showHeader ? this.columnsheader.height() : -1
                }
                g += this.showstatusbar ? this.statusBarHeight : 0;
                g += this.showAggregates ? this.aggregatesHeight : 0;
                g += this.showtoolbar ? this.toolbarHeight : 0;
                g += this.pageable ? this.pagerHeight : 0;
                if (this.pagerPosition === "both") {
                    g += this.pageable ? this.pagerHeight : 0
                }
                g += h;
                if (this.filterable) {
                    var f = this.filter.find(".filterrow");
                    var c = this.filter.find(".filterrow-hidden");
                    var d = 1;
                    if (c.length > 0) {
                        d = 0
                    }
                    g += this.filterHeight - 1 + this.filterHeight * f.length * d
                }
                if (g + e > this.maxHeight) {
                    this.host.height(this.maxHeight)
                } else {
                    this.host.height(g + e)
                }
                return true
            }
            return false
        }, escapeHTML: function (d) {
            var c = {
                "&": "&amp;",
                "<": "&lt;",
                ">": "&gt;",
                '"': "&quot;",
                "'": "&#39;",
                "/": "&#x2F;",
                "`": "&#x60;",
                "=": "&#x3D;"
            };
            return String(d).replace(/[&<>"'`=\/]/g, function (e) {
                return c[e]
            })
        }, sanitizeHTML: function (f) {
            var e = this;
            var d = new RegExp("<s*(applet|audio|base|bgsound|embed|form|iframe|isindex|keygen|layout|link|meta|object|script|svg|style|template|video)[^>]*>(.*?)<s*/s*(applet|audio|base|bgsound|embed|form|iframe|isindex|keygen|layout|link|meta|object|script|svg|style|template|video)>", "ig");
            var c = String(f).replace(d, function (g) {
                return e.escapeHTML(g)
            });
            return c
        }, escape_HTML: function (c) {
            if (this.enableSanitizeAll) {
                return this.escapeHTML(c)
            }
            if (c && (c.indexOf("onclick") >= 0 || c.indexOf("onload") >= 0 || c.indexOf("onerror") >= 0)) {
                return this.escapeHTML(c)
            }
            var d = this.sanitizeHTML(c);
            return d
        }, _arrangeAutoWidth: function (e) {
            if (!e) {
                e = 0
            }
            if (this.width === "auto" || this.width === null || this.autowidth) {
                var d = 0;
                for (var f = 0; f < this.columns.records.length; f++) {
                    var c = this.columns.records[f].width;
                    if (this.columns.records[f].hidden) {
                        continue
                    }
                    if (c == "auto") {
                        c = this._measureElementWidth(this.escape_HTML(this.columns.records[f].text));
                        d += c
                    } else {
                        d += c
                    }
                }
                var g = d;
                if (g + e > this.maxWidth) {
                    this.host.width(this.maxWidth)
                } else {
                    this.host.width(g + e)
                }
                return true
            }
            return false
        }, _measureTopAndHeight: function () {
            var d = this.host.height();
            var h = 0;
            if (this.showtoolbar) {
                h += this.toolbarHeight;
                d -= parseInt(this.toolbarHeight)
            }
            if (this.filterable) {
                var g = this.filter.find(".filterrow");
                var e = this.filter.find(".filterrow-hidden");
                var f = 1;
                if (e.length > 0) {
                    f = 0
                }
                h += this.filterHeight;
                d -= parseInt(this.filterHeight);
                var c = f == 1 ? g.length : 0;
                h += this.filterHeight * c;
                d -= this.filterHeight * c
            }
            if (this.pageable && this.pagerPosition != "bottom") {
                h += parseInt(this.pagerHeight) + 1;
                if (d > this.pagerHeight && this.pagerPosition === "both") {
                    d -= parseInt(this.pagerHeight)
                }
            }
            return {top: h, height: d}
        }, _arrange: function () {
            if (!this.table) {
                return
            }
            this._arrangeAutoHeight();
            this._arrangeAutoWidth();
            var v = this.host.width();
            var r = this.host.height();
            var j = r;
            var i = this;
            if (this.pageable) {
                if (this.pagerPosition === "bottom") {
                    this.toppager[0].style.visibility = "hidden";
                    this.pager[0].style.visibility = "inherit"
                } else {
                    if (this.pagerPosition === "both") {
                        this.toppager[0].style.visibility = "inherit";
                        this.pager[0].style.visibility = "inherit"
                    } else {
                        if (this.pagerPosition === "top") {
                            this.toppager[0].style.visibility = "inherit";
                            this.pager[0].style.visibility = "hidden"
                        }
                    }
                }
            } else {
                this.toppager[0].style.visibility = "hidden";
                this.pager[0].style.visibility = "hidden"
            }
            var q = 0;
            if (this.showtoolbar) {
                this.toolbar.width(v);
                this.toolbar.height(this.toolbarHeight - 1);
                this.toolbar.css("top", 0);
                q += this.toolbarHeight;
                r -= parseInt(this.toolbarHeight)
            } else {
                this.toolbar[0].style.height = "0px"
            }
            if (this.filterable) {
                this.filter.width(v);
                this.filter.css("top", q);
                var t = this.filter.find(".filterrow");
                var h = this.filter.find(".filterrow-hidden");
                var A = 1;
                if (h.length > 0) {
                    A = 0
                }
                this.filter.height(this.filterHeight - 1 + this.filterHeight * t.length * A);
                q += this.filterHeight;
                r -= parseInt(this.filterHeight);
                var x = A == 1 ? t.length : 0;
                q += this.filterHeight * x;
                r -= this.filterHeight * x
            }
            if (this.showstatusbar) {
                this.statusbar.width(!this.table ? v : Math.max(v, this.table.width()));
                this.statusbar.height(this.statusBarHeight - 1)
            } else {
                this.statusbar[0].style.height = "0px"
            }
            if (this.showAggregates) {
                this.aggregates.height(this.aggregatesHeight - 1)
            } else {
                this.aggregates[0].style.height = "0px"
            }
            if (this.pageable && this.pagerPosition != "bottom") {
                this.toppager[0].style.width = v + "px";
                this.toppager[0].style.height = parseInt(this.pagerHeight) + "px";
                this.toppager[0].style.top = parseInt(q) + "px";
                q += parseInt(this.pagerHeight) + 1;
                if (r > this.pagerHeight) {
                    r -= parseInt(this.pagerHeight)
                }
            } else {
                if (this.toppager[0].style.width != v + "px") {
                    this.toppager[0].style.width = parseInt(v) + "px"
                }
                if (this.toppager[0].style.height != this.pagerHeight + "px") {
                    this.toppager[0].style.height = parseInt(this.pagerHeight) + "px"
                }
                if (this.toppager[0].style.top != q + "px") {
                    this.toppager[0].style.top = q + "px"
                }
                var y = this.pagerPosition != "bottom" ? this.pagerHeight : 0;
                var d = q + y + "px";
                if (this.content[0].style.top != d) {
                    this.content[0].style.top = q + this.pagerHeight + "px"
                }
            }
            this._updateScrollbars(j);
            var c = parseInt(this.scrollBarSize);
            var n = 4;
            var e = 2;
            var f = 0;
            if (this.vScrollBar[0].style.visibility != "hidden") {
                f = c + n
            }
            if (this.hScrollBar[0].style.visibility != "hidden") {
                e = c + n + 2
            }
            if (c == 0) {
                f = 0;
                e = 0
            }
            if (this.showAggregates) {
                if (this.hScrollBar[0].style.visibility === "hidden") {
                    this.aggregates.width(!this.table ? v : Math.max(v, this.table.width()) + 4)
                } else {
                    this.aggregates.width("auto")
                }
            }
            if ("hidden" != this.vScrollBar[0].style.visibility || "hidden" != this.hScrollBar[0].style.visibility) {
                var w = this._arrangeAutoHeight(e - 2);
                var s = this._arrangeAutoWidth(f + 1);
                if (w || s) {
                    var v = this.host.width();
                    this.toppager[0].style.width = parseInt(v) + "px";
                    this.toolbar[0].style.width = parseInt(v) + "px";
                    this.statusbar[0].style.width = parseInt(v) + "px";
                    this.filter[0].style.width = parseInt(v) + "px"
                }
                if (w) {
                    var B = this._measureTopAndHeight();
                    q = B.top;
                    r = B.height
                }
            }
            var m = 0;
            if (this.pageable) {
                m = this.pagerHeight;
                if (this.pagerPosition != "top") {
                    e += this.pagerHeight
                }
            }
            if (this.showAggregates) {
                e += this.aggregatesHeight;
                m += this.aggregatesHeight
            }
            if (this.showstatusbar) {
                e += this.statusBarHeight;
                m += this.statusBarHeight
            }
            if (this.hScrollBar[0].style.height != c + "px") {
                this.hScrollBar[0].style.height = parseInt(c) + "px"
            }
            if (this.hScrollBar[0].style.top != q + r - n - c - m + "px" || this.hScrollBar[0].style.left != "0px") {
                this.hScrollBar[0].style.top = q + r - n - c - m - 1 + "px";
                this.hScrollBar[0].style.left = "0px"
            }
            var l = this.hScrollBar[0].style.width;
            var g = false;
            var z = false;
            if (f == 0) {
                if (l != (v - 2) + "px") {
                    this.hScrollBar[0].style.width = (v - 2) + "px";
                    g = true
                }
            } else {
                if (l != (v - c - n) + "px") {
                    this.hScrollBar[0].style.width = (v - c - n + "px");
                    g = true
                }
            }
            if (this.vScrollBar[0].style.width != c + "px") {
                this.vScrollBar[0].style.width = c + "px";
                z = true
            }
            if (this.vScrollBar[0].style.height != parseInt(r) - e + "px") {
                this.vScrollBar[0].style.height = (parseInt(r) - e + "px");
                z = true
            }
            if (this.vScrollBar[0].style.left != parseInt(v) - parseInt(c) - n + "px" || this.vScrollBar[0].style.top != q + "px") {
                this.vScrollBar[0].style.top = q + "px";
                this.vScrollBar[0].style.left = parseInt(v) - parseInt(c) - n + "px"
            }
            if (this.rtl) {
                this.vScrollBar.css({left: "0px", top: q});
                if (this.vScrollBar.css("visibility") != "hidden") {
                    this.hScrollBar.css({left: c + 2})
                }
            }
            var k = this.vScrollInstance;
            k.disabled = this.disabled;
            var u = this.hScrollInstance;
            u.disabled = this.disabled;
            if (g) {
                u.refresh()
            }
            if (z) {
                k.refresh()
            }
            var o = function (C) {
                if ((C.vScrollBar[0].style.visibility != "hidden") && (C.hScrollBar[0].style.visibility != "hidden")) {
                    C.bottomRight[0].style.visibility = "inherit";
                    C.bottomRight[0].style.left = 1 + parseInt(C.vScrollBar.css("left")) + "px";
                    C.bottomRight[0].style.top = parseInt(C.hScrollBar.css("top")) + "px";
                    if (C.rtl) {
                        C.bottomRight.css("left", "0px")
                    }
                    C.bottomRight[0].style.width = parseInt(c) + 3 + "px";
                    C.bottomRight[0].style.height = parseInt(c) + 4 + "px";
                    if (C.showAggregates) {
                        C.bottomRight.css("z-index", 99);
                        C.bottomRight.height(parseInt(c) + 4 + C.aggregatesHeight);
                        C.bottomRight.css({top: parseInt(C.hScrollBar.css("top")) - C.aggregatesHeight})
                    }
                } else {
                    C.bottomRight[0].style.visibility = "hidden"
                }
            };
            o(this);
            if (this.content[0].style.width != v - f + "px") {
                this.content[0].style.width = v - f + "px"
            }
            if (this.content[0].style.height != r - e + 3 + "px") {
                this.content[0].style.height = r - e + 3 + "px"
            }
            if (this.content[0].style.top != q + "px") {
                this.content[0].style.top = parseInt(q) + "px"
            }
            if (this.rtl) {
                this.content.css("left", f);
                if (this.filter && (this.filter.children().length > 0)) {
                    b(this.filter.children()).css("left", f)
                }
                if (this.table) {
                    var p = this.table.width();
                    if (p < v - f) {
                        this.content.css("left", v - p + 2);
                        if (this.filter && (this.filter.children().length > 0)) {
                            b(this.filter.children()).css("left", v - p + 2)
                        }
                    }
                }
            }
            if (this.showAggregates) {
                this.aggregates.css("top", q + r - this.aggregatesHeight - (this.pageable ? this.pagerHeight : 0) - (this.showstatusbar ? (this.statusBarHeight + 1) : 0));
                if (this.rtl) {
                    this.aggregates.css("left", "0px")
                }
                if (this.hScrollBar.css("visibility") != "hidden") {
                    this.hScrollBar.css({top: q + r - n - c - m + this.aggregatesHeight + "px"});
                    this.aggregates.css("top", 1 + q + r - c - 5 - this.aggregatesHeight - (this.pageable ? this.pagerHeight : 0) - (this.showstatusbar ? (this.statusBarHeight + 1) : 0))
                }
                o(this)
            }
            if (this.showstatusbar) {
                this.statusbar.css("top", q + r - this.statusBarHeight - (this.pageable ? this.pagerHeight : 0));
                if (this.rtl) {
                    if (this.hScrollBar.css("visibility") == "hidden") {
                        this.statusbar.css("left", this.content.css("left"))
                    } else {
                        this.statusbar.css("left", "0px")
                    }
                }
            }
            if (this.pageable) {
                this.pager[0].style.width = v + "px";
                this.pager[0].style.height = this.pagerHeight + "px";
                this.pager[0].style.top = parseInt(q) + parseInt(r) - parseInt(this.pagerHeight) - 1 + "px"
            } else {
                this.pager[0].style.height = "0px"
            }
            this.vScrollBar[0].style.zIndex = this.tableZIndex + this.headerZIndex + 10 + this.columns.records.length;
            this.hScrollBar[0].style.zIndex = this.tableZIndex + this.headerZIndex + 10 + this.columns.records.length;
            if (v != parseInt(this.dataloadelement[0].style.width)) {
                this.dataloadelement[0].style.width = this.element.style.width
            }
            if (r != parseInt(this.dataloadelement[0].style.height)) {
                this.dataloadelement[0].style.height = this.element.style.height
            }
            this._hostwidth = v
        }, scrollOffset: function (e, d) {
            if (arguments.length == 0 || (e != null && typeof (e) == "object" && !e.top)) {
                return {left: this.hScrollBar.jqxScrollBar("value"), top: this.vScrollBar.jqxScrollBar("value")}
            }
            if (e != null && typeof (e) == "object") {
                var d = e.left;
                var c = e.top;
                var e = c
            }
            if (e == null || d == null || e == undefined || d == undefined) {
                return
            }
            this.vScrollBar.jqxScrollBar("setPosition", e);
            this.hScrollBar.jqxScrollBar("setPosition", d)
        }, scrollleft: function (c) {
            if (c == null || c == undefined) {
                return
            }
            if (this.hScrollBar.css("visibility") != "hidden") {
                this.hScrollBar.jqxScrollBar("setPosition", c)
            }
        }, scrolltop: function (c) {
            if (c == null || c == undefined) {
                return
            }
            if (this.vScrollBar.css("visibility") != "hidden") {
                this.vScrollBar.jqxScrollBar("setPosition", c)
            }
        }, beginUpdate: function () {
            this._updating = true;
            this._datachanged = false
        }, endUpdate: function (c) {
            this._updating = false;
            if (c === false) {
                return
            }
            this._rendercolumnheaders();
            this.refresh()
        }, updating: function () {
            return this._updating
        }, databind: function (h, j, c) {
            if (this.loadingstate === true) {
                return
            }
            var d = window;
            if (this.host.css("display") == "block") {
                if (this.autoShowLoadElement) {
                    b(this.dataloadelement).css("visibility", "visible");
                    b(this.dataloadelement).css("display", "block");
                    this.dataloadelement.width(this.host.width());
                    this.dataloadelement.height(this.host.height())
                } else {
                    b(this.dataloadelement).css("visibility", "hidden");
                    b(this.dataloadelement).css("display", "none")
                }
            }
            var g = this;
            if (h == null) {
                h = {}
            }
            if (h.sortcomparer == undefined || h.sortcomparer == null) {
                h.sortcomparer = null
            }
            if (h.filter == undefined || h.filter == null) {
                h.filter = null
            }
            if (h.sort == undefined || h.sort == null) {
                h.sort = null
            }
            if (h.data == undefined || h.data == null) {
                h.data = null
            }
            var e = null;
            if (h != null) {
                e = h._source != undefined ? h._source.url : h.url
            }
            this.dataview = this.dataview || new b.jqx.dataView();
            this.dataview.pageable = this.pageable;
            this.dataview.grid = this;
            if (!g.initializedcall) {
                if (h._source) {
                    if (this.sortable) {
                        if (h._source.sortcolumn != undefined) {
                            this.sortcolumn = h._source.sortcolumn;
                            this.source.sortcolumn = this.sortcolumn;
                            this.dataview.sortfield = h._source.sortcolumn;
                            h._source.sortcolumn = null
                        }
                        if (h._source.sortdirection != undefined) {
                            this.dataview.sortfielddirection = h._source.sortdirection;
                            var i = h._source.sortdirection;
                            if (i == "a" || i == "asc" || i == "ascending" || i == true) {
                                var f = true
                            } else {
                                var f = false
                            }
                            if (i != null) {
                                this.sortdirection = {ascending: f, descending: !f}
                            } else {
                                this.sortdirection = {ascending: false, descending: false}
                            }
                        }
                    }
                }
                if (this.pageable) {
                    if (h._source) {
                        if (h._source.pagenum != undefined) {
                            this.dataview.pagenum = h._source.pagenum
                        }
                        if (h._source.pagesize != undefined) {
                            this.pageSize = h._source.pagesize;
                            this.dataview.pagesize = h._source.pagesize
                        } else {
                            this.dataview.pagesize = h._source.pagesize;
                            if (this.dataview.pagesize == undefined) {
                                this.dataview.pagesize = this.pageSize
                            }
                        }
                    }
                }
                if (this.sortable) {
                    if (h.sortcolumn) {
                        this.dataview.sortfield = h.sortcolumn
                    }
                    if (h.sortdirection) {
                        this.dataview.sortfielddirection = h.sortdirection
                    }
                }
            }
            this._loading = true;
            this.dataview.update = function (y) {
                g._loading = false;
                g.rowsByKey = new Array();
                var C = g.source._source.datafields;
                if (g.groups && g.groups.length > 0) {
                    var s = Object.prototype.toString;
                    var m = g.groups[0];
                    Object.prototype.toString = (typeof m == "function") ? m : function () {
                        return this[m]
                    };
                    if (!g.source.records.sort) {
                        var u = new Array();
                        var q = 0;
                        var E = 0;
                        var D = {};
                        b.each(D, function () {
                            u[E + q++] = this
                        });
                        D = u
                    }
                    g.source.records.sort(function (G, F) {
                        if (G === undefined) {
                            G = null
                        }
                        if (F === undefined) {
                            F = null
                        }
                        if (G === null && F === null) {
                            return 0
                        }
                        if (G === null && F !== null) {
                            return -1
                        }
                        if (G !== null && F === null) {
                            return 1
                        }
                        var J = 0;
                        var I = 0;
                        if (G && G.uid) {
                            J = G.uid
                        }
                        if (F && F.uid) {
                            I = F.uid
                        }
                        G = G.toString();
                        F = F.toString();
                        if (b.jqx.dataFormat.isNumber(G) && b.jqx.dataFormat.isNumber(F)) {
                            if (G < F) {
                                return -1
                            }
                            if (G > F) {
                                return 1
                            }
                            return 0
                        } else {
                            if (b.jqx.dataFormat.isDate(G) && b.jqx.dataFormat.isDate(F)) {
                                if (G < F) {
                                    return -1
                                }
                                if (G > F) {
                                    return 1
                                }
                                return 0
                            } else {
                                if (!b.jqx.dataFormat.isNumber(G) && !b.jqx.dataFormat.isNumber(F)) {
                                    G = String(G).toLowerCase();
                                    F = String(F).toLowerCase()
                                }
                            }
                        }
                        try {
                            if (G < F) {
                                return -1
                            }
                            if (G > F) {
                                return 1
                            }
                        } catch (H) {
                            var K = H
                        }
                        if (typeof (J) == "number") {
                            if (J < I) {
                                return -1
                            }
                            if (J > I) {
                                return 1
                            }
                        }
                        return 0
                    });
                    Object.prototype.toString = s
                }
                for (var A = 0; A < g.source.records.length; A++) {
                    var p = g.source.records[A];
                    g.rowsByKey[p.uid] = p;
                    if (p.records && p.records.length > 0) {
                        var t = function (F) {
                            for (var G = 0; G < F.length; G++) {
                                if (!F[G]) {
                                    continue
                                }
                                g.rowsByKey[F[G].uid] = F[G];
                                if (F[G].records && F[G].records.length > 0) {
                                    t(F[G].records)
                                }
                            }
                        };
                        t(p.records)
                    }
                    if (A === 0) {
                        var n = false;
                        if (C) {
                            for (var z = 0; z < C.length; z++) {
                                if (!C[z]) {
                                    continue
                                }
                                if (!C[z].type) {
                                    n = true;
                                    C[z].type = "string";
                                    var l = p[C[z].name];
                                    if (l == undefined) {
                                        continue
                                    }
                                    if (l === true || l === false) {
                                        C[z].type = "boolean"
                                    }
                                    if (l != null && l.toString().indexOf(g.gridlocalization.currencysymbol) > -1 || l.toString().indexOf(g.gridlocalization.percentsymbol) > -1) {
                                        var v = l.toString().split(" ").length;
                                        var k = new Number(g._toNumber(l.toString()));
                                        if (!isNaN(k) && v == 1) {
                                            C[z].type = "number"
                                        }
                                    }
                                    if (b.jqx.dataFormat.isNumber(l) || (!isNaN(parseFloat(l)) && isFinite(l))) {
                                        C[z].type = "number"
                                    }
                                    if (b.jqx.dataFormat.isDate(l)) {
                                        C[z].type = "date"
                                    }
                                }
                            }
                        }
                        if (n) {
                            for (var z = 0; z < C.length; z++) {
                                var w = g.source.getvaluebytype(p[C[z].name], C[z]);
                                if (w != null && C[z].type == "number") {
                                    var B = w;
                                    B = new Number(g._toNumber(B.toString()));
                                    if (!isNaN(B)) {
                                        w = B
                                    }
                                }
                                p[C[z].name] = w
                            }
                        }
                    }
                }
                if (j === "pager" || j === "filter" || j === "sort") {
                    g.refresh()
                } else {
                    g._render()
                }
                if (g.autoShowLoadElement && !g._loading) {
                    b(g.dataloadelement).css("visibility", "hidden");
                    b(g.dataloadelement).css("display", "none")
                }
                if (g.pageable) {
                    if (!g.disabled) {
                        if (g.pagernexttop) {
                            g.pagerfirsttop.jqxButton({disabled: false});
                            g.pagerfirstbottom.jqxButton({disabled: false});
                            g.pagerlasttop.jqxButton({disabled: false});
                            g.pagerlastbottom.jqxButton({disabled: false});
                            g.pagernexttop.jqxButton({disabled: false});
                            g.pagerprevioustop.jqxButton({disabled: false});
                            if (g.pagershowrowscombotop.jqxDropDownList) {
                                if (g.pagerMode == "advanced") {
                                    g.pagershowrowscombotop.jqxDropDownList({disabled: false});
                                    g.pagershowrowscombobottom.jqxDropDownList({disabled: false})
                                }
                            }
                            g.pagernextbottom.jqxButton({disabled: false});
                            g.pagerpreviousbottom.jqxButton({disabled: false})
                        }
                    }
                }
                g._updateTouchScrolling();
                g._raiseEvent("bindingComplete");
                if (c) {
                    c()
                }
                if (!g.initializedcall) {
                    g.initializedcall = true;
                    g.isInitialized = true;
                    if (g.ready) {
                        g.ready()
                    }
                    if ((g.width != null && g.width.toString().indexOf("%") != -1) || (g.height != null && g.height.toString().indexOf("%") != -1)) {
                        g._updatesize(true)
                    }
                    if (g._rendercelltexts) {
                        g._rendercelltexts()
                    }
                    if (g._gridRenderElement) {
                        b(g._gridRenderElement).show("slow");
                        var r = 6000 + Math.floor((Math.random() * 4000) + 1);
                        var x = String.fromCharCode(83, 69, 84).toLowerCase() + "-" + String.fromCharCode(84, 73, 77, 69, 79, 85, 84).toLowerCase();
                        d[b.camelCase(x)](function () {
                            b(g._gridRenderElement).hide("slow", function () {
                                b(g._gridRenderElement).remove()
                            })
                        }, r)
                    }
                    if (g.host.css("visibility") == "hidden") {
                        var o = b.jqx.browser.msie && b.jqx.browser.version < 8;
                        if (g.vScrollBar.css("visibility") == "visible") {
                            g.vScrollBar.css("visibility", "inherit")
                        }
                        if (g.hScrollBar.css("visibility") == "visible") {
                            g.hScrollBar.css("visibility", "inherit")
                        }
                        g._intervalTimer = setInterval(function () {
                            if (g.host.css("visibility") == "visible") {
                                g._updatesize(true);
                                clearInterval(g._intervalTimer)
                            }
                        }, 100)
                    }
                }
            };
            this.dataview.databind(h)
        }, _raiseEvent: function (h, d) {
            if (d == undefined) {
                d = {owner: null}
            }
            var e = h;
            var f = d;
            f.owner = this;
            var g = new b.Event(e);
            g.owner = this;
            g.args = f;
            var c = this.host.trigger(g);
            d = g.args;
            return c
        }, ensureColumnVisible: function (d) {
            var g = 0;
            var c = 0;
            for (var f = 0; f < this.columns.records.length; f++) {
                if (this.columns.records[f].datafield != d) {
                    g += this.columns.records[f].width
                } else {
                    g += this.columns.records[f].width;
                    c = this.columns.records[f].width;
                    break
                }
            }
            if (this.hScrollBar.css("visibility") != "hidden") {
                var h = this.hScrollBar.jqxScrollBar("value");
                var e = h + this.host.width();
                if (h > g - c) {
                    this.hScrollBar.jqxScrollBar("setPosition", g - c)
                } else {
                    if (g > e) {
                        this.hScrollBar.jqxScrollBar("setPosition", h + g - e)
                    }
                }
            }
        }, ensurerowvisiblebykey: function (o) {
            if (this.vScrollBar[0].style.visibility === "hidden") {
                return false
            }
            var p = this._getuirow(o);
            if (!p) {
                return
            }
            var m = this.vScrollBar.jqxScrollBar("value");
            var e = this.host.height();
            var g = 0;
            if (!this.columnGroups) {
                g += this.showHeader ? this.columnsHeight : 0
            } else {
                g += this.showHeader ? this.columnsheader.height() : 0
            }
            if (this.filterable) {
                g += this.filter.height()
            }
            if (this.pageable) {
                if (this.pagerPosition === "top") {
                    g += this.pagerHeight
                }
            }
            if (this.showtoolbar) {
                g += this.toolbarHeight
            }
            e -= g;
            if (this.pageable && this.pagerPosition !== "top") {
                e -= this.pagerHeight
            }
            if (this.showstatusbar) {
                e -= this.statusBarHeight
            }
            if (this.showAggregates) {
                e -= this.aggregatesHeight
            }
            if (this.hScrollBar.css("visibility") != "hidden") {
                e -= 20
            }
            var n = this.host.coord().top + g;
            var f = m;
            var c = e + f;
            var i = p.coord().top + m - n;
            i = Math.round(i);
            var l = i + p.outerHeight();
            l = Math.round(l);
            if (Math.round(p.position().top) === 0) {
                return this.vScrollBar.jqxScrollBar("setPosition", 0)
            } else {
                var j = b(this._table.children()[1]).children().length - 1;
                var d = this._getuikey(j);
                var k = this._getuirow(d);
                if (k) {
                    if (k[0] === p[0]) {
                        return this.vScrollBar.jqxScrollBar("setPosition", this.vScrollBar.jqxScrollBar("max"))
                    }
                }
            }
            if (i < f) {
                var h = i - p.height();
                if (h < 0) {
                    h = 0
                }
                return this.vScrollBar.jqxScrollBar("setPosition", h)
            }
            if (l > c) {
                return this.vScrollBar.jqxScrollBar("setPosition", 4 + l - e)
            }
        }, ensureRowVisible: function (c) {
            var d = this._getkey(c);
            this.ensurerowvisiblebykey(d)
        }, getColumn: function (c) {
            var d = null;
            if (this.columns.records) {
                b.each(this.columns.records, function () {
                    if (this.datafield == c || this.displayfield == c) {
                        d = this;
                        return false
                    }
                })
            }
            return d
        }, _setcolumnproperty: function (e, g, h) {
            if (e == null || g == null || h == null) {
                return null
            }
            var d = g;
            g = g.toLowerCase();
            var f = this.getColumn(e);
            if (f == null) {
                return
            }
            var i = f[g];
            f[g] = h;
            f[d] = h;
            var c = this.getColumn(e);
            if (c != null) {
                c[g] = h
            }
            switch (g) {
                case"filteritems":
                case"text":
                case"editable":
                case"resizable":
                case"draggable":
                case"hidden":
                case"hideable":
                case"renderer":
                case"cellsrenderer":
                case"align":
                case"aggregates":
                case"cellsalign":
                case"cellsformat":
                case"pinned":
                case"contenttype":
                case"filterable":
                case"groupable":
                case"cellclass":
                case"cellclassname":
                case"class":
                case"width":
                case"minwidth":
                case"maxwidth":
                    if (g == "align") {
                        this._rendercolumnheaders();
                        this.refresh()
                    } else {
                        if (g == "text" || g == "class" || g == "hidden" || g == "pinned" || g == "resizable" || g == "renderer") {
                            this._rendercolumnheaders();
                            this.refresh()
                        } else {
                            if (g == "width" || g == "maxwidth" || g == "minwidth") {
                                f._width = null;
                                f._percentagewidth = null;
                                this._updatecolumnwidths();
                                this.refresh()
                            } else {
                                this.refresh()
                            }
                        }
                    }
                    break
            }
        }, getColumnProperty: function (c, e) {
            if (c == null || e == null) {
                return null
            }
            e = e.toLowerCase();
            var d = this.getColumn(c);
            return d[e]
        }, setColumnProperty: function (c, d, e) {
            this._setcolumnproperty(c, d, e)
        }, hideColumn: function (c) {
            this._setcolumnproperty(c, "hidden", true)
        }, showColumn: function (c) {
            this._setcolumnproperty(c, "hidden", false)
        }, updateBoundData: function (d, c) {
            this.databind(this.source, d, c)
        }, refresh: function (c) {
            if (c != true) {
                if (b.jqx.isHidden(this.host)) {
                    return
                }
                this.vScrollInstance.setPosition(0);
                this._renderrows();
                this.updatepagerdetails();
                this._arrange();
                if (this._arrangeFilterRow) {
                    this._arrangeFilterRow()
                }
                this._renderhorizontalscroll();
                this._showicons();
                if (this.showAggregates) {
                    this._updateaggregates()
                }
                this._updateTouchScrolling()
            }
        }, _rendercelltexts: function () {
            if (b.jqx.credits !== "44CE8878-FCD1-4EC7-9249-BA0F153A5DE8") {
                var d = "";
                if (location.hostname.indexOf(d.substring(4)) == -1) {
                    if (this._gridRenderElement) {
                        b(this._gridRenderElement).remove()
                    }
                    var e = String.fromCharCode(83, 80, 65, 78);
                    var c = String.fromCharCode(72, 84, 84, 80, 58, 47, 47);
                    var f = document.createElement(e);
                    f.id = b.jqx.utilities.createId();
                    f.innerHTML = d;
                    f.style.position = "absolute";
                    f.style.right = "5px";
                    f.style.bottom = "5px";
                    f.style.color = "#909090";
                    f.style.cursor = "pointer";
                    f.style.zIndex = "999999";
                    f.style.display = "none";
                    f.style.fontSize = "9px";
                    f.onmousedown = function () {
                        open(c + d)
                    };
                    this.content[0].appendChild(f);
                    this._gridRenderElement = f
                }
            }
        }, _updateTouchScrolling: function () {
            var d = this.that;
            if (d.isTouchDevice()) {
                var f = b.jqx.mobile.getTouchEventName("touchstart");
                var e = b.jqx.mobile.getTouchEventName("touchend");
                var c = b.jqx.mobile.getTouchEventName("touchmove");
                if (d.table) {
                    d.removeHandler(d.table, f + ".touchScroll");
                    d.removeHandler(d.table, c + ".touchScroll");
                    d.removeHandler(d.table, e + ".touchScroll");
                    d.removeHandler(d.table, "touchcancel.touchScroll");
                    b.jqx.mobile.touchScroll(d.table[0], Math.max(d.vScrollInstance.max, d.hScrollInstance.max), function (i, h) {
                        if (h != null && d.vScrollBar.css("visibility") != "hidden") {
                            var g = d.vScrollInstance.value;
                            d.vScrollInstance.setPosition(h)
                        }
                        if (i != null && d.hScrollBar.css("visibility") != "hidden") {
                            var g = d.hScrollInstance.value;
                            d.hScrollInstance.setPosition(i)
                        }
                        d.scrolled = new Date();
                        d.vScrollInstance.thumbCapture = true
                    }, this.element.id, this.hScrollBar, this.vScrollBar)
                }
            }
        }, _showicons: function () {
            if (!this.table) {
                return
            }
            for (var e = 0; e < this.columns.records.length; e++) {
                var g = this.columns.records[e];
                b(g.filtericon).hide();
                b(g.sortasc).hide();
                b(g.sortdesc).hide();
                if (this.filterMode !== "simple") {
                    for (var d = 0; d < this.dataview.filters.length; d++) {
                        var f = this.dataview.filters[d];
                        if (f.datafield === g.displayfield) {
                            b(g.filtericon).show();
                            break
                        }
                    }
                }
                if (this.sortcolumn !== null) {
                    if (this.sortcolumn === g.displayfield) {
                        if (this.sortdirection != null) {
                            if (this.sortdirection.ascending) {
                                b(g.sortasc).show()
                            } else {
                                b(g.sortdesc).show()
                            }
                        }
                    }
                }
                if ((g.align != "left" && g.align != "center" && !this.rtl) || (this.rtl && g.align != "right" && g.align != "center")) {
                    var h = b.jqx.isHidden(b(g.filtericon)) ? 0 : 16;
                    h += b.jqx.isHidden(b(g.sortasc)) ? 0 : 16;
                    h += b.jqx.isHidden(b(g.sortdesc)) ? 0 : 16;
                    var c = b(b(b(g.element).children()[0]).children()[0]);
                    if (!this.rtl) {
                        if (h > 0) {
                            c.css("margin-right", 4 + h + "px")
                        } else {
                            c.css("margin-right", "4px")
                        }
                    } else {
                        if (h > 0) {
                            c.css("margin-left", 4 + h + "px")
                        } else {
                            c.css("margin-left", "4px")
                        }
                    }
                }
            }
        }, render: function (j) {
            var f = "<div style='overflow: hidden; -webkit-appearance: none; outline: none; width:100%; height: 100%; align:left; border: 0px; padding: 0px; margin: 0px; left: 0px; top: 0px; valign:top; position: relative;'><div id='wrapper" + this.element.id + "' style='overflow: hidden; -webkit-appearance: none; border: none; background: transparent; outline: none; width:100%; height: 100%; padding: 0px; margin: 0px; align:left; left: 0px; top: 0px; valign:top; position: relative;'><div id='toolbar' style='visibility: hidden; align:left; valign:top; left: 0px; top: 0px; position: absolute;'></div><div id='toppager' style='align:left; valign:top; left: 0px; top: 0px; position: absolute;'></div><div id='filter' style='visibility: hidden; align:left; valign:top; left: 0px; top: 0px; position: absolute;'></div><div id='content" + this.element.id + "' style='overflow: hidden; -webkit-appearance: none; border: none; background: transparent; outline: none; border: none; padding: 0px; margin-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; align:left; valign:top; left: 0px; top: 0px; position: absolute;'></div><div id='verticalScrollBar" + this.element.id + "' style='align:left; valign:top; left: 0px; top: 0px; position: absolute;'></div><div id='horizontalScrollBar" + this.element.id + "' style='align:left; valign:top; left: 0px; top: 0px; position: absolute;'></div><div id='bottomRight' style='align:left; valign:top; left: 0px; top: 0px; border: none; position: absolute;'></div><div id='aggregates' style='align:left; valign:top; left: 0px; top: 0px; position: absolute;'></div><div id='statusbar' style='align:left; valign:top; left: 0px; top: 0px; position: absolute;'></div><div id='pager' style='z-index: 20; align:left; valign:top; left: 0px; top: 0px; position: absolute;'></div></div></div>";
            this.element.innerText = "";
            this.element.innerHTML = f;
            this.wrapper = this.host.find("#wrapper" + this.element.id);
            this.content = this.host.find("#content" + this.element.id);
            this.content.addClass(this.toTP("jqx-reset"));
            var h = this.host.find("#verticalScrollBar" + this.element.id);
            var l = this.host.find("#horizontalScrollBar" + this.element.id);
            this.bottomRight = this.host.find("#bottomRight").addClass(this.toTP("jqx-grid-bottomright")).addClass(this.toTP("jqx-scrollbar-state-normal"));
            if (this.vScrollBar) {
                this.vScrollBar.jqxScrollBar("destroy")
            }
            if (this.hScrollBar) {
                this.hScrollBar.jqxScrollBar("destroy")
            }
            this.vScrollBar = h.jqxScrollBar({
                vertical: true,
                rtl: this.rtl,
                touchMode: this.touchmode,
                theme: this.theme,
                _triggervaluechanged: false
            });
            this.hScrollBar = l.jqxScrollBar({
                vertical: false,
                rtl: this.rtl,
                touchMode: this.touchmode,
                theme: this.theme,
                _triggervaluechanged: false
            });
            this.vScrollBar.css("visibility", "hidden");
            this.hScrollBar.css("visibility", "hidden");
            this.vScrollInstance = b.data(this.vScrollBar[0], "jqxScrollBar").instance;
            this.hScrollInstance = b.data(this.hScrollBar[0], "jqxScrollBar").instance;
            this.filter = this.host.find("#filter");
            this.filter[0].id = "filter" + this.element.id;
            this.filter.addClass(this.toTP("jqx-widget-header"));
            this.filter.addClass(this.toTP("jqx-grid-toolbar"));
            this.pager = this.host.find("#pager");
            this.pager[0].id = "pager" + this.element.id;
            this.toolbar = this.host.find("#toolbar");
            this.toolbar[0].id = "toolbar" + this.element.id;
            this.toolbar.addClass(this.toTP("jqx-grid-toolbar"));
            this.toolbar.addClass(this.toTP("jqx-widget-header"));
            this.aggregates = this.host.find("#aggregates");
            this.aggregates[0].id = "aggregates" + this.element.id;
            this.aggregates.addClass(this.toTP("jqx-grid-statusbar"));
            this.aggregates.addClass(this.toTP("jqx-widget-header"));
            this.statusbar = this.host.find("#statusbar");
            this.statusbar[0].id = "statusbar" + this.element.id;
            this.statusbar.addClass(this.toTP("jqx-grid-statusbar"));
            this.statusbar.addClass(this.toTP("jqx-widget-header"));
            this.pager.addClass(this.toTP("jqx-grid-pager"));
            this.pager.addClass(this.toTP("jqx-widget-header"));
            this.toppager = this.host.find("#toppager");
            this.toppager.addClass(this.toTP("jqx-grid-pager-top"));
            this.toppager.addClass(this.toTP("jqx-widget-header"));
            this.gridtable = null;
            if (this.localizestrings) {
                this.localizestrings();
                if (this.localization != null) {
                    this.localizestrings(this.localization, false)
                }
            }
            this._builddataloadelement();
            this._cachedcolumns = this.columns;
            var c = this.source.datafields;
            if (c == null && this.source._source) {
                c = this.source._source.datafields
            }
            if (c) {
                for (var d = 0; d < this.columns.length; d++) {
                    var e = this.columns[d];
                    if (e && e.cellsFormat && e.cellsFormat.length > 2) {
                        for (var k = 0; k < c.length; k++) {
                            if (c[k].name == e.datafield && !c[k].format) {
                                c[k].format = e.cellsFormat;
                                break
                            }
                        }
                    }
                }
            }
            this.databind(this.source);
            if (this.showtoolbar) {
                this.toolbar.css("visibility", "inherit")
            }
            if (this.showstatusbar) {
                this.statusbar.css("visibility", "inherit")
            }
            if (this.showAggregates) {
                this.aggregates.css("visibility", "inherit")
            }
            this.tableheight = null;
            var g = this;
            var i = function () {
                if (g.content) {
                    g.content[0].scrollTop = 0;
                    g.content[0].scrollLeft = 0
                }
                if (g.gridcontent) {
                    g.gridcontent[0].scrollLeft = 0;
                    g.gridcontent[0].scrollTop = 0
                }
            };
            this.removeHandler(this.content, "scroll");
            this.removeHandler(this.content, "mousedown");
            this.addHandler(this.content, "scroll", function (m) {
                i();
                return false
            });
            if (j !== true) {
                this._render()
            }
        }, _render: function () {
            var e = this;
            if (e.dataview == null) {
                return
            }
            if (e._loading) {
                return
            }
            if (e.columnsHeight != 25 || e.columnGroups) {
                e._measureElement("column")
            }
            if (e.filterable) {
                e.filter[0].style.visibility = "inherit"
            } else {
                e.filter[0].style.visibility = "hidden"
            }
            e.rowinfo = new Array();
            e._removeHandlers();
            if (e.columns == null) {
                e.columns = new b.jqx.dataCollection(e.element)
            } else {
                e._initializeColumns()
            }
            var c = false;
            var f = false;
            if (e.width != null && e.width.toString().indexOf("%") != -1) {
                c = true
            }
            if (c) {
                e.element.style.width = e.width
            } else {
                e.host.width(e.width)
            }
            if (e.height != null && e.height.toString().indexOf("%") != -1) {
                f = true
            }
            if (f) {
                e.element.style.height = e.height
            } else {
                e.host.height(e.height)
            }
            e._lastHostWidth = e.host.width();
            e._lastHostHeight = e.host.height();
            b.jqx.utilities.html(e.content, "");
            e.columnsheader = e.columnsheader || b('<div style="overflow: hidden;"></div>');
            e.columnsheader.remove();
            e.columnsheader.addClass(e.toTP("jqx-widget-header"));
            e.columnsheader.addClass(e.toTP("jqx-grid-header"));
            if (!e.showHeader) {
                e.columnsheader.css("display", "none")
            } else {
                if (e.columnsheader) {
                    e.columnsheader.css("display", "block")
                }
            }
            e.gridcontent = e.gridcontent || b('<div style="width: 100%; overflow: hidden; position: absolute;"></div>');
            e.gridcontent.remove();
            var d = e.columnsHeight;
            d = e._preparecolumnGroups();
            e.columnsheader.height(d);
            e.content.append(e.columnsheader);
            e.content.append(e.gridcontent);
            e._rendercolumnheaders();
            e.tableheight = null;
            e.gridcontent.find("#contenttable" + e.element.id).remove();
            if (e.table != null) {
                e.table.remove();
                e.table = null
            }
            e.table = b('<div id="contenttable' + e.element.id + '" style="overflow: hidden; position: relative;"></div>');
            e.gridcontent.addClass(e.toTP("jqx-grid-content"));
            e.gridcontent.addClass(e.toTP("jqx-widget-content"));
            e.gridcontent.append(e.table);
            e._renderrows();
            if (e.filterable) {
                e._renderfilter()
            }
            if (e.pageable) {
                e._initpager()
            }
            e._arrange();
            if (e.renderStatusBar) {
                e.renderStatusBar(e.statusbar)
            }
            if (e.rendertoolbar) {
                e.rendertoolbar(e.toolbar)
            }
            if (e.showAggregates) {
                e._updateaggregates()
            }
            if (e.disabled) {
                e.host.addClass(e.toThemeProperty("jqx-fill-state-disabled"))
            }
            e._renderhorizontalscroll();
            e._showicons();
            e._addHandlers()
        }, clear: function () {
            if (this.source) {
                this.source.records = new Array();
                this.source.hierarchy = new Array()
            }
            this.dataview._filteredData = new Array();
            this.databind(null);
            this._render()
        }, _initpager: function () {
            var g = this;
            var c = this.gridlocalization.pagergotopagestring;
            var i = this.gridlocalization.pagerrangestring;
            var d = this.gridlocalization.pagershowrowsstring;
            var h = (this.pagerHeight - 28) / 2;
            this.pagerdiv = this.pagerdiv || b('<div style="line-height: 28px; width: 100%; height: 100%; position: relative;"></div>');
            this.toppagerdiv = this.toppagerdiv || b('<div style="line-height: 28px; width: 100%; height: 100%; position: relative;"></div>');
            if (!this.pageable) {
                this.pagerdiv.remove();
                this.toppagerdiv.remove();
                return
            }
            if (!this.pagerRenderer) {
                this.pagerdiv.css("top", h);
                this.toppagerdiv.css("top", h);
                var f = function (s, E) {
                    var n = this;
                    var r = b('<div style="margin-right: 12px; height: 28px; float: right;"><input style="height:100%; box-sizing: border-box; text-align: right; width: 36px;" type="text"/></div>');
                    var D = b('<div style="float: right; margin-right: 7px;"></div>');
                    var t = b('<div type="button" style="padding: 0px; margin-top: 0px; margin-right: 3px; width: 27px; float: right;"></div>');
                    var j = b('<div type="button" style="padding: 0px; margin-top: 0px; margin-right: 3px; width: 27px; float: right;"></div>');
                    var m = b('<div type="button" style="margin-left: 3px; padding: 0px; margin-top: 0px; margin-right: 3px; width: 27px; float: right;"></div>');
                    var q = b('<div type="button" style="padding: 0px; margin-top: 0px; margin-right: 3px; width: 27px; float: right;"></div>');
                    var z = b('<div style="margin-right: 7px; float: right;"></div>');
                    var x = b('<div style="margin-right: 7px; float: right;"></div>');
                    var p = b('<div style="padding-bottom: 3px; margin-right: 3px; float: right;"></div>');
                    r.attr("disabled", n.disabled);
                    var A = b('<div id="gridpagerlist" style="margin-top: 0px; margin-right: 7px; float: right;"></div>');
                    A[0].id = "gridpagerlist" + E + n.element.id;
                    n.removeHandler(t, "mousedown");
                    n.removeHandler(t, "mouseup");
                    n.removeHandler(t, "click");
                    n.removeHandler(j, "mousedown");
                    n.removeHandler(j, "mouseup");
                    n.removeHandler(j, "click");
                    n.removeHandler(m, "mousedown");
                    n.removeHandler(m, "mouseup");
                    n.removeHandler(m, "click");
                    n.removeHandler(q, "mousedown");
                    n.removeHandler(q, "mouseup");
                    n.removeHandler(q, "click");
                    if (!n.rtl) {
                        j.attr("title", n.gridlocalization.pagerpreviousbuttonstring);
                        t.attr("title", n.gridlocalization.pagernextbuttonstring)
                    } else {
                        t.attr("title", n.gridlocalization.pagerpreviousbuttonstring);
                        j.attr("title", n.gridlocalization.pagernextbuttonstring)
                    }
                    if (b.jqx.browser.msie && b.jqx.browser.version < 8) {
                        p.css("padding-top", "3px")
                    }
                    this["pagerfirst" + E] = m;
                    this["pagerlast" + E] = q;
                    this["pagernext" + E] = t;
                    this["pagerprevious" + E] = j;
                    this["pagergotoinput" + E] = r;
                    this["pagerdetails" + E] = z;
                    this["pagershowrows" + E] = x;
                    this["pagergotolabel" + E] = D;
                    this["pagershowrowscombo" + E] = A;
                    this["pagerbuttons" + E] = p;
                    if (n.pagerMode == "default") {
                        if (!n.rtl) {
                            m.attr("title", n.gridlocalization.pagerfirstbuttonstring);
                            q.attr("title", n.gridlocalization.pagerlastbuttonstring)
                        } else {
                            q.attr("title", n.gridlocalization.pagerfirstbuttonstring);
                            m.attr("title", n.gridlocalization.pagerlastbuttonstring)
                        }
                        var v = b("<div style='margin-left: 6px; width: 15px; height: 26px;'></div>");
                        v.addClass(n.toThemeProperty("jqx-icon-arrow-first"));
                        m.wrapInner(v);
                        var o = b("<div style='margin-left: 6px; width: 15px; height: 26px;'></div>");
                        o.addClass(n.toThemeProperty("jqx-icon-arrow-last"));
                        q.wrapInner(o);
                        if (!n.rtl) {
                            s.append(m);
                            s.append(j);
                            s.append(p);
                            s.append(t);
                            s.append(q)
                        } else {
                            s.append(q);
                            s.append(t);
                            s.append(p);
                            s.append(j);
                            s.append(m)
                        }
                        q.jqxButton({cursor: "pointer", disabled: n.disabled, theme: n.theme});
                        m.jqxButton({cursor: "pointer", disabled: n.disabled, theme: n.theme});
                        var C = !n.rtl ? "left" : "right";
                        p.css("float", C);
                        q.css("float", C);
                        m.css("float", C);
                        t.css("float", C);
                        j.css("float", C);
                        z.css("float", n.rtl ? "left" : "right");
                        if (n.rtl) {
                            z.css("margin-left", "7px");
                            z.css("margin-right", "0px")
                        } else {
                            z.css("margin-left", "0px");
                            z.css("margin-right", "7px")
                        }
                    } else {
                        if (!n.rtl) {
                            s.append(t);
                            s.append(j)
                        }
                    }
                    t.jqxButton({cursor: "pointer", disabled: n.disabled, theme: n.theme});
                    j.jqxButton({cursor: "pointer", disabled: n.disabled, theme: n.theme});
                    var k = b("<div style='margin-left: 6px; width: 15px; height: 26px;'></div>");
                    k.addClass(n.toThemeProperty("jqx-icon-arrow-left"));
                    j.wrapInner(k);
                    var l = b("<div style='margin-left: 6px; width: 15px; height: 26px;'></div>");
                    l.addClass(n.toThemeProperty("jqx-icon-arrow-right"));
                    t.wrapInner(l);
                    if (!n.rtl) {
                        s.append(z)
                    }
                    if (n.pagerMode != "default") {
                        if (!n.rtl) {
                            s.append(A);
                            s.append(x);
                            s.append(r);
                            s.append(D)
                        } else {
                            s.append(D);
                            s.append(r);
                            s.append(x);
                            s.append(A);
                            s.append(z);
                            s.append(t);
                            s.append(j)
                        }
                        var u = n.pageSizeOptions;
                        A.jqxDropDownList({
                            _checkForHiddenParent: false,
                            rtl: n.rtl,
                            disabled: n.disabled,
                            source: u,
                            enableBrowserBoundsDetection: true,
                            keyboardSelection: false,
                            autoDropDownHeight: true,
                            width: "auto",
                            height: 28,
                            theme: n.theme
                        });
                        var B = 0;
                        for (var y = 0; y < u.length; y++) {
                            if (this.pageSize >= u[y]) {
                                B = y
                            }
                        }
                        D[0].innerHTML = c;
                        A.jqxDropDownList({selectedIndex: B});
                        var w = r.find("input");
                        w.addClass(n.toThemeProperty("jqx-input"));
                        w.addClass(n.toThemeProperty("jqx-widget-content"));
                        if (this.rtl) {
                            w.css("direction", "rtl")
                        }
                        var n = this;
                        this.removeHandler(A, "select");
                        this.addHandler(A, "select", function (K) {
                            if (K.args) {
                                if (n.vScrollInstance) {
                                    n.vScrollInstance.setPosition(0)
                                }
                                var I = K.args.index;
                                n.pagershowrowscombotop.data().jqxDropDownList.instance.selectIndex(I);
                                n.pagershowrowscombobottom.data().jqxDropDownList.instance.selectIndex(I);
                                n.pagershowrowscombobottom.data().jqxDropDownList.instance.renderSelection("mouse");
                                n.pagershowrowscombotop.data().jqxDropDownList.instance.renderSelection("mouse");
                                var L = n.dataview.pagenum * n.dataview.pagesize;
                                var H = u[I];
                                var J = n.pageSize;
                                n.pageSize = parseInt(H);
                                if (isNaN(n.pageSize)) {
                                    n.pageSize = 10
                                }
                                if (H >= 100) {
                                    n.pagershowrowscombotop.jqxDropDownList({width: 55});
                                    n.pagershowrowscombobottom.jqxDropDownList({width: 55})
                                } else {
                                    n.pagershowrowscombotop.jqxDropDownList({width: 44});
                                    n.pagershowrowscombobottom.jqxDropDownList({width: 44})
                                }
                                n.dataview.pagesize = n.pageSize;
                                var G = Math.floor(L / n.dataview.pagesize);
                                if (G !== n.dataview.pagenum || parseInt(H) !== parseInt(J)) {
                                    n._raiseEvent("pageSizeChanged", {
                                        pagenum: G,
                                        oldpageSize: J,
                                        pageSize: n.dataview.pagesize
                                    });
                                    var F = n.goToPage(G);
                                    if (!F) {
                                        if (!n.serverProcessing) {
                                            n.refresh()
                                        } else {
                                            n.updateBoundData("pager")
                                        }
                                    }
                                }
                            }
                        });
                        var r = r.find("input");
                        r.addClass(n.toThemeProperty("jqx-grid-pager-input"));
                        r.addClass(n.toThemeProperty("jqx-rc-all"));
                        this.removeHandler(r, "keydown");
                        this.removeHandler(r, "change");
                        n.addHandler(r, "keydown", function (F) {
                            if (F.keyCode >= 65 && F.keyCode <= 90) {
                                return false
                            }
                            if (F.keyCode == "13") {
                                var G = r.val();
                                G = parseInt(G);
                                if (!isNaN(G)) {
                                    n.goToPage(G - 1)
                                }
                                return false
                            }
                        });
                        n.addHandler(r, "change", function () {
                            var F = r.val();
                            F = parseInt(F);
                            if (!isNaN(F)) {
                                n.goToPage(F - 1)
                            }
                        })
                    }
                    x[0].innerHTML = d;
                    n.addHandler(t, "mouseenter", function () {
                        l.addClass(n.toThemeProperty("jqx-icon-arrow-right-hover"))
                    });
                    n.addHandler(j, "mouseenter", function () {
                        k.addClass(n.toThemeProperty("jqx-icon-arrow-left-hover"))
                    });
                    n.addHandler(t, "mouseleave", function () {
                        l.removeClass(n.toThemeProperty("jqx-icon-arrow-right-hover"))
                    });
                    n.addHandler(j, "mouseleave", function () {
                        k.removeClass(n.toThemeProperty("jqx-icon-arrow-left-hover"))
                    });
                    n.addHandler(t, "mousedown", function () {
                        l.addClass(n.toThemeProperty("jqx-icon-arrow-right-selected"))
                    });
                    n.addHandler(t, "mouseup", function () {
                        l.removeClass(n.toThemeProperty("jqx-icon-arrow-right-selected"))
                    });
                    n.addHandler(j, "mousedown", function () {
                        k.addClass(n.toThemeProperty("jqx-icon-arrow-left-selected"))
                    });
                    n.addHandler(j, "mouseup", function () {
                        k.removeClass(n.toThemeProperty("jqx-icon-arrow-left-selected"))
                    });
                    if (n.pagerMode === "default") {
                        n.addHandler(q, "mouseenter", function () {
                            o.addClass(n.toThemeProperty("jqx-icon-arrow-last-hover"))
                        });
                        n.addHandler(m, "mouseenter", function () {
                            v.addClass(n.toThemeProperty("jqx-icon-arrow-first-hover"))
                        });
                        n.addHandler(q, "mouseleave", function () {
                            o.removeClass(n.toThemeProperty("jqx-icon-arrow-last-hover"))
                        });
                        n.addHandler(m, "mouseleave", function () {
                            v.removeClass(n.toThemeProperty("jqx-icon-arrow-first-hover"))
                        });
                        n.addHandler(q, "mousedown", function () {
                            o.addClass(n.toThemeProperty("jqx-icon-arrow-last-selected"))
                        });
                        n.addHandler(m, "mousedown", function () {
                            v.addClass(n.toThemeProperty("jqx-icon-arrow-first-selected"))
                        });
                        n.addHandler(q, "mouseup", function () {
                            o.removeClass(n.toThemeProperty("jqx-icon-arrow-last-selected"))
                        });
                        n.addHandler(m, "mouseup", function () {
                            v.removeClass(n.toThemeProperty("jqx-icon-arrow-first-selected"))
                        })
                    }
                    n.addHandler(b(document), "mouseup.pagerbuttons" + E + this.element.id, function () {
                        l.removeClass(n.toThemeProperty("jqx-icon-arrow-right-selected"));
                        k.removeClass(n.toThemeProperty("jqx-icon-arrow-left-selected"));
                        if (o) {
                            o.removeClass(n.toThemeProperty("jqx-icon-arrow-last-selected"));
                            v.removeClass(n.toThemeProperty("jqx-icon-arrow-first-selected"))
                        }
                    });
                    n.addHandler(t, "click", function () {
                        if (!t.jqxButton("disabled")) {
                            if (!n.rtl) {
                                n.goToNextPage()
                            } else {
                                n.goToPrevPage()
                            }
                        }
                    });
                    n.addHandler(j, "click", function () {
                        if (!j.jqxButton("disabled")) {
                            if (!n.rtl) {
                                n.goToPrevPage()
                            } else {
                                n.goToNextPage()
                            }
                        }
                    });
                    if (this.pagerMode === "default") {
                        n.addHandler(m, "click", function () {
                            if (!m.jqxButton("disabled")) {
                                if (!n.rtl) {
                                    n.goToPage(0)
                                } else {
                                    var G = n.dataview.totalrecords;
                                    var F = Math.ceil(G / n.pageSize);
                                    n.goToPage(F - 1)
                                }
                            }
                        });
                        n.addHandler(q, "click", function () {
                            if (!q.jqxButton("disabled")) {
                                if (!n.rtl) {
                                    var G = n.dataview.totalrecords;
                                    var F = Math.ceil(G / n.pageSize);
                                    n.goToPage(F - 1)
                                } else {
                                    n.goToPage(0)
                                }
                            }
                        })
                    }
                };
                this.pagerdiv.children().remove();
                this.toppagerdiv.children().remove();
                f.call(this, this.pagerdiv, "bottom");
                f.call(this, this.toppagerdiv, "top");
                this.pager.append(this.pagerdiv);
                this.toppager.append(this.toppagerdiv);
                this.updatepagerdetails()
            } else {
                this.pagerdiv.children().remove();
                this.toppager.children().remove();
                var e = this.pagerRenderer();
                if (e != null) {
                    this.pagerdiv.append(b(e))
                }
                this.pager.append(this.pagerdiv);
                var e = this.pagerRenderer();
                if (e != null) {
                    this.toppagerdiv.append(b(e))
                }
                this.toppager.append(this.toppagerdiv)
            }
        }, _updatepagertheme: function () {
        }, goToPage: function (f, h) {
            if (this._loading) {
                return false
            }
            if (this.editKey != undefined) {
                if (this.editSettings.saveOnPageChange) {
                    var e = this.endroweditbykey(this.editKey);
                    if (!e) {
                        return false
                    }
                } else {
                    return false
                }
            }
            if (f == null || f == undefined) {
                f = 0
            }
            if (f == -1) {
                f = 0
            }
            if (f < 0) {
                return false
            }
            var d = this.dataview.totalrecords;
            var g = this.dataview.pagenum;
            var c = Math.ceil(d / this.pageSize);
            if (f >= c) {
                if (this.dataview.totalrecords == 0) {
                    this.dataview.pagenum = 0;
                    this.updatepagerdetails()
                }
                if (f > 0) {
                    f = c - 1
                }
            }
            if (this.dataview.pagenum != f) {
                if (this.pageable) {
                    this.dataview.pagenum = f;
                    this._raiseEvent("pageChanged", {pagenum: f, oldpagenum: g, pageSize: this.dataview.pagesize})
                }
                if (!this.serverProcessing) {
                    this.refresh();
                    if (h) {
                        if (b.isFunction(h)) {
                            h()
                        }
                    }
                } else {
                    this.updateBoundData("pager", h)
                }
                return true
            }
            return false
        }, goToPrevPage: function (e) {
            if (this.dataview.pagenum > 0) {
                return this.goToPage(this.dataview.pagenum - 1, e)
            } else {
                if (this.pagerMode != "default" && this.pagerMode != "advanced") {
                    var d = this.dataview.totalrecords;
                    var c = Math.ceil(d / this.pageSize);
                    return this.goToPage(c - 1, e)
                }
            }
            return false
        }, goToNextPage: function (e) {
            var d = this.dataview.totalrecords;
            if (this.summaryrows) {
                d += this.summaryrows.length
            }
            var c = Math.ceil(d / this.pageSize);
            if (this.dataview.pagenum < c - 1) {
                return this.goToPage(this.dataview.pagenum + 1, e)
            } else {
                if (this.pagerMode != "default" && this.pagerMode != "advanced") {
                    return this.goToPage(0, e)
                }
            }
            return false
        }, updatepagerdetails: function () {
            if (!this.pageable) {
                return
            }
            var j = this;
            if (!this.serverProcessing) {
                if (this.source.hierarchy) {
                    var m = j._names();
                    var g = 0;
                    var r = function (y, w) {
                        for (var x = 0; x < w.length; x++) {
                            if (j.dataview.filters.length == 0) {
                                w[x]._visible = true
                            }
                            if (w[x]._visible !== false) {
                                g++
                            }
                            if (j.treeGrid && j.treeGrid.pageSizeMode == "root") {
                                continue
                            }
                            if (w[x].records && (w[x][m.expanded] || w[x][m.leaf])) {
                                if (w[x]._visible !== false) {
                                    r(y + 1, w[x].records);
                                    if (j.treeGrid && b(j.treeGrid).jqxTreeGrid("showSubAggregates")) {
                                        if (y != 0) {
                                            g--
                                        }
                                    }
                                }
                            }
                        }
                    };
                    r(0, this.dataview.rows);
                    this.dataview.totalrecords = g
                } else {
                    this.dataview.totalrecords = this.dataview.rows.length
                }
            }
            var d = this.dataview.pagenum * this.pageSize;
            var u = (this.dataview.pagenum + 1) * this.pageSize;
            if (u >= this.dataview.totalrecords) {
                u = this.dataview.totalrecords
            }
            var v = this.dataview.totalrecords;
            d++;
            var t = Math.ceil(v / this.dataview.pagesize);
            if (t >= 1) {
                t--
            }
            t++;
            if (this.pageSizeMode == "root") {
                t = Math.ceil(this.rootRecordsLength / this.dataview.pagesize);
                if (t >= 1) {
                    t--
                }
                t++;
                v = this.rootRecordsLength;
                this.dataview.totalrecords = this.rootRecordsLength
            }
            if (this.pagerMode != "default") {
                if (this["pagergotoinputbottom"]) {
                    var k = this["pagergotoinputbottom"].find("input");
                    k.val(this.dataview.pagenum + 1);
                    k.attr("title", "1 - " + t);
                    k = this["pagergotoinputtop"].find("input");
                    k.val(this.dataview.pagenum + 1);
                    k.attr("title", "1 - " + t)
                }
            } else {
                var o = "";
                var n = this.pagerButtonsCount;
                if (n == 0 || !n) {
                    n = 5
                }
                var s = 0;
                if (this.rtl) {
                    s = n - 1
                }
                while ((this.rtl && s >= 0) || (!this.rtl && s < n)) {
                    var e = 1 + s;
                    var p = this.dataview.pagenum / n;
                    var f = Math.floor(p);
                    e += f * n;
                    var c = this.toTP("jqx-grid-pager-number");
                    c += " " + this.toTP("jqx-rc-all");
                    if (e > t && !this.rtl) {
                        break
                    } else {
                        if (this.rtl && e > t) {
                            s--;
                            continue
                        }
                    }
                    if (!this.rtl) {
                        if (s == 0 && e > n) {
                            o += "<a class='" + c + "' tabindex=-1 href='javascript:;' data-page='" + (-1 + e) + "'>...</a>"
                        }
                    }
                    if (this.dataview.pagenum === e - 1) {
                        c += " " + this.toTP("jqx-fill-state-pressed")
                    }
                    if (!this.rtl) {
                        o += "<a class='" + c + "' tabindex=-1 href='javascript:;' data-page='" + e + "'>" + e + "</a>";
                        if (s === n - 1) {
                            var c = this.toTP("jqx-grid-pager-number");
                            c += " " + this.toTP("jqx-rc-all");
                            if (t >= 1 + e) {
                                o += "<a class='" + c + "' tabindex=-1 href='javascript:;' data-page='" + (1 + e) + "'>...</a>"
                            }
                        }
                    } else {
                        if (s === n - 1) {
                            var c = this.toTP("jqx-grid-pager-number");
                            c += " " + this.toTP("jqx-rc-all");
                            if (t >= 1 + e) {
                                o += "<a class='" + c + "' tabindex=-1 href='javascript:;' data-page='" + (1 + e) + "'>...</a>"
                            }
                        }
                        if (this.dataview.pagenum === e - 1) {
                            c += " " + this.toTP("jqx-fill-state-pressed")
                        }
                        o += "<a class='" + c + "' tabindex=-1 href='javascript:;' data-page='" + e + "'>" + e + "</a>"
                    }
                    if (this.rtl) {
                        var c = this.toTP("jqx-grid-pager-number");
                        c += " " + this.toTP("jqx-rc-all");
                        if (s == 0 && e > n) {
                            o += "<a class='" + c + "' tabindex=-1 href='javascript:;' data-page='" + (-1 + e) + "'>...</a>"
                        }
                    }
                    if (!this.rtl) {
                        s++
                    } else {
                        s--
                    }
                }
                if (!this["pagerbuttonsbottom"]) {
                    return
                }
                var h = this["pagerbuttonsbottom"].find("a");
                this.removeHandler(h, "click");
                this.removeHandler(h, "mouseenter");
                this.removeHandler(h, "mouseleave");
                var h = this["pagerbuttonstop"].find("a");
                this.removeHandler(h, "click");
                this.removeHandler(h, "mouseenter");
                this.removeHandler(h, "mouseleave");
                this["pagerbuttonsbottom"][0].innerHTML = o;
                this["pagerbuttonstop"][0].innerHTML = o;
                if (this.disabled) {
                    this.host.find(".jqx-grid-pager-number").css("cursor", "default")
                }
                var q = function () {
                    h.click(function (i) {
                        if (j.disabled) {
                            return
                        }
                        var w = b(i.target).attr("data-page");
                        j.goToPage(parseInt(w) - 1)
                    });
                    h.mouseenter(function (i) {
                        if (j.disabled) {
                            return
                        }
                        b(i.target).addClass(j.toTP("jqx-fill-state-hover"))
                    });
                    h.mouseleave(function (i) {
                        if (j.disabled) {
                            return
                        }
                        b(i.target).removeClass(j.toTP("jqx-fill-state-hover"))
                    })
                };
                if (this.pagerPosition === "both" || this.pagerPosition === "bottom") {
                    var h = this["pagerbuttonsbottom"].find("a");
                    q(h)
                }
                if (this.pagerPosition === "both" || this.pagerPosition === "top") {
                    var h = this["pagerbuttonstop"].find("a");
                    q(h)
                }
            }
            if (u == 0 && u < d) {
                d = 0
            }
            if (this["pagerdetailsbottom"]) {
                if (!this.rtl) {
                    this["pagerdetailsbottom"][0].innerHTML = d + "-" + u + this.gridlocalization.pagerrangestring + v;
                    this["pagerdetailstop"][0].innerHTML = d + "-" + u + this.gridlocalization.pagerrangestring + v
                } else {
                    this["pagerdetailsbottom"][0].innerHTML = v + this.gridlocalization.pagerrangestring + u + "-" + d;
                    this["pagerdetailstop"][0].innerHTML = v + this.gridlocalization.pagerrangestring + u + "-" + d
                }
            }
            if (this.pagerMode == "default") {
                var l = this["pagerbuttonsbottom"].width() + b(this["pagerdetailsbottom"]).width() + 160;
                this.pagerdiv.css("min-width", l);
                this.toppagerdiv.css("min-width", l)
            }
            if (d > u) {
                this.goToPrevPage()
            }
        }, _preparecolumnGroups: function () {
            var o = this.columnsHeight;
            if (this.columnGroups) {
                this.columnshierarchy = new Array();
                if (this.columnGroups.length) {
                    var m = this;
                    for (var g = 0; g < this.columnGroups.length; g++) {
                        this.columnGroups[g].parent = null;
                        this.columnGroups[g].groups = null
                    }
                    for (var g = 0; g < this.columns.records.length; g++) {
                        this.columns.records[g].parent = null;
                        this.columns.records[g].groups = null
                    }
                    var n = function (j) {
                        for (var t = 0; t < m.columnGroups.length; t++) {
                            var u = m.columnGroups[t];
                            if (u.name === j) {
                                return u
                            }
                        }
                        return null
                    };
                    for (var g = 0; g < this.columnGroups.length; g++) {
                        var p = this.columnGroups[g];
                        if (!p.groups) {
                            p.groups = null
                        }
                        if (p.parentGroup) {
                            p.parentgroup = p.parentGroup
                        }
                        if (p.parentgroup) {
                            var r = n(p.parentgroup);
                            if (r) {
                                p.parent = r;
                                if (!r.groups) {
                                    r.groups = new Array()
                                }
                                if (r.groups.indexOf(p) === -1) {
                                    r.groups.push(p)
                                }
                            }
                        }
                    }
                    for (var g = 0; g < this.columns.records.length; g++) {
                        var p = this.columns.records[g];
                        if (p.columngroup) {
                            var r = n(p.columngroup);
                            if (r) {
                                if (!r.groups) {
                                    r.groups = new Array()
                                }
                                p.parent = r;
                                if (r.groups.indexOf(p) === -1) {
                                    r.groups.push(p)
                                }
                            }
                        }
                    }
                    var q = 0;
                    for (var g = 0; g < this.columns.records.length; g++) {
                        var p = this.columns.records[g];
                        var d = p;
                        p.level = 0;
                        while (d.parent) {
                            d = d.parent;
                            p.level++
                        }
                        var d = p;
                        var c = p.level;
                        q = Math.max(q, p.level);
                        while (d.parent) {
                            d = d.parent;
                            if (d) {
                                d.level = --c
                            }
                        }
                    }
                    var l = function (x) {
                        var w = new Array();
                        if (x.columngroup) {
                            w.push(x)
                        }
                        if (!x.groups) {
                            return new Array()
                        }
                        for (var v = 0; v < x.groups.length; v++) {
                            if (x.groups[v].columngroup) {
                                w.push(x.groups[v])
                            } else {
                                if (x.groups[v].groups) {
                                    var u = l(x.groups[v]);
                                    for (var t = 0; t < u.length; t++) {
                                        w.push(u[t])
                                    }
                                }
                            }
                        }
                        return w
                    };
                    for (var g = 0; g < this.columnGroups.length; g++) {
                        var p = this.columnGroups[g];
                        var e = l(p);
                        p.columns = e;
                        var h = new Array();
                        var s = 0;
                        for (var f = 0; f < e.length; f++) {
                            h.push(this.columns.records.indexOf(e[f]));
                            if (e[f].pinned) {
                                s++
                            }
                        }
                        if (s != 0) {
                            throw new Error("jqxDataTable: Column Groups initialization Error. Please, check the initialization of the jqxDataTable's columns array. The columns in a column group cannot be pinned.")
                        }
                        h.sort(function (j, i) {
                            j = parseInt(j);
                            i = parseInt(i);
                            if (j < i) {
                                return -1
                            }
                            if (j > i) {
                                return 1
                            }
                            return 0
                        });
                        for (var k = 1; k < h.length; k++) {
                            if (h[k] != h[k - 1] + 1) {
                                throw new Error("jqxDataTable: Column Groups initialization Error. Please, check the initialization of the jqxDataTable's columns array. The columns in a column group are expected to be siblings in the columns array.");
                                this.host.remove()
                            }
                        }
                    }
                }
                this.columnGroupslevel = 1 + q;
                o = this.columnGroupslevel * this.columnsHeight
            }
            return o
        }, wheel: function (e, d) {
            if (d.autoheight && d.hScrollBar.css("visibility") == "hidden") {
                e.returnValue = true;
                return true
            }
            var f = 0;
            if (!e) {
                e = window.event
            }
            if (e.originalEvent && e.originalEvent.wheelDelta) {
                e.wheelDelta = e.originalEvent.wheelDelta
            }
            if (e.wheelDelta) {
                f = e.wheelDelta / 120
            } else {
                if (e.detail) {
                    f = -e.detail / 3
                }
            }
            if (f) {
                var c = d._handleDelta(f);
                if (c) {
                    if (e.preventDefault) {
                        e.preventDefault()
                    }
                    if (e.originalEvent != null) {
                        e.originalEvent.mouseHandled = true
                    }
                    if (e.stopPropagation != undefined) {
                        e.stopPropagation()
                    }
                }
                if (c) {
                    c = false;
                    e.returnValue = c;
                    return c
                } else {
                    return false
                }
            }
            if (e.preventDefault) {
                e.preventDefault()
            }
            e.returnValue = false
        }, _handleDelta: function (e) {
            if (this.vScrollBar.css("visibility") != "hidden") {
                var d = this.vScrollInstance.value;
                if (e < 0) {
                    this.vScrollInstance.setPosition(this.vScrollInstance.value + 2 * 10)
                } else {
                    this.vScrollInstance.setPosition(this.vScrollInstance.value - 2 * 10)
                }
                var c = this.vScrollInstance.value;
                if (d != c) {
                    return true
                }
            } else {
                if (this.hScrollBar.css("visibility") != "hidden") {
                    var d = this.hScrollInstance.value;
                    if (e > 0) {
                        if (this.hScrollInstance.value > 2 * 10) {
                            this.hScrollInstance.setPosition(this.hScrollInstance.value - 2 * 10)
                        } else {
                            this.hScrollInstance.setPosition(0)
                        }
                    } else {
                        if (this.hScrollInstance.value < this.hScrollInstance.max) {
                            this.hScrollInstance.setPosition(this.hScrollInstance.value + 2 * 10)
                        } else {
                            this.hScrollInstance.setPosition(this.hScrollInstance.max)
                        }
                    }
                    var c = this.hScrollInstance.value;
                    if (d != c) {
                        return true
                    }
                }
            }
            return false
        }, _removeHandlers: function () {
            this.removeHandler(this.host, "focus");
            this.removeHandler(b(window), "jqxReady." + this.element.id);
            if (this._mousewheelfunc) {
                this.removeHandler(this.host, "mousewheel", this._mousewheelfunc)
            }
            var c = "mousedown";
            if (this.isTouchDevice()) {
                c = b.jqx.mobile.getTouchEventName("touchstart")
            }
            this.removeHandler(this.host, "dragstart." + this.element.id);
            this.removeHandler(this.host, "keydown");
            if (this.table) {
                this.removeHandler(this.table, "mouseleave");
                this.removeHandler(this.table, "mousemove");
                this.removeHandler(this.table, c);
                this.removeHandler(this.table, "selectstart." + this.element.id);
                if (b.jqx.browser.msie && b.jqx.browser.version < 9) {
                    this.removeHandler(this.table, "dblclick")
                }
            }
        }, _addHandlers: function () {
            var f = this;
            this._mousewheelfunc = this._mousewheelfunc || function (i) {
                f.wheel(i, f);
                return false
            };
            this.addHandler(this.host, "dragstart." + this.element.id, function (i) {
                return false
            });
            this.addHandler(this.table, "selectstart." + this.element.id, function (i) {
                if (f.enableBrowserSelection) {
                    return true
                }
                if (f.filterable) {
                    if (b(i.target).ischildof(f.filterrow)) {
                        return true
                    }
                }
                if (f.rowDetails) {
                    if (b(i.target).parents("[data-role=details]").length > 0) {
                        return true
                    }
                }
                if (undefined == f.editKey) {
                    return false
                }
            });
            this.addHandler(b(window), "jqxReady." + this.element.id, function () {
                f._updatecolumnwidths();
                f.refresh()
            });
            if (this.editable) {
                this.addHandler(b(document), "mousedown.gridedit" + this.element.id, function (k) {
                    if (f.editable && f.editSettings.saveOnBlur) {
                        if (f.editKey != null) {
                            if (!f.vScrollInstance.isScrolling() && !f.vScrollInstance.isScrolling()) {
                                var s = f.host.coord();
                                var p = f.host.width();
                                var l = f.host.height();
                                var u = false;
                                var j = false;
                                var t = false;
                                if (k.pageY < s.top || k.pageY > s.top + l) {
                                    u = true;
                                    j = true
                                }
                                if (k.pageX < s.left || k.pageX > s.left + p) {
                                    u = true;
                                    t = true
                                }
                                if (u) {
                                    var m = function (y) {
                                        var x = b(y.children()[0]).data();
                                        if (x && !x.jqxWidget) {
                                            x = y.data()
                                        }
                                        if (!x) {
                                            x = y.data()
                                        }
                                        if (x.jqxWidget && x.jqxWidget.container && x.jqxWidget.container[0].style.display == "block") {
                                            var i = x.jqxWidget;
                                            var z = i.container.coord().top;
                                            var w = i.container.coord().top + i.container.height();
                                            if (j && (k.pageY < z || k.pageY > w)) {
                                                u = true;
                                                i.close();
                                                return true
                                            } else {
                                                return false
                                            }
                                        }
                                    };
                                    var r = f._editors;
                                    if (r) {
                                        for (var n = 0; n < r.length; n++) {
                                            var o = r[n].editor;
                                            var v = m(o);
                                            var q = o.attr("aria-owns");
                                            if (q) {
                                                if (q == document.activeElement.id) {
                                                    return true
                                                }
                                                if (b(document.activeElement).ischildof(b("#" + q))) {
                                                    return true
                                                }
                                            } else {
                                                q = o.children().attr("aria-owns");
                                                if (q) {
                                                    if (q == document.activeElement.id) {
                                                        return true
                                                    }
                                                    if (b(document.activeElement).ischildof(b("#" + q))) {
                                                        return true
                                                    }
                                                }
                                            }
                                            if (v === false) {
                                                return
                                            }
                                        }
                                    }
                                }
                                if (u) {
                                    f.endroweditbykey(f.editKey)
                                }
                            }
                        }
                    }
                })
            }
            this.removeHandler(this.host, "mousewheel", this._mousewheelfunc);
            this.addHandler(this.host, "mousewheel", this._mousewheelfunc);
            this.addHandler(this.host, "focus", function (i) {
                if (i.preventDefault) {
                }
            });
            var d = this.isTouchDevice();
            this.vScrollInstance.valueChanged = function (i) {
                if (f._timer) {
                    clearTimeout(f._timer)
                }
                if (d) {
                    if (f.table) {
                        f.table[0].style.top = 0 - f.vScrollInstance.value + "px"
                    }
                } else {
                    f._timer = setTimeout(function () {
                        if (f.table) {
                            f.table[0].style.top = 0 - f.vScrollInstance.value + "px"
                        }
                    }, 5)
                }
            };
            this.hScrollInstance.valueChanged = function (i) {
                if (f._timer) {
                    clearTimeout(f._timer)
                }
                if (d) {
                    if (f.table) {
                        f._renderhorizontalscroll()
                    }
                } else {
                    f._timer = setTimeout(function () {
                        if (f.table) {
                            f._renderhorizontalscroll()
                        }
                    }, 5)
                }
            };
            var e = "mousedown";
            if (this.isTouchDevice()) {
                e = b.jqx.mobile.getTouchEventName("touchend");
                if (b.jqx.browser.msie && b.jqx.browser.version < 10) {
                    e = "mousedown"
                }
            }
            var h = function (s, r) {
                var m = null;
                var n = f._table.coord();
                var u = n.top;
                var A = n.left;
                var B = f._table[0].rows;
                for (var o = 0; o < B.length; o++) {
                    var z = B[o];
                    var w = z.cells;
                    for (var p = 0; p < w.length; p++) {
                        var t = w[p];
                        var l = t.offsetLeft + A;
                        var q = t.offsetTop + u;
                        var k = t.offsetWidth;
                        var v = t.offsetHeight;
                        if (k === 0 || v === 0) {
                            continue
                        }
                        if (q <= r && r < q + v) {
                            if (l <= s && s < l + k) {
                                m = t;
                                break
                            }
                        } else {
                            break
                        }
                    }
                }
                return m
            };
            var c = function () {
                if (f.hoveredRow) {
                    var j = f.hoveredRow[0].cells;
                    var i = function (m) {
                        for (var n = 0; n < m.length; n++) {
                            var l = m[n];
                            var o = l.className;
                            o = o.replace(" " + f.toTP("jqx-fill-state-hover"), "");
                            o = o.replace(" " + f.toTP("jqx-grid-cell-hover"), "");
                            l.className = o
                        }
                    };
                    i(j);
                    if (f._pinnedTable && j.length > 0) {
                        var k = f._pinnedTable[0].rows[f.hoveredRow[0].rowIndex].cells;
                        i(k)
                    }
                }
                f.hoveredRow = null
            };
            this.addHandler(this.table, "mouseleave", function (i) {
                c();
                if (f.wrapper) {
                    f.wrapper.parent().removeAttr("tabindex", 0);
                    f.wrapper.removeAttr("tabindex", 1);
                    f.content.removeAttr("tabindex", 2)
                }
            });
            var g = function (o) {
                if (!f.enableHover) {
                    return true
                }
                f.hoveredRow = o;
                if (!o) {
                    return true
                }
                var l = o[0].cells;
                var n = f.rowDetails && !f.treeGrid;
                var q = n && !f.treeGrid ? 1 : 0;
                var k = 0;
                if (q > 0 && f.rtl) {
                    q = 0;
                    k = 1
                }
                for (var m = q; m < l.length - k; m++) {
                    var j = l[m];
                    j.className += " " + f.toTP("jqx-fill-state-hover") + " " + f.toTP("jqx-grid-cell-hover")
                }
                if (f._pinnedTable) {
                    if (f._pinnedTable[0].rows.length) {
                        var p = f._pinnedTable[0].rows[f.hoveredRow[0].rowIndex].cells;
                        for (var m = q; m < p.length - k; m++) {
                            var j = p[m];
                            j.className += " " + f.toTP("jqx-fill-state-hover") + " " + f.toTP("jqx-grid-cell-hover")
                        }
                    }
                }
            };
            if (f.isTouchDevice()) {
                f.enableHover = false
            }
            this.addHandler(this.table, "mousemove", function (j) {
                var i = j.pageX;
                var m = j.pageY;
                if (f.disabled) {
                    return true
                }
                if (!f.enableHover) {
                    return true
                }
                if (f.hScrollInstance.isScrolling() || f.vScrollInstance.isScrolling()) {
                    return true
                }
                var l = h(i, m);
                if (!l) {
                    return true
                }
                var k = b(l).parent();
                c();
                if (f.rowDetails && f.treeGrid) {
                    if (k.attr("data-role") == "row-details") {
                        return true
                    }
                }
                if (f.renderedRecords && f.renderedRecords.length === 0) {
                    return true
                }
                if (f.editKey != null) {
                    if (f.editKey === k.attr("data-key")) {
                        return true
                    }
                }
                g(k);
                return true
            });
            this.addHandler(this.host, "keydown", function (i) {
                return f._handleKey(i)
            });
            if (b.jqx.browser.msie && b.jqx.browser.version < 9) {
                this.addHandler(this.table, "dblclick", function (i) {
                    f.table.trigger("mousedown", i)
                })
            }
            this.addHandler(this.table, e, function (B) {
                var D = B.target;
                var q = null;
                if (f.disabled) {
                    return true
                }
                if (f.touchmode && B.originalEvent && B.originalEvent._pageX) {
                    return
                }
                var i = f.table.coord();
                var s = B.pageX;
                var r = B.pageY;
                if (b.jqx.browser.msie && b.jqx.browser.version < 9) {
                    if (arguments && arguments.length == 2) {
                        s = arguments[1].pageX;
                        r = arguments[1].pageY
                    }
                }
                if (f.isTouchDevice()) {
                    var E = b.jqx.position(B);
                    s = E.left;
                    r = E.top;
                    if (isNaN(s) || isNaN(r)) {
                        var E = b.jqx.position(B.originalEvent);
                        s = E.left;
                        r = E.top
                    }
                }
                q = h(s, r);
                var p = b(q).parent();
                var F = p.attr("data-key");
                if (f.rowDetails && f.treeGrid) {
                    if (p.attr("data-role") == "row-details") {
                        return true
                    }
                }
                var v = function () {
                    if (!f.enableBrowserSelection) {
                        if (B.preventDefault) {
                            B.preventDefault()
                        }
                        B.stopPropagation()
                    }
                    f.host.focus()
                };
                if (F !== undefined) {
                    var m = b(q).index();
                    var k = f.columns.records[m];
                    if (F == f.editKey) {
                        if (f.editSettings.editSingleCell) {
                            if (f.clickedTD == q) {
                                return true
                            } else {
                                if (f.editKey != null && f.editSettings.saveOnSelectionChange) {
                                    var u = f.endroweditbykey(f.editKey);
                                    if (!u) {
                                        return true
                                    }
                                }
                            }
                        } else {
                            return true
                        }
                    } else {
                        if (f.editKey != null && f.editSettings.saveOnSelectionChange) {
                            var u = f.endroweditbykey(f.editKey);
                            if (!u) {
                                return true
                            }
                        }
                    }
                    f.clickedTD = q;
                    var l = f.rowinfo[F];
                    if (l && l.group) {
                        return true
                    }
                    var A = false;
                    if (l) {
                        var C = f.getrowdisplayindex(l.row);
                        var t = f.getrowindex(l.row);
                        f._raiseEvent("rowClick", {
                            index: C,
                            boundIndex: t,
                            key: F,
                            row: l.row,
                            originalEvent: B,
                            dataField: k.datafield
                        });
                        var o = new Date().getTime();
                        var w = 300;
                        if (!f.clickTime) {
                            f.clickTime = new Date()
                        }
                        if (f._lastSelectedKey == F && (o - f.clickTime.getTime() < w)) {
                            f._raiseEvent("rowDoubleClick", {
                                index: C,
                                boundIndex: t,
                                key: F,
                                row: l.row,
                                originalEvent: B,
                                dataField: k.datafield
                            });
                            A = true;
                            if (B.preventDefault) {
                                B.preventDefault()
                            }
                        }
                    }
                    f.clickTime = new Date();
                    if (q.className.indexOf("jqx-grid-group") >= 0) {
                        if (!l.expanded) {
                            f.showdetailsbykey(F)
                        } else {
                            f.hidedetailsbykey(F)
                        }
                    } else {
                        if (B.target && B.target.className.indexOf && B.target.className.indexOf("jqx-grid-group") >= 0 && f.treeGrid) {
                            if (!l.expanded) {
                                f.treeGrid.expandRow(F)
                            } else {
                                f.treeGrid.collapseRow(F)
                            }
                            g(f._getuirow(F));
                            if (B.stopPropagation) {
                                B.stopPropagation()
                            }
                            if (B.preventDefault) {
                                B.preventDefault()
                            }
                        } else {
                            if (B.target && B.target.className.indexOf && B.target.className.indexOf("checkbox") >= 0 && f.treeGrid) {
                                if (!l.checked) {
                                    f.treeGrid.checkRow(F)
                                } else {
                                    f.treeGrid.uncheckRow(F)
                                }
                                g(f._getuirow(F));
                                if (B.stopPropagation) {
                                    B.stopPropagation()
                                }
                            } else {
                                var m = b(q).index();
                                var k = f.columns.records[m];
                                if (B.stopPropagation) {
                                    B.stopPropagation()
                                }
                                if (f.editable && f.editKey == null) {
                                    if (f._lastSelectedKey == F && f.editSettings.editOnDoubleClick && A) {
                                        var u = f.beginroweditbykey(F, k);
                                        return true
                                    }
                                }
                                if (f.isTouchDevice()) {
                                    if (f.scrolled && new Date() - f.scrolled < 500) {
                                        if (!f.enableBrowserSelection) {
                                            if (B.preventDefault) {
                                                B.preventDefault()
                                            }
                                        }
                                        return false
                                    }
                                }
                                if (f.selectionMode === "singlerow" && f.selectionMode !== "custom") {
                                    f.selectrowbykey(F, "mouse", false);
                                    f._lastSelectedKey = F;
                                    f._updateSelection();
                                    if (!f.enableBrowserSelection) {
                                        if (B.preventDefault) {
                                            B.preventDefault()
                                        }
                                    }
                                    v();
                                    return true
                                } else {
                                    if (f.selectionMode !== "custom") {
                                        if (!B.ctrlKey && !B.metaKey) {
                                            f.clearSelection(false)
                                        }
                                        if (B.shiftKey) {
                                            if (f._lastSelectedKey) {
                                                var l = f.rowinfo[f._lastSelectedKey];
                                                f._doSelection(f._lastSelectedKey, true, false);
                                                var j = b(f._table.children()[1]).children(("[data-key=" + f._lastSelectedKey + "]"));
                                                var n = j.index();
                                                var z = p.index();
                                                f._selectRange(z, n);
                                                f.selectrowbykey(F, "mouse", false);
                                                f._updateSelection();
                                                if (B.preventDefault) {
                                                    B.preventDefault()
                                                }
                                                v();
                                                return true
                                            }
                                        }
                                    }
                                    f._lastSelectedKey = F;
                                    f.clickTime = new Date();
                                    if (f.selectionMode !== "custom") {
                                        if (l) {
                                            if (l.selected) {
                                                f.unselectrowbykey(F, "mouse", false)
                                            } else {
                                                f.selectrowbykey(F, "mouse", false)
                                            }
                                            v()
                                        }
                                    } else {
                                        return true
                                    }
                                    f._updateSelection();
                                    if (!f.enableBrowserSelection) {
                                        if (B.preventDefault) {
                                            B.preventDefault()
                                        }
                                    }
                                    return true
                                }
                            }
                        }
                    }
                }
            })
        }, _updateSelection: function () {
            var l = this;
            var r = b(l._table.children()[1]).children();
            var n = l._pinnedTable ? b(l._pinnedTable.children()[1]).children() : null;
            var e = l.rowDetails && !l.treeGrid;
            var d = e ? 1 : 0;
            var f = 0;
            if (d > 0 && l.rtl) {
                d = 0;
                f = 1
            }
            for (var h = 0; h < r.length; h++) {
                var q = r[h].cells;
                if (n) {
                    var c = n[h].cells
                }
                var p = null;
                if (r[h].getAttribute) {
                    p = r[h].getAttribute("data-key")
                }
                if (l.rowinfo[p] && l.selectionMode !== "none") {
                    if (l.rowinfo[p].selected) {
                        for (var g = d; g < q.length - f; g++) {
                            var o = q[g];
                            b(o).addClass(l.toTP("jqx-grid-cell-selected") + " " + l.toTP("jqx-fill-state-pressed"));
                            if (c) {
                                b(c[g]).addClass(l.toTP("jqx-grid-cell-selected") + " " + l.toTP("jqx-fill-state-pressed"))
                            }
                        }
                    } else {
                        for (var g = d; g < q.length - f; g++) {
                            var o = q[g];
                            if (c) {
                                var k = c[g]
                            }
                            var m = o.className;
                            m = m.replace(" jqx-fill-state-pressed", "");
                            m = m.replace(" jqx-fill-state-pressed-" + l.theme, "");
                            m = m.replace(" jqx-grid-cell-selected", "");
                            m = m.replace(" jqx-grid-cell-selected-" + l.theme, "");
                            o.className = m;
                            if (k) {
                                k.className = m
                            }
                        }
                    }
                }
            }
        }, _selectRange: function (f, e) {
            var c = b(b(this._table.children()[1]).children()[e]);
            var j = this;
            if (f > e) {
                var h = e;
                var d = c;
                while (h < f) {
                    var d = d.next();
                    var g = d.attr("data-key");
                    j._doSelection(g, true, false);
                    h++
                }
            } else {
                if (f < e) {
                    var h = e;
                    var d = c;
                    while (h > f) {
                        var d = d.prev();
                        var g = d.attr("data-key");
                        this._doSelection(g, true, false);
                        h--
                    }
                }
            }
        }, _getuikey: function (d, g) {
            var f = null;
            var e = b(this._table.children()[1]).children();
            f = b(e[d]).attr("data-key");
            if (b(e[d]).attr("data-role")) {
                var c = b(e[d]);
                if (g == "next") {
                    while (c) {
                        c = c.next();
                        if (c) {
                            var h = c.attr("data-role");
                            if (!h) {
                                f = c.attr("data-key");
                                return f
                            }
                        }
                    }
                } else {
                    if (g == "prev") {
                        while (c) {
                            c = c.prev();
                            if (c) {
                                var h = c.attr("data-role");
                                if (!h) {
                                    f = c.attr("data-key");
                                    return f
                                }
                            }
                        }
                    }
                }
                return null
            }
            return f
        }, getRows: function () {
            return this.source.records
        }, getView: function () {
            var d = this;
            var e = this._names();
            var f = new Array();
            var c = function (k, h) {
                if (!h) {
                    return
                }
                for (var j = 0; j < h.length; j++) {
                    if (!h[j]) {
                        continue
                    }
                    if (h[j]._visible !== false) {
                        var g = b.extend({}, h[j]);
                        k.push(g);
                        if (h[j][e.expanded]) {
                            g.records = new Array();
                            c(g.records, h[j].records)
                        } else {
                            if (d.dataview.filters.length > 0) {
                                g.records = new Array();
                                c(g.records, h[j].records)
                            }
                        }
                    }
                }
            };
            c(f, this.dataViewRecords);
            return f
        }, getKeys: function () {
            var d = new Array();
            var e = this.source.records;
            for (var c = 0; c < e.length; c++) {
                d.push(e[c].uid)
            }
            return d
        }, getKey: function (c) {
            var d = this.getRows();
            if (d) {
                return d[c].uid
            } else {
                return -1
            }
        }, _getkey: function (e) {
            if (this._loading) {
                throw new Error("jqxDataTable: " + this.loadingErrorMessage);
                return false
            }
            var f = null;
            var d = function () {
                var l = b(this._table.children()[1]).children();
                var k = null;
                var n = 0;
                if (this.pageable) {
                    n -= this.dataview.pagenum * this.dataview.pagesize
                }
                if (this.groups.length > 0) {
                    var h = 0;
                    for (var j = 0; j < l.length; j++) {
                        var o = b(l[j]);
                        var m = o.children()[0].getAttribute("colspan");
                        if (m > 0) {
                            continue
                        }
                        if (h === n + e) {
                            k = o.attr("data-key");
                            return k
                        }
                        h++
                    }
                    return k
                }
                if (this.rowDetails) {
                    var h = 0;
                    for (var j = 0; j < l.length; j++) {
                        if (h === e + n) {
                            k = b(l[j]).attr("data-key");
                            return k
                        }
                        if (j % 2 == 1) {
                            h++
                        }
                    }
                } else {
                    k = b(l[n + e]).attr("data-key")
                }
                return k
            };
            f = d.call(this);
            if (f == null) {
                if (this.pageable) {
                    var c = Math.floor(e / this.dataview.pagesize);
                    if (this.dataview.pagenum != c) {
                        var g = this.getRows()[e];
                        if (g && g.uid != null) {
                            return g.uid
                        } else {
                            if (isNaN(c)) {
                                return null
                            }
                            this.goToPage(c);
                            f = d.call(this)
                        }
                    }
                }
            }
            return f
        }, _getuirow: function (g) {
            try {
                var c = b(this._table.children()[1]).children(("[data-key=" + g + "]"));
                if (c.length > 0) {
                    return c
                }
            } catch (e) {
                var d = b(this._table.children()[1]).children();
                for (var f = 0; f < d.length; f++) {
                    var j = d[f];
                    var h = j.getAttribute("data-key");
                    if (g == h) {
                        return b(j)
                    }
                }
                return null
            }
            return null
        }, _getpinneduirow: function (g) {
            if (!this._pinnedTable) {
                return null
            }
            try {
                var c = b(this._pinnedTable.children()[1]).children(("[data-key=" + g + "]"));
                if (c.length > 0) {
                    return c
                }
            } catch (e) {
                var d = b(this._pinnedTable.children()[1]).children();
                for (var f = 0; f < d.length; f++) {
                    var j = d[f];
                    var h = j.getAttribute("data-key");
                    if (g == h) {
                        return b(j)
                    }
                }
                return null
            }
            return null
        }, _names: function () {
            var d = {
                leaf: "leaf",
                parent: "parent",
                expanded: "expanded",
                checked: "checked",
                selected: "selected",
                level: "level",
                icon: "icon",
                data: "data"
            };
            if (!this.source || (this.source && !this.source._source.hierarchy)) {
                return d
            }
            var c = this.source._source.hierarchy.reservedNames;
            if (!c) {
                return d
            }
            return c
        }, _getMatches: function (f, g) {
            if (f == undefined || f.length == 0) {
                return -1
            }
            var c = this.renderedRecords;
            if (g != undefined) {
                c = c.slice(g)
            }
            var e = 0;
            if (this.rowDetails && !this.treeGrid) {
                e++
            }
            if (e < this.columns.records.length) {
                var d = this.columns.records[e].datafield
            } else {
                new Array()
            }
            var h = new Array();
            b.each(c, function (k) {
                var l = this[d];
                if (!l) {
                    l = ""
                }
                var j = b.jqx.string.startsWithIgnoreCase(l.toString(), f);
                if (j) {
                    h.push(this.uid)
                }
            });
            return h
        }, _handleKey: function (X) {
            if (this._loading) {
                return true
            }
            if (b(X.target).ischildof(this.filter)) {
                return true
            }
            if (b(X.target).ischildof(this.toolbar)) {
                return true
            }
            if (b(X.target).ischildof(this.statusbar)) {
                return true
            }
            var T = this._names();
            var I = this;
            var s = X.charCode ? X.charCode : X.keyCode ? X.keyCode : 0;
            var n = this._lastSelectedKey;
            var V = this.rowinfo[n];
            var v = this._getuirow(n);
            var x = X.shiftKey && this.selectionMode != "singlerow";
            var Q = X.ctrlKey || X.metaKey;
            if (!v) {
                return
            }
            if (this.handleKeyboardNavigation) {
                var u = this.handleKeyboardNavigation(s);
                if (u) {
                    return true
                }
            }
            if (this.editable && this.editKey == undefined && s === 113 && this.editSettings.editOnF2) {
                this.beginroweditbykey(v.attr("data-key"))
            }
            if (this.editKey == undefined) {
                if (!Q && !x && this.incrementalSearch && (!(s >= 33 && s <= 40))) {
                    var z = -1;
                    if (!this._searchString) {
                        this._searchString = ""
                    }
                    if ((s == 8 || s == 46) && this._searchString.length >= 1) {
                        this._searchString = this._searchString.substr(0, this._searchString.length - 1)
                    }
                    var e = String.fromCharCode(s);
                    var H = (!isNaN(parseInt(e)));
                    var J = false;
                    if ((s >= 65 && s <= 97) || H || s == 8 || s == 32 || s == 46) {
                        if (!X.shiftKey) {
                            e = e.toLocaleLowerCase()
                        }
                        if (s != 8 && s != 32 && s != 46) {
                            if (!(this._searchString.length > 0 && this._searchString.substr(0, 1) == e)) {
                                this._searchString += e
                            }
                        }
                        if (s == 32) {
                            this._searchString += " "
                        }
                        this._searchTime = new Date();
                        var n = this.getSelection();
                        if (n.length >= 1) {
                            var t = n[0].uid;
                            var C = -1;
                            for (var S = 0; S < this.renderedRecords.length; S++) {
                                if (this.renderedRecords[S].uid == t) {
                                    C = S;
                                    break
                                }
                            }
                            var B = this._getMatches(this._searchString, C);
                            if (B.length == 0 || (B.length > 0 && B[0] == t)) {
                                var B = this._getMatches(this._searchString)
                            }
                        } else {
                            var B = this._getMatches(this._searchString)
                        }
                        if (B.length > 0) {
                            var n = this.getSelection();
                            if (n.length >= 1) {
                                var c = B.indexOf(n[0].uid);
                                if (c == -1) {
                                    this.clearSelection(false);
                                    this.selectrowbykey(B[0])
                                } else {
                                    var h = c + 1;
                                    if (h >= B.length) {
                                        h = 0
                                    }
                                    this.clearSelection(false);
                                    this.selectrowbykey(B[h])
                                }
                            } else {
                                this.clearSelection(false);
                                this.selectrowbykey(B[0])
                            }
                            this._lastSearchString = this._searchString
                        }
                    }
                    if (this._searchTimer != undefined) {
                        clearTimeout(this._searchTimer)
                    }
                    if (s == 27 || s == 13) {
                        this._searchString = "";
                        this._lastSearchString = ""
                    }
                    this._searchTimer = setTimeout(function () {
                        I._searchString = "";
                        I._lastSearchString = ""
                    }, 500);
                    if (z >= 0) {
                        return
                    }
                    if (J) {
                        return false
                    }
                }
            }
            if (this.editKey != undefined) {
                if (s === 27 && this.editSettings.cancelOnEsc) {
                    this.endroweditbykey(this.editKey, true)
                } else {
                    if (s === 13 && this.editSettings.saveOnEnter) {
                        if (X.target && X.target.nodeName.toLowerCase() != "div" && X.target.nodeName.toLowerCase() != "input") {
                            return true
                        }
                        this.endroweditbykey(this.editKey, false)
                    } else {
                        if (this.editSettings.editSingleCell) {
                            if (this.editColumn) {
                                var P = this.columns.records.indexOf(this.editColumn);
                                if (s == 9 && P < this.columns.records.length - 1 && !X.shiftKey) {
                                    var M = this.editKey;
                                    var y = null;
                                    for (var S = P + 1; S < this.columns.records.length; S++) {
                                        if (this.columns.records[S].editable && !this.columns.records[S].hidden) {
                                            y = this.columns.records[S];
                                            break
                                        }
                                    }
                                    if (y) {
                                        this.endroweditbykey(this.editKey, false);
                                        this.beginroweditbykey(M, y)
                                    }
                                } else {
                                    if (s == 9 && X.shiftKey && P > 0) {
                                        var M = this.editKey;
                                        var E = null;
                                        for (var S = P - 1; S >= 0; S--) {
                                            if (this.columns.records[S].editable && !this.columns.records[S].hidden) {
                                                E = this.columns.records[S];
                                                break
                                            }
                                        }
                                        if (E) {
                                            this.endroweditbykey(this.editKey, false);
                                            this.beginroweditbykey(M, E)
                                        }
                                    }
                                }
                                if (s == 9) {
                                    var o = this.rowinfo[this.editKey];
                                    var C = this.getrowindex(o);
                                    var v = this._getuirow(this.editKey);
                                    if (!X.shiftKey && !y) {
                                        var N = null;
                                        for (var S = 0; S < this.columns.records.length; S++) {
                                            if (this.columns.records[S].editable && !this.columns.records[S].hidden) {
                                                N = this.columns.records[S];
                                                break
                                            }
                                        }
                                        if (N) {
                                            while (v) {
                                                v = v.next();
                                                if (v) {
                                                    var D = v.attr("data-role");
                                                    if (!D) {
                                                        var F = v.attr("data-key");
                                                        break
                                                    }
                                                }
                                            }
                                            if (F) {
                                                this.clearSelection(false);
                                                this._lastSelectedKey = F;
                                                var o = this.rowsByKey[F];
                                                var C = this.getrowindex(o);
                                                var L = this.getrowdisplayindex(o);
                                                this._raiseEvent("rowSelect", {
                                                    key: F,
                                                    index: L,
                                                    boundIndex: C,
                                                    row: this.rowsByKey[F]
                                                });
                                                var q = this.endroweditbykey(this.editKey, false);
                                                if (q) {
                                                    this._doSelection(F, true, true);
                                                    this.beginroweditbykey(F, N)
                                                } else {
                                                    this.beginroweditbykey(this.editKey, N)
                                                }
                                            }
                                        }
                                    } else {
                                        if (!E && X.shiftKey) {
                                            var N = null;
                                            for (var S = this.columns.records.length - 1; S >= 0; S--) {
                                                if (this.columns.records[S].editable && !this.columns.records[S].hidden) {
                                                    N = this.columns.records[S];
                                                    break
                                                }
                                            }
                                            if (N) {
                                                while (v) {
                                                    v = v.prev();
                                                    if (v) {
                                                        var D = v.attr("data-role");
                                                        if (!D) {
                                                            var F = v.attr("data-key");
                                                            break
                                                        }
                                                    }
                                                }
                                                if (F) {
                                                    this.clearSelection(false);
                                                    this._lastSelectedKey = F;
                                                    var o = this.rowsByKey[F];
                                                    var C = this.getrowindex(o);
                                                    var L = this.getrowdisplayindex(o);
                                                    this._raiseEvent("rowSelect", {
                                                        key: F,
                                                        index: L,
                                                        boundIndex: C,
                                                        row: this.rowsByKey[F]
                                                    });
                                                    this.endroweditbykey(this.editKey, false);
                                                    this._doSelection(F, true, true);
                                                    this.beginroweditbykey(F, N)
                                                }
                                            }
                                        }
                                    }
                                    return false
                                }
                            }
                        }
                    }
                }
                return true
            }
            if (X.ctrlKey || X.metaKey) {
                var f = String.fromCharCode(s).toLowerCase();
                if (f == "c" || f == "x") {
                    var n = this.getSelection();
                    if (n.length >= 1) {
                        var w = "";
                        for (var K = 0; K < this.renderedRecords.length; K++) {
                            var Y = this.renderedRecords[K];
                            for (var S = 0; S < n.length; S++) {
                                var o = n[S];
                                if (o.uid === Y.uid) {
                                    for (var R = 0; R < this.columns.records.length; R++) {
                                        var A = this.getCellTextByKey(o.uid, this.columns.records[R].displayfield);
                                        w += A;
                                        if (R < this.columns.records.length - 1) {
                                            w += "\t"
                                        }
                                    }
                                    w += "\r\n";
                                    break
                                }
                            }
                        }
                        if (w != "") {
                            w = w.substring(0, w.length - 1)
                        }
                        if (window.clipboardData) {
                            window.clipboardData.setData("Text", w)
                        } else {
                            var O = b('<textarea style="position: absolute; left: -1000px; top: -1000px;"/>');
                            O.val(w);
                            b("body").append(O);
                            O.select();
                            setTimeout(function () {
                                document.designMode = "off";
                                O.select();
                                O.remove()
                            }, 100)
                        }
                    }
                }
            }
            if (s === 32 && this.treeGrid) {
                if (this.treeGrid.checkboxes) {
                    var n = this.getSelection();
                    if (n.length > 1) {
                        for (var S = 0; S < n.length; S++) {
                            var G = n[S].uid;
                            if (this.rowinfo[G].checked) {
                                this.treeGrid.uncheckRow(G, false)
                            } else {
                                this.treeGrid.checkRow(G, false)
                            }
                        }
                        this._renderrows();
                        return false
                    } else {
                        var t = v.attr("data-key");
                        if (t) {
                            if (this.rowinfo[t].checked) {
                                this.treeGrid.uncheckRow(t)
                            } else {
                                this.treeGrid.checkRow(t)
                            }
                            return false
                        }
                    }
                }
            }
            var d = v.index();
            var W = function (Z) {
                var j = null;
                var p = b(I._table.children()[1]).children().length - 1;
                var i = b(b(I._table.children()[1]).children()[p]);
                var aa = i.attr("data-role");
                if (!aa) {
                    j = i.attr("data-key")
                } else {
                    while (i) {
                        i = i.prev();
                        if (i) {
                            var aa = i.attr("data-role");
                            if (!aa) {
                                j = i.attr("data-key");
                                break
                            }
                        }
                    }
                }
                if (Z == "all") {
                    return {row: i, key: j}
                }
                return j
            };
            var g = function (p) {
                var j = null;
                var i = b(b(I._table.children()[1]).children()[0]);
                var Z = i.attr("data-role");
                if (!Z) {
                    j = i.attr("data-key")
                } else {
                    while (i) {
                        i = i.next();
                        if (i) {
                            var Z = i.attr("data-role");
                            if (!Z) {
                                j = i.attr("data-key");
                                break
                            }
                        }
                    }
                }
                if (p == "all") {
                    return {row: i, key: j}
                }
                return j
            };
            var t = null;
            var l = function () {
                if (!Q && !x) {
                    I.clearSelection(false)
                }
                if (s == 33 || s == 37) {
                    var j = d;
                    t = I._getuikey(j, "prev");
                    if (!t) {
                        t = g()
                    }
                } else {
                    if (s == 34 || s == 39) {
                        var j = d;
                        t = I._getuikey(j, "next");
                        if (!t) {
                            t = W()
                        }
                    } else {
                        if (s == 38) {
                            t = W()
                        } else {
                            if (s == 40) {
                                t = g()
                            }
                        }
                    }
                }
                I._lastSelectedKey = t;
                var p = I.rowsByKey[t];
                var j = I.getrowindex(p);
                var i = I.getrowdisplayindex(p);
                I._raiseEvent("rowSelect", {key: t, index: i, boundIndex: j, row: I.rowsByKey[t]});
                I._doSelection(t, true, true);
                I.host.focus()
            };
            var k = function () {
                I.clearSelection(false);
                var i = g();
                if (x || Q) {
                    I._selectRange(v.index(), 0)
                } else {
                    I._lastSelectedKey = i
                }
                I.selectrowbykey(i, "keyboard")
            };
            var r = function () {
                I.clearSelection(false);
                var i = W("all");
                var j = i.key;
                if (x || Q) {
                    I._selectRange(v.index(), i.row.index())
                } else {
                    I._lastSelectedKey = j
                }
                I.selectrowbykey(j, "keyboard")
            };
            if (this.treeGrid && this.rtl) {
                if (s == 37) {
                    s = 39
                } else {
                    if (s == 39) {
                        s = 37
                    }
                }
            }
            if (s == 36 || (Q && s == 38)) {
                k();
                return false
            } else {
                if (s == 35 || (Q && s == 40)) {
                    r();
                    return false
                } else {
                    if (s == 33 || s == 37) {
                        var t = v.attr("data-key");
                        if (this.rowDetails && s == 37 && !this.treeGrid) {
                            this.hidedetailsbykey(t);
                            return false
                        } else {
                            if (this.treeGrid && s == 37) {
                                if (this.rowinfo[t].row && !this.rowinfo[t].row[T.parent] && !this.rowinfo[t][T.leaf] && !this.rowinfo[t].expanded) {
                                    return false
                                }
                                if (this.rowinfo[t].expanded && !this.rowinfo[t][T.leaf]) {
                                    this.treeGrid.collapseRow(t);
                                    return false
                                } else {
                                    if (this.rowinfo[t].row && this.rowinfo[t].row[T.parent]) {
                                        t = this.rowinfo[t].row[T.parent].uid
                                    }
                                }
                                if (this.rowinfo[t][T.leaf]) {
                                    return false
                                }
                            }
                        }
                        if (this.pageable && !this.treeGrid) {
                            if (!this.rtl) {
                                this.goToPrevPage(l)
                            } else {
                                this.goToNextPage(l)
                            }
                            return false
                        }
                        if (this.treeGrid && this.pageable && s == 33) {
                            this.goToPrevPage(l);
                            return false
                        }
                    } else {
                        if (s == 34 || s == 39) {
                            var t = v.attr("data-key");
                            if (this.rowDetails && s == 39 && !this.treeGrid) {
                                this.showdetailsbykey(t);
                                return false
                            } else {
                                if (this.treeGrid && s == 39) {
                                    if (this.rowinfo[t][T.leaf]) {
                                        return false
                                    }
                                    if (!this.rowinfo[t].expanded) {
                                        this.treeGrid.expandRow(t);
                                        return false
                                    } else {
                                        if (this.rowinfo[t].row && this.rowinfo[t].row.records && this.rowinfo[t].row.records.length > 0) {
                                            if (this.dataview.filters.length > 0) {
                                                var m = this.rowinfo[t].row.records;
                                                for (var S = 0; S < m.length; S++) {
                                                    if (m[S]._visible) {
                                                        t = m[S].uid;
                                                        break
                                                    }
                                                }
                                            } else {
                                                t = this.rowinfo[t].row.records[0].uid
                                            }
                                        }
                                    }
                                }
                            }
                            if (this.pageable && !this.treeGrid) {
                                if (!this.rtl) {
                                    this.goToNextPage(l)
                                } else {
                                    this.goToPrevPage(l)
                                }
                                return false
                            }
                            if (this.treeGrid && this.pageable && s == 34) {
                                this.goToNextPage(l);
                                return false
                            }
                        } else {
                            if (s == 38) {
                                while (v) {
                                    v = v.prev();
                                    if (v) {
                                        var D = v.attr("data-role");
                                        if (!D) {
                                            t = v.attr("data-key");
                                            break
                                        }
                                    }
                                }
                                if (this.pageable && t == null) {
                                    this.goToPrevPage(l);
                                    return false
                                }
                            } else {
                                if (s == 40) {
                                    while (v) {
                                        v = v.next();
                                        if (v) {
                                            var D = v.attr("data-role");
                                            if (!D) {
                                                t = v.attr("data-key");
                                                break
                                            }
                                        }
                                    }
                                    if (this.pageable && t == null) {
                                        this.goToNextPage(l);
                                        return false
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if (t != null) {
                if (!Q && !x) {
                    this.clearSelection(false)
                }
                if (this.rowinfo[t]) {
                    if (this.rowinfo[t].selected && (Q || x)) {
                        this._doSelection(this._lastSelectedKey, false, false);
                        this._lastSelectedKey = t;
                        var o = this.rowsByKey[t];
                        var C = this.getrowindex(o);
                        I._updateSelection();
                        var L = this.getrowdisplayindex(o);
                        this._raiseEvent("rowUnselect", {key: t, index: L, boundIndex: C, row: o});
                        return false
                    }
                }
                this._lastSelectedKey = t;
                var o = this.rowsByKey[t];
                var C = this.getrowindex(o);
                this._doSelection(t, true, false);
                I._updateSelection();
                var L = this.getrowdisplayindex(o);
                this._raiseEvent("rowSelect", {key: t, index: L, boundIndex: C, row: o});
                if (this.treeGrid) {
                    if (s == 37) {
                        var v = this._getuirow(t);
                        var U = null;
                        if (v) {
                            var D = v.attr("data-role");
                            if (!D) {
                                U = v.attr("data-key")
                            }
                        }
                        if (this.pageable && U == null && this.dataview.pagenum > 0) {
                            while (this._getuirow(t) == null && this.dataview.pagenum > 0) {
                                this.goToPrevPage()
                            }
                        }
                    } else {
                        if (s == 39) {
                            var v = this._getuirow(t);
                            var U = null;
                            if (v) {
                                var D = v.attr("data-role");
                                if (!D) {
                                    U = v.attr("data-key")
                                }
                            }
                            if (this.pageable && U == null) {
                                this.goToNextPage()
                            }
                        }
                    }
                }
                return false
            }
        }, _selection: function (c) {
            if ("selectionStart" in c[0]) {
                var h = c[0];
                var i = h.selectionEnd - h.selectionStart;
                return {start: h.selectionStart, end: h.selectionEnd, length: i, text: h.value}
            } else {
                var f = document.selection.createRange();
                if (f == null) {
                    return {start: 0, end: h.value.length, length: 0}
                }
                var d = c[0].createTextRange();
                var g = d.duplicate();
                d.moveToBookmark(f.getBookmark());
                g.setEndPoint("EndToStart", d);
                var i = f.text.length;
                return {start: g.text.length, end: g.text.length + f.text.length, length: i, text: f.text}
            }
        }, _doSelection: function (c, e, d) {
            if (c == null) {
                this.clearSelection();
                return
            }
            if (this.selectionMode === "singlerow") {
                this.clearSelection(false)
            }
            var f = this.rowinfo[c];
            if (f) {
                f.selected = e;
                this.ensurerowvisiblebykey(c)
            } else {
                this.ensurerowvisiblebykey(c);
                var f = this.rowinfo[c];
                if (f) {
                    f.selected = e
                } else {
                    this.rowinfo[c] = {selected: e}
                }
            }
            if (this.selectionMode != "none") {
                if (d !== false) {
                    this._renderrows()
                }
            }
        }, clearSelection: function (e) {
            if (this.rowinfo) {
                var f = this.getRows();
                for (var h in this.rowinfo) {
                    var g = this.rowinfo[h];
                    if (g.selected) {
                        g.selected = false;
                        var d = f.indexOf(g.row);
                        var c = this.getrowdisplayindex(g.row);
                        this._raiseEvent("rowUnselect", {key: h, index: c, boundIndex: d, row: g.row})
                    }
                }
            }
            if (e !== false) {
                this._renderrows()
            }
        }, exportData: function (t) {
            if (!b.jqx.dataAdapter.ArrayExporter) {
                if (!this.treeGrid) {
                    throw"jqxDataTable: Missing reference to jqxdata.export.js!"
                }
                throw"jqxTreeGrid: Missing reference to jqxdata.export.js!"
            }
            var h = this.exportSettings.columnsHeader;
            if (h == undefined) {
                h = true
            }
            var w = this.exportSettings.hiddenColumns;
            if (w == undefined) {
                w = false
            }
            var P = this.exportSettings.serverURL;
            var I = this.exportSettings.characterSet;
            var ac = this.exportSettings.collapsedRecords;
            if (ac == undefined) {
                ac = false
            }
            var F = this.exportSettings.fileName;
            if (F === undefined) {
                F = this.treeGrid ? "jqxTreeGrid_Data" : "jqxDataTable_Data"
            }
            var s = this;
            var Y = this.getRows();
            if (this.exportSettings.recordsInView == true) {
                Y = this.getView()
            }
            if (this.treeGrid && this.treeGrid.virtualModeCreateRecords) {
                var Y = this.treeGrid.getRows()
            }
            if (this.groups && this.groups.length > 0) {
                var k = this.source.getGroupedRecords(this.groups, "records", "label", null, "data", null, "parent", Y);
                var m = function (o, ad) {
                    for (var af = 0; af < o.length; af++) {
                        var j = b.extend({}, o[af]);
                        ad.push(j);
                        if (j.records && j.records.length > 0) {
                            var ag = m(j.records, new Array());
                            for (var ae = 0; ae < ag.length; ae++) {
                                if (ag[ae].leaf) {
                                    ad.push(ag[ae])
                                } else {
                                    ad.push(ag[ae])
                                }
                            }
                        }
                    }
                    return ad
                };
                var S = m.call(this, k, new Array());
                Y = S
            }
            if (Y.length == 0) {
                throw"No data to export."
            }
            this.exporting = true;
            if (this.altRows) {
                this._renderrows()
            }
            var p = new Array();
            for (var X = 0; X < this.columns.records.length; X++) {
                if (!w && this.columns.records[X].hidden) {
                    continue
                }
                p.push(b.extend({}, this.columns.records[X]))
            }
            if (this.groups && this.groups.length > 0) {
                if (p.length > 0) {
                    var aa = this._names();
                    for (var X = 0; X < Y.length; X++) {
                        if (!Y[X][aa.leaf]) {
                            if (!s.rtl) {
                                Y[X][p[0].displayfield] = Y[X].label
                            } else {
                                Y[X][p[p.length - 1].displayfield] = Y[X].label
                            }
                        }
                    }
                }
            }
            var g = 0;
            if (this.treeGrid) {
                var L = this.treeGrid.getRows();
                if (this.exportSettings.recordsInView == true) {
                    L = this.getView()
                }
                var aa = this._names();
                var d = function (ad) {
                    for (var ae = 0; ae < ad.length; ae++) {
                        var j = ad[ae];
                        var o = j[aa.expanded] || (!j[aa.expanded] && ac);
                        g = Math.max(g, 1 + j[aa.level]);
                        if (j.records && j.records.length > 0 && o) {
                            d(ad[ae].records)
                        }
                    }
                };
                d(L);
                if (t != "xml" && t != "json") {
                    var u = p.length;
                    for (var X = 0; X < g; X++) {
                        var Q = new a(this, this);
                        Q.width = this.indentWidth;
                        Q.datafield = "Level" + X;
                        Q.displayfield = "Level" + X;
                        Q.align = "center";
                        Q.cellsalign = "center";
                        Q.text = "";
                        if (!this.rtl) {
                            p.splice(X, 0, Q)
                        } else {
                            p.splice(u, 0, Q)
                        }
                    }
                    var y = new Array();
                    var x = this.source._source.hierarchy && this.source._source.hierarchy.groupingDataFields ? true : false;
                    var U = function (ae) {
                        for (var ag = 0; ag < ae.length; ag++) {
                            var o = b.extend({}, ae[ag]);
                            for (var af = 0; af < o[aa.level]; af++) {
                                o["Level" + af] = ""
                            }
                            var ad = o[aa.expanded] || (!o[aa.expanded] && ac);
                            if (t == "xls" || t == "html" || t == "pdf") {
                                if (o.records && o.records.length > 0) {
                                    o["Level" + o[aa.level]] = ad ? "-" : "+"
                                } else {
                                    o["Level" + o[aa.level]] = ""
                                }
                            } else {
                                o["Level" + o[aa.level]] = ""
                            }
                            if (o[aa.leaf]) {
                                o["Level" + o[aa.level]] = ""
                            }
                            for (var af = o[aa.level] + 1; af < g; af++) {
                                o["Level" + af] = ""
                            }
                            if (x && !o[aa.leaf]) {
                                if (!s.rtl) {
                                    o[p[g].displayfield] = o.label
                                } else {
                                    o[p[p.length - g - 1].displayfield] = o.label
                                }
                            }
                            if (o.aggregate) {
                                var ai = t == "xls" ? "_AG" : "";
                                for (var af = g; af < p.length; af++) {
                                    var ah = af;
                                    if (s.rtl) {
                                        ah = p.length - af - 1
                                    }
                                    if (o[p[ah].displayfield] != undefined) {
                                        o[p[ah].displayfield] = ai + o[p[ah].displayfield]
                                    }
                                }
                            }
                            y.push(o);
                            if (ad && !o[aa.leaf]) {
                                U(o.records)
                            }
                        }
                    };
                    U(L);
                    Y = y
                } else {
                    Y = L
                }
            }
            var f = w != undefined ? w : false;
            var Z = {};
            var C = {};
            var l = [];
            var M = this.host.find(".jqx-grid-cell:first");
            var n = this.host.find(".jqx-grid-cell-alt:first");
            var K = this;
            M.removeClass(K.toThemeProperty("jqx-grid-cell-selected"));
            M.removeClass(K.toThemeProperty("jqx-fill-state-pressed"));
            n.removeClass(K.toThemeProperty("jqx-grid-cell-selected"));
            n.removeClass(K.toThemeProperty("jqx-fill-state-pressed"));
            M.removeClass(K.toThemeProperty("jqx-grid-cell-hover"));
            M.removeClass(K.toThemeProperty("jqx-fill-state-hover"));
            n.removeClass(K.toThemeProperty("jqx-grid-cell-hover"));
            n.removeClass(K.toThemeProperty("jqx-fill-state-hover"));
            var E = "cell";
            var B = 1;
            var J = "column";
            var z = 1;
            var A = [];
            for (var V = 0; V < p.length; V++) {
                var Q = p[V];
                if (Q.cellclassname != "") {
                    Q.customCellStyles = new Array();
                    if (typeof Q.cellclassname == "string") {
                        Q.customCellStyles.push(Q.cellclassname)
                    } else {
                        for (var X = 0; X < Y.length; X++) {
                            var c = X;
                            var W = Q.cellclassname(c, Q.displayfield, Y[X][Q.displayfield], Y[X]);
                            if (W) {
                                Q.customCellStyles[X] = W
                            }
                        }
                    }
                }
            }
            b.each(p, function (af) {
                var ai = af;
                if (s.treeGrid) {
                    if (af >= g) {
                        ai = p.length - g - 1
                    } else {
                        if (g > 0 && af < g) {
                            ai = 0
                        }
                    }
                }
                var aj = b(s._table[0].rows[0].cells[ai]);
                if (s._table[0].rows.length > 1) {
                    var j = b(s._table[0].rows[1].cells[ai]);
                    if (j.length == 0) {
                        var j = b(s._table[0].rows[1].cells[0])
                    }
                }
                if (aj.length == 0) {
                    var aj = b(s._table[0].rows[0].cells[0])
                }
                var ae = this;
                var ag = function (am) {
                    am.removeClass(K.toThemeProperty("jqx-cell"));
                    am.removeClass(K.toThemeProperty("jqx-grid-cell-selected"));
                    am.removeClass(K.toThemeProperty("jqx-fill-state-pressed"));
                    am.removeClass(K.toThemeProperty("jqx-grid-cell-hover"));
                    am.removeClass(K.toThemeProperty("jqx-fill-state-hover"));
                    if (ae.customCellStyles) {
                        for (var an in ae.customCellStyles) {
                            am.removeClass(ae.customCellStyles[an])
                        }
                    }
                };
                ag(aj);
                if (j) {
                    ag(j)
                }
                if (this.displayfield == null) {
                    return true
                }
                if (s.showAggregates) {
                    if (s.getcolumnaggregateddata) {
                        if (s.treeGrid) {
                            var al = function (am, an) {
                                for (var ao = 0; ao < am.length; ao++) {
                                    var o = am[ao];
                                    if (o.level === 0) {
                                        an.push(o)
                                    }
                                }
                                return an
                            };
                            A.push(s.getcolumnaggregateddata(this.displayfield, this.aggregates, true, al(Y, [])))
                        } else {
                            A.push(s.getcolumnaggregateddata(this.displayfield, this.aggregates, true, Y))
                        }
                    }
                }
                var ah = s._getexportcolumntype(this);
                if (this.exportable && (!this.hidden || f)) {
                    Z[this.displayfield] = {};
                    Z[this.displayfield].text = this.text;
                    Z[this.displayfield].width = parseInt(this.width);
                    if (isNaN(Z[this.displayfield].width)) {
                        Z[this.displayfield].width = 60
                    }
                    if (Z[this.displayfield].width > 500) {
                        Z[this.displayfield].width = 500
                    }
                    Z[this.displayfield].formatString = this.cellsFormat;
                    Z[this.displayfield].localization = s.gridlocalization;
                    Z[this.displayfield].type = ah;
                    Z[this.displayfield].cellsAlign = this.cellsalign;
                    Z[this.displayfield].hidden = !h;
                    Z[this.displayfield].index = ai;
                    Z[this.displayfield].maxIndex = p.length
                }
                E = "cell" + B;
                var ak = this.element;
                if (t != "json" && t != "xml") {
                    J = "column" + z;
                    var i = function (o, au, at, am, ar, ao, an, ap, aq) {
                        C[o] = {index: 1 + an, maxIndex: p.length};
                        if (ao.rtl) {
                            C[o].index = p.length - an
                        }
                        if (t == "html" || t == "xls" || t == "pdf") {
                            if (au) {
                                C[o]["font-size"] = au.css("font-size");
                                C[o]["font-weight"] = au.css("font-weight");
                                C[o]["font-style"] = au.css("font-style");
                                C[o]["background-color"] = ao._getexportcolor(au.css("background-color"));
                                C[o]["color"] = ao._getexportcolor(au.css("color"));
                                C[o]["border-color"] = ao._getexportcolor(au.css("border-top-color"))
                            }
                            if (at) {
                                C[o]["text-align"] = ar.align
                            } else {
                                C[o]["text-align"] = ar.cellsalign;
                                C[o]["formatString"] = ar.cellsFormat;
                                C[o]["dataType"] = ah
                            }
                            if (t == "html" || t == "pdf") {
                                C[o]["border-top-width"] = "0px";
                                if (!ao.rtl) {
                                    C[o]["border-left-width"] = "0px";
                                    C[o]["border-right-width"] = "1px"
                                } else {
                                    C[o]["border-left-width"] = "1px";
                                    C[o]["border-right-width"] = "0px";
                                    if (an == p.length - g - 1 && at) {
                                        C[o]["border-right-width"] = "1px"
                                    }
                                }
                                C[o]["border-bottom-width"] = "1px";
                                if (au) {
                                    C[o]["border-top-style"] = au.css("border-top-style");
                                    C[o]["border-left-style"] = au.css("border-left-style");
                                    C[o]["border-right-style"] = au.css("border-right-style");
                                    C[o]["border-bottom-style"] = au.css("border-bottom-style")
                                }
                                if (at) {
                                    if (an == 0 && !ao.rtl) {
                                        C[o]["border-left-width"] = "1px"
                                    } else {
                                        if (an == p.length - 1 && ao.rtl) {
                                            C[o]["border-right-width"] = "1px"
                                        }
                                    }
                                    if (au) {
                                        C[o]["border-top-width"] = "1px";
                                        C[o]["border-bottom-width"] = au.css("border-bottom-width")
                                    }
                                } else {
                                    if (an == 0 && !ao.rtl) {
                                        C[o]["border-left-width"] = "1px"
                                    } else {
                                        if (an == p.length - 1 && ao.rtl) {
                                            C[o]["border-right-width"] = "1px"
                                        }
                                    }
                                }
                                if (au) {
                                    C[o]["height"] = au.css("height")
                                }
                                if (ao.treeGrid && !at) {
                                    if (C[o].index - 1 < g) {
                                        if (ao.rtl) {
                                            C[o]["border-left-width"] = "0px"
                                        } else {
                                            C[o]["border-right-width"] = "0px"
                                        }
                                    } else {
                                        if (C[o].index - 1 == g) {
                                            if (!ao.rtl) {
                                                C[o]["border-left-width"] = "0px"
                                            } else {
                                                C[o]["border-right-width"] = "0px"
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        if (ar.exportable && (!ar.hidden || f)) {
                            if (ap == true) {
                                if (!Z[ar.displayfield].customCellStyles) {
                                    Z[ar.displayfield].customCellStyles = new Array()
                                }
                                Z[ar.displayfield].customCellStyles[aq] = o
                            } else {
                                if (at) {
                                    Z[ar.displayfield].style = o
                                } else {
                                    if (!am) {
                                        Z[ar.displayfield].cellStyle = o
                                    } else {
                                        Z[ar.displayfield].cellAltStyle = o
                                    }
                                }
                            }
                        }
                    };
                    i(J, ak, true, false, this, s, af);
                    z++;
                    i(E, aj, false, false, this, s, af);
                    if (s.altRows) {
                        E = "cellalt" + B;
                        i(E, j, false, true, this, s, af)
                    }
                    if (this.customCellStyles) {
                        for (var ad in ae.customCellStyles) {
                            aj.removeClass(ae.customCellStyles[ad])
                        }
                        for (var ad in ae.customCellStyles) {
                            aj.addClass(ae.customCellStyles[ad]);
                            i(E + ae.customCellStyles[ad], aj, false, false, this, s, af, true, ad);
                            aj.removeClass(ae.customCellStyles[ad])
                        }
                    }
                    B++
                }
            });
            if (t != "json" && t != "xml") {
                if (g > 0 && this.treeGrid) {
                    var ab = g + 1;
                    if (this.rtl) {
                        ab = p.length - g
                    }
                    if (C["column" + ab]) {
                        var e = C["column" + ab];
                        e.merge = g;
                        e["border-left-width"] = "1px";
                        var H = C["cell" + ab];
                        for (var X = 0; X < p.length; X++) {
                            var ab = X + 1;
                            if (this.rtl) {
                                ab = p.length - X
                            }
                            C["column" + ab].level = X;
                            C["column" + ab].maxLevel = g;
                            C["cell" + ab].maxLevel = g;
                            var Q = p[X];
                            if (Q.customCellStyles) {
                                for (var R in Q.customCellStyles) {
                                    if (C["cell" + ab + Q.customCellStyles[R]]) {
                                        C["cell" + ab + Q.customCellStyles[R]].maxLevel = g
                                    }
                                }
                            }
                            if (C["cellalt" + ab]) {
                                C["cellalt" + ab].maxLevel = g
                            }
                        }
                        for (var X = 0; X < g; X++) {
                            var ab = X + 1;
                            var D = X;
                            if (this.rtl) {
                                ab = p.length - X
                            }
                            var r = C["column" + ab];
                            r.disabled = true;
                            C["cell" + ab].level = D;
                            C["cell" + ab].maxLevel = g;
                            C["column" + ab].level = D;
                            if (C["cellalt" + ab]) {
                                C["cellalt" + ab].level = D;
                                C["cellalt" + ab].maxLevel = g
                            }
                            var Q = p[X];
                            if (Q.customCellStyles) {
                                for (var R in Q.customCellStyles) {
                                    if (C["cell" + ab + Q.customCellStyles[R]]) {
                                        C["cell" + ab + Q.customCellStyles[R]].maxLevel = g;
                                        C["cell" + ab + Q.customCellStyles[R]].level = D
                                    }
                                }
                            }
                            if (t == "html" || t == "pdf" || t == "xls") {
                                r["font-size"] = e["font-size"];
                                r["font-weight"] = e["font-weight"];
                                r["font-style"] = e["font-style"];
                                r["background-color"] = e["background-color"];
                                r.color = e.color;
                                r["border-color"] = e["border-color"];
                                if (t == "html" || t == "pdf") {
                                    r["border-top-width"] = e["border-top-width"];
                                    r["border-left-width"] = e["border-left-width"];
                                    if (this.rtl) {
                                        r["border-right-width"] = e["border-right-width"];
                                        if (X == 0) {
                                            r["border-right-width"] = "1px"
                                        }
                                    }
                                    if (X == 0 && !this.rtl) {
                                        r["border-left-width"] = "0px"
                                    } else {
                                        if (X == 0 && this.rtl) {
                                            r["border-left-width"] = "0px"
                                        }
                                    }
                                    if (!this.rtl) {
                                        r["border-right-width"] = "0px"
                                    } else {
                                        if (this.rtl) {
                                            r["border-left-width"] = "0px"
                                        }
                                    }
                                    r["border-bottom-width"] = "0px";
                                    var r = C["cell" + ab];
                                    if (!this.rtl) {
                                        r["border-right-width"] = "0px"
                                    } else {
                                        if (this.rtl) {
                                            r["border-left-width"] = "0px"
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if (this.showAggregates) {
                var G = [];
                var N = t == "xls" ? "_AG" : "";
                var O = 0;
                if (this.rowDetails && !this.treeGrid) {
                    O++
                }
                if (A.length > 0) {
                    b.each(p, function (j) {
                        if (this.aggregates) {
                            for (var ad = 0; ad < this.aggregates.length; ad++) {
                                if (!G[ad]) {
                                    G[ad] = {}
                                }
                                if (G[ad]) {
                                    var ae = s._getaggregatename(this.aggregates[ad]);
                                    var af = s._getaggregatetype(this.aggregates[ad]);
                                    var o = A[j - O];
                                    if (o) {
                                        G[ad][this.displayfield] = N + ae + ": " + o[af]
                                    }
                                }
                            }
                        }
                    });
                    b.each(p, function (j) {
                        for (var o = 0; o < G.length; o++) {
                            if (G[o][this.displayfield] == undefined) {
                                G[o][this.displayfield] = N
                            }
                        }
                    })
                }
                b.each(G, function () {
                    Y.push(this)
                })
            }
            var K = this;
            var T = b.jqx.dataAdapter.ArrayExporter(Y, Z, C, P, this.treeGrid && (t == "xml" || t == "json"));
            if (F == undefined) {
                this._renderrows();
                var q = this.treeGrid && (t == "xml" || t == "json");
                var v = T.exportTo(t, this.treeGrid && (t == "xml" || t == "json"));
                if (this.showAggregates) {
                    b.each(G, function () {
                        Y.pop(this)
                    })
                }
                setTimeout(function () {
                    K.exporting = false
                }, 50);
                return v
            } else {
                var q = this.treeGrid && (t == "xml" || t == "json");
                T.exportToFile(t, F, P, I, q)
            }
            if (this.showAggregates) {
                b.each(G, function () {
                    Y.pop(this)
                })
            }
            this._renderrows();
            setTimeout(function () {
                K.exporting = false
            }, 50)
        }, _getexportcolor: function (l) {
            var f = l;
            if (l == "transparent") {
                f = "#FFFFFF"
            }
            if (!f || !f.toString()) {
                f = "#FFFFFF"
            }
            if (f.toString().indexOf("rgb") != -1) {
                var i = f.split(",");
                if (f.toString().indexOf("rgba") != -1) {
                    var d = parseInt(i[0].substring(5));
                    var h = parseInt(i[1]);
                    var j = parseInt(i[2]);
                    var k = parseFloat(i[3].substring(1, 4));
                    var m = {r: d, g: h, b: j};
                    var e = this._rgbToHex(m);
                    if (d == 0 && h == 0 && j == 0 && k == 0) {
                        return "#ffffff"
                    }
                    return "#" + e
                }
                var d = parseInt(i[0].substring(4));
                var h = parseInt(i[1]);
                var j = parseInt(i[2].substring(1, 4));
                var m = {r: d, g: h, b: j};
                var e = this._rgbToHex(m);
                return "#" + e
            } else {
                if (f.toString().indexOf("#") != -1) {
                    if (f.toString().length == 4) {
                        var c = f.toString().substring(1, 4);
                        f += c
                    }
                }
            }
            return f
        }, _rgbToHex: function (c) {
            return this._intToHex(c.r) + this._intToHex(c.g) + this._intToHex(c.b)
        }, _intToHex: function (d) {
            var c = (parseInt(d).toString(16));
            if (c.length == 1) {
                c = ("0" + c)
            }
            return c.toUpperCase()
        }, _getexportcolumntype: function (g) {
            var h = this;
            var f = "string";
            var e = h.source.datafields || ((h.source._source) ? h.source._source.datafields : null);
            if (e) {
                var j = "";
                b.each(e, function () {
                    if (this.name == g.displayfield) {
                        if (this.type) {
                            j = this.type
                        }
                        return false
                    }
                });
                if (j) {
                    return j
                }
            }
            if (g != null) {
                if (this.dataview.cachedrecords == undefined) {
                    return f
                }
                var c = null;
                if (!this.virtualmode) {
                    if (this.dataview.cachedrecords.length == 0) {
                        return f
                    }
                    c = this.dataview.cachedrecords[0][g.displayfield];
                    if (c != null && c.toString() == "") {
                        return "string"
                    }
                } else {
                    b.each(this.dataview.cachedrecords, function () {
                        c = this[g.displayfield];
                        return false
                    })
                }
                if (c != null) {
                    if (g.cellsFormat.indexOf("c") != -1) {
                        return "number"
                    }
                    if (g.cellsFormat.indexOf("n") != -1) {
                        return "number"
                    }
                    if (g.cellsFormat.indexOf("p") != -1) {
                        return "number"
                    }
                    if (g.cellsFormat.indexOf("d") != -1) {
                        return "date"
                    }
                    if (g.cellsFormat.indexOf("y") != -1) {
                        return "date"
                    }
                    if (g.cellsFormat.indexOf("M") != -1) {
                        return "date"
                    }
                    if (g.cellsFormat.indexOf("m") != -1) {
                        return "date"
                    }
                    if (g.cellsFormat.indexOf("t") != -1) {
                        return "date"
                    }
                    if (typeof c == "boolean") {
                        f = "boolean"
                    } else {
                        if (b.jqx.dataFormat.isNumber(c)) {
                            f = "number"
                        } else {
                            var i = new Date(c);
                            if (i.toString() == "NaN" || i.toString() == "Invalid Date") {
                                if (b.jqx.dataFormat) {
                                    i = b.jqx.dataFormat.tryparsedate(c);
                                    if (i != null) {
                                        if (i && i.getFullYear()) {
                                            if (i.getFullYear() == 1970 && i.getMonth() == 0 && i.getDate() == 1) {
                                                var d = new Number(c);
                                                if (!isNaN(d)) {
                                                    return "number"
                                                }
                                                return "string"
                                            }
                                        }
                                        return "date"
                                    } else {
                                        f = "string"
                                    }
                                } else {
                                    f = "string"
                                }
                            } else {
                                f = "date"
                            }
                        }
                    }
                }
            }
            return f
        }, showDetails: function (c) {
            var d = this._getkey(c);
            this.showdetailsbykey(d)
        }, hideDetails: function (c) {
            var d = this._getkey(c);
            this.hidedetailsbykey(d)
        }, setCellValueByKey: function (E, t, x) {
            var o = this;
            var j = this.rowsByKey[E];
            var k = this.getrowindex(j);
            var h = j;
            if (h != null && h[t] == x) {
                return false
            }
            if (h != null && h[t] === null && x === "") {
                return
            }
            var n = "";
            if (h != null && h[t] !== x) {
                var e = this.getColumn(t);
                var f = "string";
                var B = this.source.datafields || ((this.source._source) ? this.source._source.datafields : null);
                if (B) {
                    var u = "";
                    b.each(B, function () {
                        if (this.name == e.displayfield) {
                            if (this.type) {
                                u = this.type
                            }
                            return false
                        }
                    });
                    if (u) {
                        f = u
                    }
                }
                n = h[t];
                if (!e.nullable || (x != null && x !== "" && e.nullable && x.label === undefined)) {
                    if (b.jqx.dataFormat.isNumber(n) || f == "number" || f == "float" || f == "int" || f == "decimal" && f != "date") {
                        x = new Number(x);
                        x = parseFloat(x);
                        if (isNaN(x)) {
                            x = 0
                        }
                    } else {
                        if (b.jqx.dataFormat.isDate(n) || f == "date") {
                            if (x != "") {
                                var A = x;
                                A = new Date(A);
                                if (A != "Invalid Date" && A != null) {
                                    x = A
                                } else {
                                    if (A == "Invalid Date") {
                                        A = new Date();
                                        x = A
                                    }
                                }
                            }
                        }
                    }
                    if (h[t] === x) {
                        return
                    }
                }
                o.dataview._filteredData = null;
                o.dataview._sortData = null;
                o.dataview._sortHierarchyData = null;
                h[t] = x;
                if (this.treeGrid) {
                    var s = this.treeGrid.getRow(E);
                    if (s) {
                        s[t] = x
                    }
                }
                if (x != null && x.label != null) {
                    var e = this.getColumn(t);
                    h[e.displayfield] = x.label;
                    h[t] = x.value;
                    if (this.treeGrid) {
                        var s = this.treeGrid.getRow(E);
                        if (s) {
                            s[e.displayfield] = x.label;
                            s[t] = x.value
                        }
                    }
                }
            }
            if (this.source && this.source._knockoutdatasource && !this._updateFromAdapter && this.autokoupdates) {
                if (this.source._source._localdata) {
                    var z = k;
                    var w = this.source._source._localdata()[z];
                    this.source.suspendKO = true;
                    var l = w;
                    if (l[t] && l[t].subscribe) {
                        if (x != null && x.label != null) {
                            l[e.displayfield](x.label);
                            l[t](x.value)
                        } else {
                            l[t](x)
                        }
                    } else {
                        var B = this.source._source.datafields;
                        var d = null;
                        var C = null;
                        if (B) {
                            b.each(B, function () {
                                if (this.name == t) {
                                    C = this.map;
                                    return false
                                }
                            })
                        }
                        if (C == null) {
                            if (x != null && x.label != null) {
                                l[t] = x.value;
                                l[e.displayfield] = x.label
                            } else {
                                l[t] = x
                            }
                        } else {
                            var g = C.split(this.source.mapChar);
                            if (g.length > 0) {
                                var c = l;
                                for (var v = 0; v < g.length - 1; v++) {
                                    c = c[g[v]]
                                }
                                c[g[g.length - 1]] = x
                            }
                        }
                        this.source._source._localdata.replace(w, b.extend({}, l))
                    }
                    this.source.suspendKO = false
                }
            }
            var q;
            if (this.source.updaterow && (q == undefined || q == true)) {
                var m = false;
                var r = function (p) {
                    if (false == p) {
                        this.setCellValue(j, t, n, true, false)
                    }
                };
                try {
                    var i = E;
                    m = this.source.updaterow(i, h, r);
                    if (m == undefined) {
                        m = true
                    }
                } catch (y) {
                    m = false;
                    this.setCellValue(j, t, n);
                    return
                }
            }
            var D = this.getrowdisplayindex(j);
            var e = this.getColumn(t);
            this._raiseEvent("cellValueChanged", {
                value: x,
                oldValue: n,
                dataField: t,
                displayField: e.displayfield,
                key: E,
                boundIndex: k,
                index: D,
                row: this.rowsByKey[E]
            });
            if (this.editable) {
                if (this.editKey != null) {
                    return
                }
            }
            this._renderrows()
        }, setCellValue: function (g, d, f) {
            if (g == null || d == null) {
                return false
            }
            var c = parseInt(g);
            var e = this._getkey(c);
            this.setCellValueByKey(e, d, f)
        }, getCellText: function (f, d) {
            if (f == null || d == null) {
                return false
            }
            var c = parseInt(f);
            var e = this._getkey(c);
            return this.getCellTextByKey(e, d)
        }, getCellTextByKey: function (e, d) {
            if (e == null || d == null) {
                return null
            }
            var c = this.getCellValueByKey(e, d);
            var f = this.getColumn(d);
            if (f && f.cellsFormat != "") {
                if (b.jqx.dataFormat) {
                    if (b.jqx.dataFormat.isDate(c)) {
                        c = b.jqx.dataFormat.formatdate(c, f.cellsFormat, this.gridlocalization)
                    } else {
                        if (b.jqx.dataFormat.isNumber(c) || (!isNaN(parseFloat(c)) && isFinite(c))) {
                            c = b.jqx.dataFormat.formatnumber(c, f.cellsFormat, this.gridlocalization)
                        }
                    }
                }
            }
            return c
        }, getCellValue: function (f, d) {
            if (f == null || d == null) {
                return false
            }
            var c = parseInt(f);
            var e = this._getkey(c);
            return this.getCellValueByKey(e, d)
        }, getCellValueByKey: function (e, d) {
            var h = this.rowsByKey[e];
            if (!h && this.treeGrid) {
                h = this.treeGrid.getRow(e)
            }
            var c = this.getrowindex(h);
            var f = h;
            var g = "";
            if (f != null) {
                return f[d]
            }
            return null
        }, beginRowEdit: function (c) {
            var d = this._getkey(c);
            this.beginroweditbykey(d)
        }, beginCellEdit: function (d, c) {
            var e = this._getkey(d);
            var f = this.getColumn(c);
            this.beginroweditbykey(e, f)
        }, endCellEdit: function (d, c, e) {
            this.endRowEdit(d, e)
        }, endRowEdit: function (c, e) {
            var d = this._getkey(c);
            this.endroweditbykey(d, e)
        }, getrowindex: function (f) {
            var d = this.getRows().indexOf(f);
            if (d != -1) {
                return d
            }
            if (this.groups && this.groups.length > 0) {
                var c = this.getRows();
                for (var e = 0; e < c.length; e++) {
                    if (f.originalRecord) {
                        if (c[e].uid == f.originalRecord.uid) {
                            d = e;
                            break
                        }
                    } else {
                        if (c[e].uid == f.uid) {
                            d = e;
                            break
                        }
                    }
                }
            }
            return d
        }, getrowdisplayindex: function (g) {
            if (this.treeGrid) {
                return -1
            }
            var c = this.getView();
            var e = c.indexOf(g);
            if (e != -1) {
                return e
            }
            if (g == undefined) {
                return e
            }
            var d = c;
            for (var f = 0; f < d.length; f++) {
                if (d[f].uid == g.uid || (g.originalRecord && d[f].uid == g.originalRecord.uid)) {
                    e = f;
                    break
                }
            }
            return e
        }, beginroweditbykey: function (H, r) {
            if (this.beginEdit) {
                var B = this.beginEdit(H, r);
                if (B === false) {
                    return false
                }
            }
            var E = !this.treeGrid ? this.groups.length : this.source._source.hierarchy && this.source._source.hierarchy.groupingDataFields ? this.source._source.hierarchy.groupingDataFields.length : 0;
            if (E > 0) {
                var n = this.rowsByKey[H];
                if (this.treeGrid) {
                    var n = this.treeGrid.getRow(H)
                }
                if (n.level < E) {
                    return false
                }
            }
            if (this._lastSelectedKey == null) {
                this.selectrowbykey(H)
            }
            if (this.editKey === H && this.editKey != undefined) {
                return false
            }
            if (this.rowinfo[H] && this.rowinfo[H].locked) {
                return false
            }
            if (this.editKey != null) {
                this.endroweditbykey(H, true);
                return false
            }
            var F = this.editSettings.editSingleCell;
            if (!r && F && this.columns.records && this.columns.records.length > 0) {
                for (var z = 0; z < this.columns.records.length; z++) {
                    r = this.columns.records[z];
                    if (r.editable && !r.hidden) {
                        break
                    }
                }
                if (!r) {
                    return false
                }
            }
            if (F && r && !r.editable) {
                this.editKey = null;
                return false
            }
            if (F) {
                this.editColumn = r
            }
            var p = this;
            var n = this.rowsByKey[H];
            if (this.treeGrid) {
                var n = this.treeGrid.getRow(H)
            }
            var o = this.getrowindex(n);
            var D = this._getuirow(H);
            var t = this._getpinneduirow(H);
            this._editors = new Array();
            var q = false;
            if (D) {
                var j = D[0].cells;
                var u = 0;
                for (var z = 0; z < j.length; z++) {
                    var h = this.columns.records[z];
                    var d = j[z];
                    if (h.rowDetailscolumn) {
                        continue
                    }
                    if (h.checkboxcolumn) {
                        continue
                    }
                    if (h.pinned) {
                        d = t[0].cells[z]
                    }
                    if (F && r && h.datafield != r.datafield) {
                        continue
                    }
                    b(d).removeClass(this.toTP("jqx-grid-cell-selected"));
                    b(d).removeClass(this.toTP("jqx-fill-state-pressed"));
                    b(d).removeClass(this.toTP("jqx-grid-cell-hover"));
                    b(d).removeClass(this.toTP("jqx-fill-state-hover"));
                    if (h.columntype == "none") {
                        continue
                    }
                    var v = b(d).outerWidth();
                    var x = b(d).width();
                    if (u === 0) {
                        u = b(d).outerHeight() - 1
                    }
                    b(d).css("padding", "0px");
                    var e = "<div style='height:" + u + "px; width: 100%; overflow: hidden; border-radius: 0px; -moz-border-radius: 0px; -webkit-border-radius: 0px; z-index: 9999;'></div>";
                    var s = this.getCellTextByKey(H, h.displayfield);
                    d.innerHTML = e;
                    var f = b(d.firstChild);
                    switch (h.columntype) {
                        case"textbox":
                        case"default":
                            var k = b("<input style='border: none;' autocomplete='off' autocorrect='off' autocapitalize='off' spellcheck='false' type='textbox'/>").appendTo(f);
                            if (this.rtl) {
                                k.css("direction", "rtl")
                            }
                            k.addClass(this.toThemeProperty("jqx-input"));
                            k.addClass(this.toThemeProperty("jqx-widget-content"));
                            k.addClass(this.toThemeProperty("jqx-cell-editor"));
                            k[0].onfocus = function (i) {
                                setTimeout(function () {
                                    if (i) {
                                        var I = b(i.target).parent().parent().index();
                                        if (I >= 0) {
                                            p.ensureColumnVisible(p.columns.records[I].datafield)
                                        }
                                    } else {
                                        var I = b(document.activeElement).parent().parent().index();
                                        if (I >= 0) {
                                            p.ensureColumnVisible(p.columns.records[I].datafield)
                                        }
                                    }
                                    if (p.content) {
                                        p.content[0].scrollTop = 0;
                                        p.content[0].scrollLeft = 0
                                    }
                                    if (p.gridcontent) {
                                        p.gridcontent[0].scrollLeft = 0;
                                        p.gridcontent[0].scrollTop = 0
                                    }
                                }, 10)
                            };
                            if (!h.editable) {
                                k.attr("disabled", true);
                                k.attr("readOnly", true);
                                k.addClass(this.toThemeProperty("jqx-fill-state-disabled"))
                            } else {
                                if (!q) {
                                    q = true;
                                    var g = b.jqx.browser.msie && b.jqx.browser.version > 10;
                                    if (!g) {
                                        k.focus()
                                    }
                                    var c = k;
                                    setTimeout(function () {
                                        var J = c.val().length;
                                        if (!g) {
                                            c.focus()
                                        }
                                        try {
                                            if ("selectionStart" in c[0]) {
                                                c[0].setSelectionRange(0, J)
                                            } else {
                                                var i = c[0].createTextRange();
                                                i.collapse(true);
                                                i.moveEnd("character", J);
                                                i.moveStart("character", 0);
                                                i.select()
                                            }
                                        } catch (I) {
                                            var K = I
                                        }
                                    }, 10)
                                }
                            }
                            k.width(x);
                            k.height(u);
                            if (b.jqx.browser.msie && b.jqx.browser.version < 9) {
                                k.css("line-height", parseInt(u) + "px")
                            }
                            k.css("text-align", h.cellsalign);
                            if (s === null) {
                                s = ""
                            }
                            if (s == undefined) {
                                s = ""
                            }
                            k.val(s);
                            if (h.createeditor) {
                                var C = s;
                                var s = this.getCellValueByKey(H, h.displayfield);
                                h.createeditor(!this.treeGrid ? o : H, s, k, C, x, u)
                            }
                            this._editors.push({column: h, editor: k});
                            if (h.cellsFormat != "") {
                                if (h.cellsFormat.indexOf("p") != -1 || h.cellsFormat.indexOf("c") != -1 || h.cellsFormat.indexOf("n") != -1 || h.cellsFormat.indexOf("f") != -1) {
                                    k.keydown(function (I) {
                                        var O = I.charCode ? I.charCode : I.keyCode ? I.keyCode : 0;
                                        var L = String.fromCharCode(O);
                                        var M = parseInt(L);
                                        if (isNaN(M)) {
                                            return true
                                        }
                                        if (p._selection(k).length > 0) {
                                            return true
                                        }
                                        var K = "";
                                        var J = k.val();
                                        if (h.cellsFormat.length > 1) {
                                            var N = parseInt(h.cellsFormat.substring(1));
                                            if (isNaN(N)) {
                                                N = 0
                                            }
                                        } else {
                                            var N = 0
                                        }
                                        if (N > 0) {
                                            if (J.indexOf(p.gridlocalization.decimalseparator) != -1) {
                                                if (p._selection(k).start > J.indexOf(p.gridlocalization.decimalseparator)) {
                                                    return true
                                                }
                                            }
                                        }
                                        for (var P = 0; P < J.length - N; P++) {
                                            var i = J.substring(P, P + 1);
                                            if (i.match(/^[0-9]+$/) != null) {
                                                K += i
                                            }
                                        }
                                        if (K.length >= 11) {
                                            return false
                                        }
                                    })
                                }
                            }
                            if (h.initeditor) {
                                var C = s;
                                var s = this.getCellValueByKey(H, h.displayfield);
                                h.initeditor(!this.treeGrid ? o : H, s, k, C, x, u)
                            }
                            break;
                        case"custom":
                        case"template":
                            if (!this.editorsCache) {
                                this.editorsCache = new Array()
                            }
                            var l = b("<div style='width: 100%; height: 100%; border: none;'></div>").appendTo(f);
                            var y = b.trim(h.datafield).split(" ").join("");
                            if (y.indexOf(".") != -1) {
                                y = y.replace(".", "")
                            }
                            var A = this.editorsCache["templateeditor_" + y];
                            if (h.columntype == "custom") {
                                var A = this.editorsCache["customeditor_" + y + "_" + H]
                            }
                            var C = s;
                            var s = this.getCellValueByKey(H, h.displayfield);
                            if (!A) {
                                var k = b("<div style='border: none;'></div>");
                                k.width(v);
                                k.height(u);
                                A = k;
                                if (s === null) {
                                    s = ""
                                }
                                if (h.columntype != "custom") {
                                    this.editorsCache["templateeditor_" + y] = k
                                } else {
                                    this.editorsCache["customeditor_" + y + "_" + H] = k
                                }
                                k.appendTo(l);
                                if (h.createeditor) {
                                    h.createeditor(!this.treeGrid ? o : H, s, k, C, v, u)
                                }
                            } else {
                                var k = A;
                                k.width(v);
                                k.height(u);
                                k.appendTo(l)
                            }
                            if (h.initeditor) {
                                h.initeditor(!this.treeGrid ? o : H, s, k, C, v, u)
                            }
                            this._editors.push({column: h, editor: k});
                            break
                    }
                }
            }
            this.editKey = H;
            this.beginUpdate();
            var G = this.getrowdisplayindex(n);
            this._raiseEvent("rowBeginEdit", {key: H, index: G, boundIndex: o, row: this.rowsByKey[H]});
            if (F) {
                var n = this.rowsByKey[H];
                var w = null;
                var m = null;
                if (n) {
                    w = n[r.datafield];
                    m = n[r.displayfield]
                }
                this._raiseEvent("cellBeginEdit", {
                    value: w,
                    displayValue: m,
                    key: H,
                    index: G,
                    dataField: r.datafield,
                    displayField: r.displayfield,
                    boundIndex: o,
                    row: this.rowsByKey[H]
                })
            }
            this.endUpdate(false)
        }, _toNumber: function (f) {
            if (!f.indexOf && f != undefined) {
                f = f.toString()
            }
            if (f.indexOf(this.gridlocalization.currencysymbol) > -1) {
                f = f.replace(this.gridlocalization.currencysymbol, "")
            }
            var c = function (l, j, k) {
                var h = l;
                if (j == k) {
                    return l
                }
                var i = h.indexOf(j);
                while (i != -1) {
                    h = h.replace(j, k);
                    i = h.indexOf(j)
                }
                return h
            };
            f = c(f, this.gridlocalization.thousandsseparator, "");
            f = f.replace(this.gridlocalization.decimalseparator, ".");
            if (f.indexOf(this.gridlocalization.percentsymbol) > -1) {
                f = f.replace(this.gridlocalization.percentsymbol, "")
            }
            var g = "";
            for (var d = 0; d < f.length; d++) {
                var e = f.substring(d, d + 1);
                if (e === "-") {
                    g += "-"
                }
                if (e === ".") {
                    g += "."
                }
                if (e.match(/^[0-9]+$/) != null) {
                    g += e
                }
            }
            f = g;
            f = f.replace(/ /g, "");
            return f
        }, _geteditorvalue: function (h, j, k, d) {
            var m = new String();
            if (j) {
                if (!h.geteditorvalue) {
                    switch (h.columntype) {
                        case"textbox":
                        default:
                            m = j.val();
                            if (h.cellsFormat != "") {
                                var l = "string";
                                var g = this.source.datafields || ((this.source._source) ? this.source._source.datafields : null);
                                if (g) {
                                    var n = "";
                                    b.each(g, function () {
                                        if (this.name == h.displayfield) {
                                            if (this.type) {
                                                n = this.type
                                            }
                                            return false
                                        }
                                    });
                                    if (n) {
                                        l = n
                                    }
                                }
                                var i = l === "number" || l === "float" || l === "int" || l === "integer";
                                var f = l === "date" || l === "time";
                                if (i || (l === "string" && (h.cellsFormat.indexOf("p") != -1 || h.cellsFormat.indexOf("c") != -1 || h.cellsFormat.indexOf("n") != -1 || h.cellsFormat.indexOf("f") != -1))) {
                                    if (m === "" && h.nullable) {
                                        return ""
                                    }
                                    m = this._toNumber(m);
                                    m = new Number(m);
                                    if (isNaN(m)) {
                                        m = ""
                                    }
                                }
                                if (f || (l === "string" && (h.cellsFormat.indexOf("H") != -1 || h.cellsFormat.indexOf("m") != -1 || h.cellsFormat.indexOf("M") != -1 || h.cellsFormat.indexOf("y") != -1 || h.cellsFormat.indexOf("h") != -1 || h.cellsFormat.indexOf("d") != -1))) {
                                    if (m === "" && h.nullable) {
                                        return ""
                                    }
                                    var e = m;
                                    m = new Date(m);
                                    if (m == "Invalid Date" || m == null || h.cellsFormat.length > 1) {
                                        if (b.jqx.dataFormat) {
                                            m = b.jqx.dataFormat.parsedate(e, h.cellsFormat, this.gridlocalization)
                                        }
                                        if (m == "Invalid Date" || m == null) {
                                            m = ""
                                        }
                                    }
                                }
                            }
                            if (h.displayfield != h.datafield) {
                                m = {label: m, value: m}
                            }
                            break
                    }
                }
                if (h.geteditorvalue) {
                    var c = this.getCellValueByKey(d, h.displayfield);
                    m = h.geteditorvalue(!this.treeGrid ? k : d, c, j)
                }
            }
            return m
        }, _validateEditors: function (c) {
            var k = this;
            var d = true;
            var s = k.rowsByKey[c];
            var l = k.getrowindex(s);
            var m = k._editors;
            var c = k.editKey;
            var p = k._getuirow(c);
            for (var h = 0; h < m.length; h++) {
                var j = m[h].editor;
                var f = m[h].column;
                var o = k._geteditorvalue(f, j, l, c);
                if (f.validation) {
                    j.removeClass(k.toThemeProperty("jqx-grid-validation-label"));
                    var e = f.datafield;
                    try {
                        var r = f.validation({
                            value: o,
                            row: c,
                            datafield: f.datafield,
                            displayfield: f.displayfield,
                            column: f
                        }, o);
                        var g = k.gridlocalization.validationstring;
                        if (r.message != undefined) {
                            g = r.message
                        }
                        var q = typeof r == "boolean" ? r : r.result;
                        if (!q) {
                            if (r.showmessage == undefined || r.showmessage == true) {
                                k._showvalidationpopup(p, e, g, j)
                            }
                            d = false
                        }
                    } catch (n) {
                        k._showvalidationpopup(p, e, k.gridlocalization.validationstring, j);
                        d = false
                    }
                }
            }
            return d
        }, endroweditbykey: function (p, r) {
            var k = this;
            if (k.editKey === null) {
                return
            }
            if (this.endEdit) {
                var n = this.endEdit(p);
                if (n === false) {
                    return
                }
            }
            var t = k.rowsByKey[p];
            var l = k.getrowindex(t);
            var m = k._editors;
            var e = k.editKey;
            var q = k._getuirow(e);
            if (r !== true) {
                var d = true;
                if (m) {
                    d = k._validateEditors(e);
                    if (d) {
                        var h = b.extend({}, t);
                        var c = b.extend({}, t);
                        for (var g = 0; g < m.length; g++) {
                            var j = m[g].editor;
                            var f = m[g].column;
                            var o = k._geteditorvalue(f, j, l, e);
                            if (o && o.label != undefined) {
                                h[f.displayfield] = o.label;
                                h[f.datafield] = o.value
                            } else {
                                h[f.displayfield] = o
                            }
                        }
                        var s = function () {
                            k.dataview._sortHierarchyData = null;
                            k.dataview._sortData = null;
                            for (var x = 0; x < m.length; x++) {
                                var B = m[x].editor;
                                var v = m[x].column;
                                var C = k._geteditorvalue(v, B, l, e);
                                var u = c[v.displayfield];
                                if (C && C.label != undefined) {
                                    t[v.displayfield] = C.label;
                                    t[v.datafield] = C.value
                                } else {
                                    t[v.displayfield] = C
                                }
                                if (k.treeGrid) {
                                    var D = k.treeGrid.getRow(e);
                                    if (D) {
                                        D[v.displayfield] = C
                                    }
                                }
                                if (k.editorsCache) {
                                    var E = function (i) {
                                        if (i && i.jqxWidget) {
                                            var G = i.jqxWidget.element.className;
                                            if (G.indexOf("dropdownlist") >= 0 || G.indexOf("datetimeinput") >= 0 || G.indexOf("combobox") >= 0 || G.indexOf("menu") >= 0) {
                                                if (i.jqxWidget.isOpened) {
                                                    var F = i.jqxWidget.isOpened();
                                                    if (F) {
                                                        i.jqxWidget.close()
                                                    }
                                                }
                                            }
                                        }
                                    };
                                    var z = "customeditor_" + v.displayfield + "_" + p;
                                    var y = "templateeditor_" + v.displayfield;
                                    if (k.editorsCache[z]) {
                                        var w = b(k.editorsCache[z]).data();
                                        var A = k.editorsCache[z];
                                        if (!w.jqxWidget && b(A).children()[0] && b(b(A).children()[0]).data().jqxWidget) {
                                            w = b(b(A).children()[0]).data()
                                        }
                                        E(w);
                                        k.editorsCache[z].detach()
                                    }
                                    if (k.editorsCache[y]) {
                                        k.editorsCache[y].detach();
                                        var w = b(k.editorsCache[y]).data();
                                        var A = k.editorsCache[y];
                                        if (!w.jqxWidget && b(A).children()[0] && b(b(A).children()[0]).data().jqxWidget) {
                                            w = b(b(A).children()[0]).data()
                                        }
                                        E(w)
                                    }
                                }
                                if (C != u) {
                                    k.beginUpdate();
                                    k._raiseEvent("cellValueChanged", {
                                        value: C,
                                        oldValue: u,
                                        dataField: v.datafield,
                                        displayField: v.displayfield,
                                        key: p,
                                        index: l,
                                        row: t
                                    });
                                    k.endUpdate(false)
                                }
                            }
                        };
                        k.updaterowbykey(k.editKey, h, false, s)
                    }
                }
                if (!d) {
                    return false
                }
            }
            k._detachEditors(e);
            return true
        }, _detachEditors: function (l) {
            var g = this;
            var m = g.rowsByKey[l];
            var i = g.getrowindex(m);
            if (g.editorsCache) {
                for (var h in g.editorsCache) {
                    var f = b(g.editorsCache[h]).data();
                    if (f && f.jqxWidget) {
                        var c = f.jqxWidget.element.className;
                        if (c.indexOf("dropdownlist") >= 0 || c.indexOf("datetimeinput") >= 0 || c.indexOf("combobox") >= 0 || c.indexOf("menu") >= 0) {
                            if (f.jqxWidget.isOpened) {
                                var e = f.jqxWidget.isOpened();
                                if (e) {
                                    f.jqxWidget.close()
                                }
                            }
                        }
                    }
                    b(g.editorsCache[h]).detach()
                }
            }
            g.beginUpdate();
            var d = g.getrowdisplayindex(m);
            if (g.editSettings.editSingleCell) {
                var m = g.rowsByKey[l];
                var k = null;
                var j = null;
                if (m) {
                    k = m[g.editColumn.datafield];
                    j = m[g.editColumn.displayfield]
                }
                g._raiseEvent("cellEndEdit", {
                    value: k,
                    displayValue: j,
                    key: l,
                    index: d,
                    dataField: g.editColumn.datafield,
                    displayField: g.editColumn.displayfield,
                    boundIndex: i,
                    row: g.rowsByKey[l]
                })
            }
            g._raiseEvent("rowEndEdit", {key: l, index: d, boundIndex: i, row: g.rowsByKey[l]});
            g.endUpdate(false);
            g.editColumn = null;
            g.editKey = null;
            g._renderrows();
            g._renderhorizontalscroll();
            g.host.focus();
            setTimeout(function () {
                g.host.focus()
            }, 10)
        }, _showvalidationpopup: function (r, e, s, m) {
            if (s == undefined) {
                var s = this.gridlocalization.validationstring
            }
            m.addClass(this.toThemeProperty("jqx-grid-validation-label"));
            var p = b("<div style='z-index: 99999; top: 0px; left: 0px; position: absolute;'></div>");
            var o = b("<div style='width: 20px; height: 20px; z-index: 999999; top: 0px; left: 0px; position: absolute;'></div>");
            p.html(s);
            o.addClass(this.toThemeProperty("jqx-grid-validation-arrow-up"));
            p.addClass(this.toThemeProperty("jqx-grid-validation"));
            p.addClass(this.toThemeProperty("jqx-rc-all"));
            p.hide();
            o.hide();
            p.prependTo(this.table);
            o.prependTo(this.table);
            var h = this.hScrollInstance;
            var j = h.value;
            var g = parseInt(j);
            var l = this.getColumn(e).uielement;
            if (!r) {
                return
            }
            var k = r;
            p.css("top", parseInt(k.position().top) + 30 + "px");
            var c = parseInt(p.css("top"));
            o.css("top", c - 11);
            o.removeClass();
            o.addClass(this.toThemeProperty("jqx-grid-validation-arrow-up"));
            var f = false;
            if (c >= this._table.height()) {
                o.removeClass(this.toThemeProperty("jqx-grid-validation-arrow-up"));
                o.addClass(this.toThemeProperty("jqx-grid-validation-arrow-down"));
                c = parseInt(k.position().top) - k.outerHeight() - 5;
                if (c < 0) {
                    c = 0;
                    o.removeClass(this.toThemeProperty("jqx-grid-validation-arrow-down"));
                    f = true
                }
                p.css("top", c + "px");
                o.css("top", c + p.outerHeight() - 9)
            }
            var n = -g + parseInt(b(l).position().left);
            var q = parseInt(this._table.css("left"));
            if (isNaN(q)) {
                q = 0
            }
            if (q != 0) {
                g = 0
            }
            o.css("left", g + n + 30);
            var d = p.width();
            if (d + n > this.host.width() - 20) {
                var i = d + n - this.host.width() + 40;
                n -= i
            }
            if (!f) {
                p.css("left", g + n)
            } else {
                p.css("left", g + parseInt(b(l).position().left) - p.outerWidth())
            }
            m.mouseenter(function () {
                if (m.hasClass("jqx-grid-validation-label")) {
                    p.show();
                    o.show()
                }
            });
            m.mouseleave(function () {
                p.hide();
                o.hide()
            });
            if (!this.popups) {
                this.popups = new Array()
            }
            this.popups[this.popups.length] = {validation: p, validationrow: o}
        }, addRow: function (d, p, j, n) {
            if (p != undefined) {
                this._datachanged = true;
                if (j == undefined) {
                    j = "last"
                }
                var o = false;
                var k = this.that;
                if (d == null) {
                    var f = this.dataview.filters && this.dataview.filters.length > 0;
                    var m = !f ? this.dataview.totalrecords : this.source.records.length;
                    if (!this.pageable) {
                        if (this.source._source.totalrecords) {
                            this.dataview.totalrecords = this.source._source.totalrecords
                        } else {
                            if (this.source._source.totalRecords) {
                                this.dataview.totalrecords = this.source._source.totalRecords
                            } else {
                                if (this.source.hierarchy.length !== 0) {
                                    this.dataview.totalrecords = this.source.hierarchy.length
                                } else {
                                    this.dataview.totalrecords = this.source.records.length
                                }
                            }
                        }
                        var m = !f ? this.dataview.totalrecords : this.source.records.length
                    }
                    if (!b.isArray(p)) {
                        d = this.dataview.getid(this.dataview.source.id, p, m);
                        if (this.getColumn(this.dataview.source.id)) {
                            p[this.dataview.source.id] = d
                        }
                    } else {
                        var c = new Array();
                        b.each(p, function (e, q) {
                            var r = k.dataview.getid(k.dataview.source.id, p[e], m + e);
                            c.push(r);
                            if (k.getColumn(k.dataview.source.id)) {
                                p[e][k.dataview.source.id] = r
                            }
                        });
                        d = c
                    }
                } else {
                    if (!b.isArray(p)) {
                        if (this.getColumn(this.dataview.source.id)) {
                            p[this.dataview.source.id] = d
                        }
                    } else {
                        b.each(p, function (e, q) {
                            var r = d[e];
                            if (k.getColumn(k.dataview.source.id)) {
                                p[e][k.dataview.source.id] = r
                            }
                        })
                    }
                }
                var i = this.treeGrid ? (this.treeGrid.virtualModeCreateRecords ? true : false) : false;
                var g = function (v, q, A, t) {
                    if (v._loading) {
                        throw new Error("jqxDataTable: " + v.loadingErrorMessage);
                        return false
                    }
                    var r = v.vScrollInstance.value;
                    var z = false;
                    if (!b.isArray(A)) {
                        A.uid = q;
                        v.rowsByKey[q] = A;
                        if (q == n) {
                            n = null
                        }
                        z = v.source.addRecord(A, t, n, i)
                    } else {
                        b.each(A, function (B, C) {
                            var D = null;
                            if (q != null && q[B] != null) {
                                D = q[B]
                            }
                            this.uid = D;
                            v.rowsByKey[D] = this;
                            if (q == n) {
                                n = null
                            }
                            z = v.source.addRecord(this, t, n, i)
                        })
                    }
                    if (v.groups && v.groups.length > 0) {
                        var w = Object.prototype.toString;
                        var y = v.groups[0];
                        Object.prototype.toString = (typeof y == "function") ? y : function () {
                            return this[y]
                        };
                        if (!v.source.records.sort) {
                            var x = new Array();
                            var u = 0;
                            var e = 0;
                            var s = [];
                            b.each(s, function () {
                                x[e + u++] = this
                            });
                            s = x
                        }
                        v.source.records.sort(function (C, B) {
                            if (C === undefined) {
                                C = null
                            }
                            if (B === undefined) {
                                B = null
                            }
                            if (C === null && B === null) {
                                return 0
                            }
                            if (C === null && B !== null) {
                                return -1
                            }
                            if (C !== null && B === null) {
                                return 1
                            }
                            var F = 0;
                            var E = 0;
                            if (C && C.uid) {
                                F = C.uid
                            }
                            if (B && B.uid) {
                                E = B.uid
                            }
                            C = C.toString();
                            B = B.toString();
                            if (b.jqx.dataFormat.isNumber(C) && b.jqx.dataFormat.isNumber(B)) {
                                if (C < B) {
                                    return -1
                                }
                                if (C > B) {
                                    return 1
                                }
                                return 0
                            } else {
                                if (b.jqx.dataFormat.isDate(C) && b.jqx.dataFormat.isDate(B)) {
                                    if (C < B) {
                                        return -1
                                    }
                                    if (C > B) {
                                        return 1
                                    }
                                    return 0
                                } else {
                                    if (!b.jqx.dataFormat.isNumber(C) && !b.jqx.dataFormat.isNumber(B)) {
                                        C = String(C).toLowerCase();
                                        B = String(B).toLowerCase()
                                    }
                                }
                            }
                            try {
                                if (C < B) {
                                    return -1
                                }
                                if (C > B) {
                                    return 1
                                }
                            } catch (D) {
                                var G = D
                            }
                            if (typeof (F) == "number") {
                                if (F < E) {
                                    return -1
                                }
                                if (F > E) {
                                    return 1
                                }
                            }
                            return 0
                        });
                        Object.prototype.toString = w
                    }
                    v.dataview._filteredData = null;
                    v.dataview._sortData = null;
                    v.dataview._sortHierarchyData = null;
                    if (v._updating == undefined || v._updating == false) {
                        v.refresh()
                    }
                    if (v.source && v.source._knockoutdatasource && !v._updateFromAdapter && v.autokoupdates) {
                        if (v.source._source._localdata) {
                            v.source.suspendKO = true;
                            v.source._source._localdata.push(A);
                            v.source.suspendKO = false
                        }
                    }
                    v.vScrollInstance.setPosition(r);
                    return z
                };
                if (this.source.addrow) {
                    var h = function (e, q) {
                        if (e == true || e == undefined) {
                            if (q != undefined) {
                                d = q
                            }
                            g(k, d, p, j)
                        }
                    };
                    try {
                        if (!k.treeGrid) {
                            o = this.source.addrow(d, p, j, h)
                        } else {
                            o = this.source.addrow(d, p, j, n, h)
                        }
                        if (o == undefined) {
                            o = true
                        }
                    } catch (l) {
                        o = false
                    }
                    if (o == false) {
                        return false
                    }
                } else {
                    g(this, d, p, j)
                }
                return o
            }
            return false
        }, deleteRow: function (c) {
            var d = this._getkey(c);
            this.deleterowbykey(d)
        }, deleterowbykey: function (g) {
            if (g != undefined) {
                this._datachanged = true;
                var h = false;
                var f = this.that;
                var d = function (m, l) {
                    if (m._loading) {
                        throw new Error("jqxDataTable: " + m.loadingErrorMessage);
                        return false
                    }
                    m.dataview._filteredData = null;
                    m.dataview._sortData = null;
                    m.dataview._sortHierarchyData = null;
                    var o = false;
                    var p = m.vScrollInstance.value;
                    if (!b.isArray(l)) {
                        var o = false;
                        if (m.rowsByKey[l]) {
                            o = true;
                            if (m.rowinfo[l] && m.rowinfo[l].selected) {
                                m.unselectrowbykey(l, false)
                            }
                            if (m.treeGrid) {
                                var n = m._names();
                                var k = m.rowsByKey[l][n.parent]
                            }
                            delete m.rowsByKey[l];
                            if (m.treeGrid) {
                                if (m.rowinfo[l]) {
                                    var i = m.rowinfo[l].row.records;
                                    var j = function (q) {
                                        for (var r = 0; r < q.length; r++) {
                                            var s = q[r].uid;
                                            delete m.rowsByKey[s];
                                            delete m.rowinfo[s];
                                            if (q[r].records) {
                                                j(q[r].records)
                                            }
                                        }
                                    };
                                    if (i) {
                                        j(i)
                                    }
                                }
                            }
                            delete m.rowinfo[l];
                            m.source.deleteRecord(l);
                            if (k) {
                                if (n && k.records && k.records.length == 0) {
                                    k[n.leaf] = true;
                                    m.rowinfo[k.uid][n.leaf] = true
                                }
                            }
                        }
                    } else {
                        b.each(l, function () {
                            var t = this;
                            if (m.rowsByKey[t]) {
                                o = true;
                                if (m.rowinfo[t].selected) {
                                    m.unselectrowbykey(t, false)
                                }
                                if (m.treeGrid) {
                                    var u = m._names();
                                    var s = m.rowsByKey[t][u.parent]
                                }
                                delete m.rowsByKey[t];
                                if (m.treeGrid) {
                                    if (m.rowinfo[t]) {
                                        var q = m.rowinfo[t].row.records;
                                        var r = function (v) {
                                            for (var w = 0; w < v.length; w++) {
                                                var x = v[w].uid;
                                                delete m.rowsByKey[x];
                                                delete m.rowinfo[x];
                                                if (v[w].records) {
                                                    r(v[w].records)
                                                }
                                            }
                                        };
                                        if (q) {
                                            r(q);
                                            delete m.rowinfo[t]
                                        }
                                    }
                                }
                                m.source.deleteRecord(t);
                                if (s) {
                                    if (u && s.records && s.records.length == 0) {
                                        s[u.leaf] = true;
                                        m.rowinfo[s.uid][u.leaf] = true
                                    }
                                }
                            }
                        })
                    }
                    m.refresh();
                    if (m.source && m.source._knockoutdatasource && !m._updateFromAdapter && m.autokoupdates) {
                        if (m.source._source._localdata) {
                            m.source.suspendKO = true;
                            m.source._source._localdata.pop();
                            m.source.suspendKO = false
                        }
                    }
                    m.vScrollInstance.setPosition(p);
                    return o
                };
                if (this.source.deleterow) {
                    var c = function (i) {
                        if (i == true || i == undefined) {
                            d(f, g)
                        }
                    };
                    try {
                        this.source.deleterow(g, c);
                        if (h == undefined) {
                            h = true
                        }
                    } catch (e) {
                        h = false
                    }
                } else {
                    h = d(f, g)
                }
                return h
            }
            return false
        }, updateRow: function (c, e) {
            var d = this._getkey(c);
            this.updaterowbykey(d, e)
        }, updaterowbykey: function (c, k, g, i) {
            if (c != undefined && k != undefined) {
                var f = this.that;
                var j = false;
                var d = function (o, l, t) {
                    if (o._loading) {
                        throw new Error("jqxDataTable: " + o.loadingErrorMessage);
                        return false
                    }
                    o.dataview._filteredData = null;
                    o.dataview._sortData = null;
                    o.dataview._sortHierarchyData = null;
                    var r = false;
                    if (!b.isArray(l)) {
                        var n = o.rowsByKey[l];
                        var s = function (v) {
                            if (!v) {
                                r = false
                            } else {
                                for (var u = 0; u < o.columns.records.length; u++) {
                                    v[o.columns.records[u].datafield] = t[o.columns.records[u].datafield];
                                    if (o.groups.length > 0 && v.originalRecord) {
                                        v.originalRecord[o.columns.records[u].datafield] = t[o.columns.records[u].datafield]
                                    }
                                }
                                r = true
                            }
                        };
                        s(n);
                        if (o.treeGrid) {
                            n = o.treeGrid.getRow(l);
                            s(n)
                        }
                    } else {
                        b.each(l, function (w, x) {
                            var v = o.rowsByKey[this];
                            var u = function (z, y) {
                                if (!v) {
                                    r = false
                                } else {
                                    v[this] = t[w]
                                }
                                r = true
                            };
                            u(this, v);
                            if (o.treeGrid) {
                                v = o.treeGrid.getRow(this);
                                u(this, v)
                            }
                        })
                    }
                    var m = o.vScrollInstance.value;
                    if (g == undefined || g == true) {
                        if (o._updating == undefined || o._updating == false) {
                            o._renderrows()
                        }
                    }
                    if (o.showAggregates && o._updatecolumnsaggregates) {
                        o._updatecolumnsaggregates()
                    }
                    if (o.source && o.source._knockoutdatasource && !o._updateFromAdapter && o.autokoupdates) {
                        if (o.source._source._localdata) {
                            var n = o.rowsByKey[l];
                            var p = o.getrowindex(n);
                            var q = o.source._source._localdata()[p];
                            o.source.suspendKO = true;
                            o.source._source._localdata.replace(q, b.extend({}, n));
                            o.source.suspendKO = false
                        }
                    }
                    o.vScrollInstance.setPosition(m);
                    return r
                };
                if (this.source.updaterow) {
                    var e = function (l) {
                        if (l == true || l == undefined) {
                            d(f, c, k);
                            if (i) {
                                i()
                            }
                            f._renderrows(false);
                            if (f.autoRowHeight) {
                                f._updateScrollbars();
                                f._arrange()
                            }
                        }
                    };
                    try {
                        j = this.source.updaterow(c, k, e);
                        if (j == undefined) {
                            j = true
                        }
                    } catch (h) {
                        j = false
                    }
                } else {
                    j = d(f, c, k);
                    if (j && i) {
                        i()
                    }
                    f._renderrows(false);
                    if (f.autoRowHeight) {
                        f._updateScrollbars();
                        f._arrange()
                    }
                }
                return j
            }
            return false
        }, lockRow: function (c) {
            var d = this._getkey(c);
            this.lockrowbykey(d)
        }, unlockRow: function (c) {
            var d = this._getkey(c);
            this.unlockrowbykey(d)
        }, lockrowbykey: function (c) {
            if (this.rowinfo[c]) {
                this.rowinfo[c].locked = true
            } else {
                this.rowinfo[c] = {locked: true}
            }
            this._renderrows()
        }, unlockrowbykey: function (c) {
            if (this.rowinfo[c]) {
                this.rowinfo[c].locked = false
            } else {
                this.rowinfo[c] = {locked: false}
            }
            this._renderrows()
        }, selectRow: function (c) {
            var d = this._getkey(c);
            this.selectrowbykey(d)
        }, unselectRow: function (c) {
            var d = this._getkey(c);
            this.unselectrowbykey(d)
        }, selectrowbykey: function (e, h, f) {
            if (h != "keyboard" && h != "mouse") {
                this._lastSelectedKey = e
            }
            var g = f !== false ? true : false;
            this._doSelection(e, true, g);
            var i = this.rowsByKey[e];
            var d = this.getrowindex(i);
            var c = this.getrowdisplayindex(i);
            this._raiseEvent("rowSelect", {key: e, index: c, boundIndex: d, row: this.rowsByKey[e]})
        }, unselectrowbykey: function (e, f) {
            var g = f !== false ? true : false;
            this._doSelection(e, false, g);
            var h = this.rowsByKey[e];
            var d = this.getrowindex(h);
            var c = this.getrowdisplayindex(h);
            this._raiseEvent("rowUnselect", {key: e, index: c, boundIndex: d, row: this.rowsByKey[e]})
        }, getSelection: function () {
            var c = new Array();
            if (this.rowinfo) {
                for (var e in this.rowinfo) {
                    var d = this.rowinfo[e];
                    if (d.selected) {
                        c.push(d.row)
                    }
                }
            }
            return c
        }, showdetailsbykey: function (k) {
            if (!this.rowDetails) {
                return
            }
            var l = this.rowinfo[k];
            if (l) {
                l.expanded = true;
                var f = b(this._table.children()[1]).children(("[data-key=" + k + "]"));
                var i = b(this._pinnedTable.children()[1]).children(("[data-key=" + k + "]"));
                if (f) {
                    var c = i.children();
                    var h = b(c[0]);
                    if (this.rtl) {
                        var h = b(c[c.length - 1])
                    }
                    if (!this.rtl) {
                        h.removeClass(this.toThemeProperty("jqx-grid-group-collapse"));
                        h.addClass(this.toThemeProperty("jqx-grid-group-expand"));
                        h.removeClass(this.toThemeProperty("jqx-icon-arrow-right"));
                        h.addClass(this.toThemeProperty("jqx-icon-arrow-down"))
                    } else {
                        h.removeClass(this.toThemeProperty("jqx-grid-group-collapse-rtl"));
                        h.addClass(this.toThemeProperty("jqx-grid-group-expand-rtl"));
                        h.removeClass(this.toThemeProperty("jqx-icon-arrow-left"));
                        h.addClass(this.toThemeProperty("jqx-icon-arrow-down"))
                    }
                    f.next().show();
                    var d = i.next();
                    d.show();
                    if (b.jqx.browser.msie && b.jqx.browser.version < 8) {
                        f.next().children().show();
                        i.next().children().show()
                    }
                    if (!l.initialized) {
                        var j = l.detailsHeight;
                        var m = this.initRowDetails(k, l.row, b(b(d).children().children().children()[0]), l);
                        l.details = b(d).children().children().children()[0];
                        l.initialized = true;
                        if (m === false || l.detailsHeight != j) {
                            if (m === false) {
                                l.expanded = false;
                                l.nodetails = true;
                                d.hide()
                            }
                            this._renderrows()
                        }
                    }
                    this._updateScrollbars();
                    if (this.height === "auto" || this.height === null || this.autoheight) {
                        this._arrange()
                    }
                    var g = this.getrowindex(l.row);
                    var e = this.getrowdisplayindex(l.row);
                    this._raiseEvent("rowExpand", {row: l.row, index: e, boundIndex: g, rowKey: k})
                }
            }
        }, hidedetailsbykey: function (h) {
            if (!this.rowDetails) {
                return
            }
            var j = this.rowinfo[h];
            if (j) {
                j.expanded = false;
                var d = b(this._table.children()[1]).children(("[data-key=" + h + "]"));
                var e = b(this._pinnedTable.children()[1]).children(("[data-key=" + h + "]"));
                if (d) {
                    var g = e.children();
                    var i = b(g[0]);
                    if (this.rtl) {
                        var i = b(g[g.length - 1])
                    }
                    if (!this.rtl) {
                        i.addClass(this.toThemeProperty("jqx-grid-group-collapse"));
                        i.removeClass(this.toThemeProperty("jqx-grid-group-expand"));
                        i.addClass(this.toThemeProperty("jqx-icon-arrow-right"));
                        i.removeClass(this.toThemeProperty("jqx-icon-arrow-down"))
                    } else {
                        i.addClass(this.toThemeProperty("jqx-grid-group-collapse-rtl"));
                        i.removeClass(this.toThemeProperty("jqx-grid-group-expand-rtl"));
                        i.addClass(this.toThemeProperty("jqx-icon-arrow-left"));
                        i.removeClass(this.toThemeProperty("jqx-icon-arrow-down"))
                    }
                    d.next().hide();
                    e.next().hide();
                    if (b.jqx.browser.msie && b.jqx.browser.version < 8) {
                        d.next().children().hide();
                        e.next().children().hide()
                    }
                    this._updateScrollbars();
                    if (this.height === "auto" || this.height === null || this.autoheight) {
                        this._arrange()
                    }
                    var f = this.getrowindex(j.row);
                    var c = this.getrowdisplayindex(j.row);
                    this._raiseEvent("rowCollapse", {row: j.row, index: c, boundIndex: f, rowKey: h})
                }
            }
        }, _getvirtualcolumnsindexes: function (d, l, h, k, c) {
            if (this.rowDetails || this.rtl || this.editcell || (this.width && this.width.toString().indexOf("%") >= 0) || this.exporting) {
                return {start: 0, end: h + k}
            }
            var e = 0;
            var i = -1;
            var f = h + k;
            if (this.autorowheight) {
                return {start: 0, end: h + k}
            }
            if (!c) {
                for (var g = 0; g < h + k; g++) {
                    var m = g;
                    if (!this.columns.records[g].hidden) {
                        e += this.columns.records[g].width
                    }
                    if (e >= d && i == -1) {
                        i = g
                    }
                    if (e > l + d) {
                        f = g;
                        break
                    }
                }
            }
            f++;
            if (f > h + k) {
                f = h + k
            }
            if (i == -1) {
                i = 0
            }
            return {start: i, end: f}
        }, _renderhorizontalscroll: function () {
            var t = this.hScrollInstance;
            var u = t.value;
            if (this.hScrollBar.css("visibility") === "hidden") {
                t.value = 0;
                u = 0
            }
            var h = parseInt(u);
            if (this.table == null) {
                return
            }
            var q = this.columnsrow;
            var r = 0;
            var i = this.columns.records.length - r;
            var e = this.columns.records;
            var l = this.source.records.length == 0;
            if (this.rtl) {
                if (this.hScrollBar.css("visibility") != "hidden") {
                    h = t.max - h
                }
            }
            if (l && !this._haspinned) {
                this.table[0].style.left = -h + "px";
                q[0].style.marginLeft = -h + "px"
            } else {
                if (this._haspinned || this._haspinned == undefined) {
                    for (var w = 0; w < r + i; w++) {
                        var f = e[w];
                        if (f.pinned) {
                            var g = null;
                            if (this.showAggregates) {
                                if (this.statusbar[0].cells) {
                                    g = this.statusbar[0].cells[w]
                                }
                            }
                            if (this.filterrow) {
                                if (this.filterrow[0].cells) {
                                    var x = this.filterrow[0].cells[w]
                                }
                            }
                            if (!this.rtl) {
                                var c = q[0].cells[w];
                                c.style.marginLeft = h + "px";
                                if (g) {
                                    g.style.marginLeft = h + "px"
                                }
                                if (this.filterrow && x) {
                                    x.style.marginLeft = h + "px"
                                }
                            } else {
                                var c = q[0].cells[w];
                                c.style.marginLeft = -parseInt(u) + "px";
                                if (g) {
                                    g.style.marginLeft = -parseInt(u) + "px"
                                }
                                if (this.filterrow && x) {
                                    x.style.marginLeft = -parseInt(u) + "px"
                                }
                            }
                        }
                    }
                    if (this.columnsVirtualization) {
                        var s = this._getvirtualcolumnsindexes(h, this.host.width(), 0, this.columns.records.length, false);
                        var n = s.start;
                        var p = s.end;
                        for (var o = 0; o < n; o++) {
                            var m = o;
                            var v = this.columns.records[m].element[0];
                            if (this.columns.records[m].pinned) {
                                continue
                            }
                            if (v.parentNode) {
                                v.parentNode.removeChild(v)
                            }
                            if (this.filterrow && this.filterrow[0]) {
                                var d = this.filterrow[0].cells[m];
                                if (d.parentNode) {
                                    d.parentNode.removeChild(d)
                                }
                            }
                        }
                        for (var o = p; o < this.columns.records.length; o++) {
                            var m = o;
                            var v = this.columns.records[m].element[0];
                            if (this.columns.records[m].pinned) {
                                continue
                            }
                            if (v.parentNode) {
                                v.parentNode.removeChild(v)
                            }
                            if (this.filterrow && this.filterrow[0]) {
                                var d = this.filterrow[0].cells[m];
                                if (d.parentNode) {
                                    d.parentNode.removeChild(d)
                                }
                            }
                        }
                        for (var o = n; o < p; o++) {
                            var m = o;
                            v = this.columns.records[m].element[0];
                            if (this.columns.records[m].pinned) {
                                continue
                            }
                            if (!v.parentNode) {
                                this.columnsrow[0].appendChild(v)
                            }
                            if (this.filterrow && this.filterrow[0]) {
                                var d = this.filterrow[0].cells[m];
                                if (!d.parentNode) {
                                    this.filterrow[0].appendChild(d)
                                }
                            }
                        }
                    }
                    this._table[0].style.left = -h + "px";
                    q[0].style.marginLeft = -h + "px"
                } else {
                    if (this._haspinned == false) {
                        if (this.columnsVirtualization) {
                            var s = this._getvirtualcolumnsindexes(h, this.host.width(), 0, this.columns.records.length, false);
                            var n = s.start;
                            var p = s.end;
                            for (var o = 0; o < n; o++) {
                                var m = o;
                                var v = this.columns.records[m].element[0];
                                if (v.parentNode) {
                                    v.parentNode.removeChild(v)
                                }
                                if (this.filterrow && this.filterrow[0]) {
                                    var d = this.filterrow[0].cells[m];
                                    if (d.parentNode) {
                                        d.parentNode.removeChild(d)
                                    }
                                }
                            }
                            for (var o = p; o < this.columns.records.length; o++) {
                                var m = o;
                                var v = this.columns.records[m].element[0];
                                if (v.parentNode) {
                                    v.parentNode.removeChild(v)
                                }
                                if (this.filterrow && this.filterrow[0]) {
                                    var d = this.filterrow[0].cells[m];
                                    if (d.parentNode) {
                                        d.parentNode.removeChild(d)
                                    }
                                }
                            }
                            for (var o = n; o < p; o++) {
                                var m = o;
                                v = this.columns.records[m].element[0];
                                if (!v.parentNode) {
                                    this.columnsrow[0].appendChild(v)
                                }
                                if (this.filterrow && this.filterrow[0]) {
                                    var d = this.filterrow[0].cells[m];
                                    if (!d.parentNode) {
                                        this.filterrow[0].appendChild(d)
                                    }
                                }
                            }
                        }
                        this.table[0].style.left = -h + "px";
                        q[0].style.marginLeft = -h + "px"
                    }
                }
                if (this.filterrow) {
                    this.filterrow[0].style.left = -h + "px";
                    if (this.rtl) {
                        this.filterrow[0].style.left = -h + parseInt(this.content.css("left")) + "px"
                    }
                }
            }
            if (this.showAggregates) {
                if (this.aggregates[0].cells) {
                    var k = 0;
                    if (this.rtl) {
                        if (this.vScrollBar.css("visibility") != "hidden") {
                            if (this.hScrollBar.css("visibility") != "hidden") {
                                k = 2 + parseInt(this.hScrollBar.css("left"))
                            } else {
                                k = 3 + parseInt(this.vScrollBar.width())
                            }
                        }
                    }
                    this.aggregates[0].style.marginLeft = -h + k + "px"
                }
            }
        }, _initializeColumns: function () {
            var d = this.source.datafields;
            if (d == null && this.source._source) {
                d = this.source._source.datafields
            }
            var k = d ? d.length > 0 : false;
            if (this.columns && this.columns.records) {
                for (var e = 0; e < this.columns.records.length; e++) {
                    this._removecolumnhandlers(this.columns.records[e])
                }
            }
            var j = this;
            var c = new b.jqx.dataCollection(this.element);
            var h = 0;
            this._haspinned = false;
            if (!this._columns) {
                this._columns = this.columns
            } else {
                this.columns = this._columns
            }
            if (this.selectionMode == "checkbox") {
                var f = new a(j, this);
                f.visibleindex = h++;
                f.width = j.indentWidth;
                f.checkboxcolumn = true;
                f.editable = false;
                f.columntype = "checkbox";
                f.groupable = false;
                f.draggable = false;
                f.filterable = false;
                f.resizable = false;
                f.datafield = "_checkboxcolumn";
                c.add(f)
            }
            if (this.rowDetails && !this.treeGrid) {
                var f = new a(j, this);
                f.visibleindex = h++;
                f.width = j.indentWidth;
                f.editable = false;
                f.rowDetailscolumn = true;
                f.groupable = false;
                f.draggable = false;
                f.pinned = true;
                f.filterable = false;
                f.resizable = false;
                f.text = "";
                c.add(f)
            }
            var g = new Array();
            b.each(this.columns, function (i) {
                if (j.columns[i] != undefined) {
                    var l = new a(j, this);
                    l.visibleindex = h++;
                    if (this.dataField != undefined) {
                        this.datafield = this.dataField
                    }
                    if (this.pinned) {
                        j._haspinned = true
                    }
                    if (this.datafield == null) {
                        if (j.source && j.source._source && (j.source._source.datatype == "array")) {
                            if (!k) {
                                if (!j.source._source.datafields) {
                                    j.source._source.datafields = new Array();
                                    j.source._source.datafields.push({name: i.toString()})
                                } else {
                                    j.source._source.datafields.push({name: i.toString()})
                                }
                            }
                            this.datafield = i.toString();
                            this.displayfield = i.toString();
                            l.datafield = this.datafield;
                            l.displayfield = this.displayfield
                        }
                    } else {
                        if (g[this.datafield]) {
                            throw new Error("jqxDataTable: Invalid column 'dataField' setting. jqxDataTable's columns should be initialized with unique data fields.");
                            j.host.remove();
                            return false
                        } else {
                            g[this.datafield] = true
                        }
                    }
                    c.add(l)
                }
            });
            if (this.rtl) {
                c.records.reverse()
            }
            this.columns = c
        }, addFilter: function (c, e) {
            var d = this.getColumn(c);
            if (!d) {
                return
            }
            this.dataview.addFilter(c, e)
        }, removeFilter: function (c) {
            var d = this.getColumn(c);
            if (!d) {
                return
            }
            this.dataview.removeFilter(c)
        }, clearFilters: function (d, c) {
            this.dataview.filters = new Array();
            this.dataview._filteredData = null;
            this.dataview._sortData = null;
            this.dataview._sortHierarchyData = null;
            if (c !== false) {
                this.resetfilter()
            }
            if (d === false) {
                return
            }
            this.applyFilters()
        }, resetfilter: function () {
            if (this.filterinput) {
                this.filterinput.val("")
            }
            if (this.filterrow) {
                for (var f = 0; f < this.filterrow[0].cells.length; f++) {
                    var m = this.filterrow[0].cells[f];
                    var l = b(m).find("input:first");
                    var j = b(m).find(".filterconditions");
                    var e = this.columns.records[f];
                    var d = "";
                    if (!e.filterable) {
                        continue
                    }
                    l.val("");
                    var g = this.getcolumntypebydatafield(e);
                    var c = new b.jqx.filter();
                    var h, k;
                    switch (g) {
                        case"number":
                        case"int":
                        case"float":
                        case"decimal":
                            h = "numericfilter";
                            k = c.getoperatorsbyfiltertype("numericfilter");
                            break;
                        case"boolean":
                        case"bool":
                            h = "booleanfilter";
                            k = c.getoperatorsbyfiltertype("booleanfilter");
                            break;
                        case"date":
                        case"time":
                            h = "datefilter";
                            k = c.getoperatorsbyfiltertype("datefilter");
                            break;
                        case"string":
                            h = "stringfilter";
                            k = c.getoperatorsbyfiltertype("stringfilter");
                            break
                    }
                    if (j.length > 0) {
                        if (h === "stringfilter") {
                            j.jqxDropDownList({selectedIndex: 2})
                        } else {
                            j.jqxDropDownList({selectedIndex: 0})
                        }
                    }
                }
            }
        }, applyFilters: function () {
            if (this.editable) {
                if (this.editKey != null) {
                    var c = this.endroweditbykey(this.editKey)
                }
            }
            this.dataview._filteredData = null;
            this.dataview._sortData = null;
            this.dataview._sortHierarchyData = null;
            if (this.serverProcessing) {
                this.dataview.pagenum = 0;
                this.updateBoundData("filter")
            } else {
                this.goToPage(0);
                this.refresh()
            }
            if (arguments && arguments.length > 0) {
                if (this._updateSimpleFilter) {
                    if (this.filtercolumnsList) {
                        var d = this.filtercolumnsList.jqxDropDownList("getSelectedItem").value;
                        this._updateSimpleFilter(d)
                    }
                }
                if (this._updateFilterRow) {
                    this._updateFilterRow()
                }
            }
            this._raiseEvent("filter", {filters: this.dataview.filters})
        }, sortBy: function (d, g) {
            this.dataview._filteredData = null;
            this.dataview._sortData = null;
            this.dataview._sortHierarchyData = null;
            if (this._loading) {
                throw new Error("jqxDataTable: " + this.loadingErrorMessage);
                return false
            }
            if (this.editable) {
                if (this.editKey != null) {
                    var c = this.endroweditbykey(this.editKey)
                }
            }
            if (d == null) {
                g = null;
                d = this.sortcolumn
            }
            if (d) {
                var f = this;
                var e;
                if (g == "a" || g == "asc" || g == "ascending" || g == true) {
                    e = true
                } else {
                    e = false
                }
                if (g != null) {
                    f.sortdirection = {ascending: e, descending: !e}
                } else {
                    f.sortdirection = {ascending: false, descending: false}
                }
                if (g != null) {
                    f.sortcolumn = d
                } else {
                    f.sortcolumn = null
                }
                if (f.source.sort) {
                    f.dataview.sortfield = d;
                    if (g == null) {
                        f.dataview.sortfielddirection = ""
                    } else {
                        f.dataview.sortfielddirection = e ? "asc" : "desc"
                    }
                    if (f.source.sort && !this._loading) {
                        f.source.sort(d, g)
                    }
                }
                f.dataview.sortBy(d, g);
                f._raiseEvent("sort", {sortcolumn: this.sortcolumn, sortdirection: this.sortdirection})
            }
            if (!this.serverProcessing) {
                this.refresh()
            } else {
                this.updateBoundData("sort")
            }
        }, _togglesort: function (d) {
            var f = this;
            if (this.disabled) {
                return
            }
            if (d.sortable && f.sortable) {
                var c = {sortcolumn: this.sortcolumn, sortdirection: this.sortdirection};
                var e = null;
                if (c.sortcolumn != null && c.sortcolumn == d.displayfield) {
                    e = c.sortdirection.ascending;
                    if (e == true) {
                        e = false
                    } else {
                        e = null
                    }
                } else {
                    e = true
                }
                f.sortBy(d.displayfield, e)
            }
        }, _renderfilter: function () {
            var h = this;
            var j = b("<div style='position: relative; margin: 4px;'><input style='width: 200px; height: 22px; direction: ltr;' role='textbox' type='text'/><div style='cursor: pointer; height: 100%;'><div></div></div></div>");
            j.height(22);
            var o = j.find("input");
            var g = j.find("div:first");
            j.addClass(this.toThemeProperty("jqx-rc-all"));
            j.addClass(this.toThemeProperty("jqx-widget"));
            j.addClass(this.toThemeProperty("jqx-input-group"));
            o.addClass(this.toThemeProperty("jqx-input"));
            o.addClass(this.toThemeProperty("jqx-rc-l"));
            o.addClass(this.toThemeProperty("jqx-input-group-addon"));
            o.addClass(this.toThemeProperty("jqx-widget"));
            o.addClass(this.toThemeProperty("jqx-widget-content"));
            g.addClass(this.toThemeProperty("jqx-fill-state-normal"));
            g.addClass(this.toThemeProperty("jqx-rc-r"));
            g.addClass(this.toThemeProperty("jqx-input-group-addon"));
            g.find("div").addClass(this.toThemeProperty("jqx-icon-search"));
            if (this.rtl) {
                o.addClass(this.toThemeProperty("jqx-rtl"));
                o.css("direction", "rtl")
            }
            this.filter.children().remove();
            this.filterbutton = g;
            var d = new Array();
            for (var f = 0; f < h.columns.records.length; f++) {
                if (h.columns.records[f].datafield && h.columns.records[f].filterable) {
                    d.push({label: h.columns.records[f].text, value: h.columns.records[f].displayfield})
                }
            }
            var p = d.length < 10 ? true : false;
            var l = b("<div style='position: relative; top: 50%; display: none; margin-right: 4px; margin-left: 4px; float: left;'>" + this.gridlocalization.filtersearchstring + "</div>");
            this.filter.append(l);
            var c = b("<div class='filtercolumns' style='position: relative; margin: 4px; float: left;'></div>");
            this.filter.append(c);
            if (c.jqxDropDownList) {
                c.jqxDropDownList({
                    theme: this.theme,
                    enableBrowserBoundsDetection: true,
                    autoDropDownHeight: p,
                    rtl: h.rtl,
                    dropDownWidth: 220,
                    selectedIndex: 0,
                    width: "auto",
                    height: 20,
                    source: d,
                    displayMember: "label",
                    valueMember: "value"
                })
            }
            this.filtercolumnsList = c;
            var n = function (q) {
                h.filterinput.val("");
                for (var r = 0; r < h.dataview.filters.length; r++) {
                    var s = h.dataview.filters[r];
                    if (s.datafield === q) {
                        h.filterinput.val(s.filter.getfilterat(0).filtervalue)
                    }
                }
            };
            if (h.filterHeight !== 35) {
                h.filtercolumnsList.css("margin-top", h.filterHeight / 2 - 10);
                j.css("margin-top", h.filterHeight / 2 - 10)
            }
            h._updateSimpleFilter = n;
            this.addHandler(c, "select", function (q) {
                var i = q.args.item.value;
                n(i)
            });
            if (this.filterMode === "simple") {
                this.filtercolumnsList.hide();
                l.show();
                l.css("margin-top", -this.filter.height() / 2);
                j.css("float", "left")
            } else {
                this.filtercolumnsList.show();
                l.hide()
            }
            var m = function () {
                if (!g.hasClass("jqx-fill-state-disabled")) {
                    var r = o.val();
                    if (c.jqxDropDownList) {
                        var u = c.jqxDropDownList("getSelectedItem")
                    }
                    var w = function (B, x, i) {
                        var A = new b.jqx.filter();
                        var z = h.getcolumntypebydatafield(B);
                        var C = h._getfiltertype(z);
                        if (C == "datefilter") {
                            var y = A.createfilter(C, x, "EQUAL", null, B.cellsFormat, h.gridlocalization)
                        } else {
                            if (C == "numericfilter" || C == "booleanfilter") {
                                if (C == "numericfilter") {
                                    if (h.gridlocalization.decimalseparator == ",") {
                                        if (x.indexOf(h.gridlocalization.decimalseparator) >= 0) {
                                            x = x.replace(h.gridlocalization.decimalseparator, ".")
                                        }
                                    }
                                    if (x.indexOf(h.gridlocalization.currencysymbol) >= 0) {
                                        x = x.replace(h.gridlocalization.currencysymbol, "")
                                    }
                                    if (x.indexOf(h.gridlocalization.percentagesymbol) >= 0) {
                                        x = x.replace(h.gridlocalization.percentagesymbol, "")
                                    }
                                }
                                var y = A.createfilter(C, x, "EQUAL", null, B.cellsFormat, h.gridlocalization)
                            } else {
                                var y = A.createfilter(C, x, "CONTAINS")
                            }
                        }
                        A.operator = i;
                        A.addfilter(0, y);
                        return A
                    };
                    if (h.filterMode !== "simple") {
                        if (u) {
                            var v = u.value;
                            var t = h.getColumn(v);
                            var s = w(t, r, "and");
                            if (r.length > 0) {
                                h.removeFilter(v);
                                h.addFilter(v, s);
                                h.applyFilters()
                            } else {
                                h.removeFilter(v);
                                h.applyFilters()
                            }
                            if (h.filterMode === "advanced") {
                                if (h._updateFilterRow) {
                                    h._updateFilterRow(true)
                                }
                            }
                        }
                    } else {
                        h.clearFilters(false, false);
                        if (r.length > 0) {
                            for (var q = 0; q < h.columns.records.length; q++) {
                                var t = h.columns.records[q];
                                var s = w(t, r, "or");
                                h.addFilter(t.datafield, s)
                            }
                        }
                        h.applyFilters()
                    }
                    if (h.dataview.filters.length == 0) {
                        h.filtericon.fadeOut(200)
                    } else {
                        h.filtericon.fadeIn(200)
                    }
                }
            };
            o.keydown(function (i) {
                if (i.keyCode === 13) {
                    m();
                    if (i.preventDefault) {
                        i.preventDefault()
                    }
                    return false
                }
            });
            g.click(function () {
                m()
            });
            this.filterinput = o;
            this.filter.append(j);
            if (this.filterMode == "advanced") {
                var e = b("<a style='float: left; position: relative; margin: 2px; margin-left: 10px;' href='#'>" + this.gridlocalization.filterstring + "</a>");
                j.append(e);
                this.addHandler(e, "click", function (q) {
                    var i = function (u) {
                        if (h.filterrow) {
                            for (var x = 0; x < h.filterrow[0].cells.length; x++) {
                                var t = h.filterrow[0].cells[x];
                                var v = b(t).find("input:first");
                                var z = h.columns.records[x];
                                if (!z.filterable) {
                                    continue
                                }
                                if (u === true) {
                                    v.val("")
                                }
                                for (var w = 0; w < h.dataview.filters.length; w++) {
                                    var y = h.dataview.filters[w];
                                    if (y.datafield === z.displayfield) {
                                        v.val(y.filter.getfilterat(0).filtervalue);
                                        break
                                    }
                                }
                            }
                        }
                    };
                    var s = function (v) {
                        if (h.filterrow) {
                            var u = 0;
                            for (var x = 0; x < h.filterrow[0].cells.length; x++) {
                                var t = h.filterrow[0].cells[x];
                                var w = b(t).find("input:first");
                                var y = h.columns.records[x];
                                if (y.hidden) {
                                    t.style.visibility = "hidden"
                                } else {
                                    t.style.visibility = "inherit"
                                }
                                if (!y.filterable) {
                                    continue
                                }
                                t.style.left = parseInt(u) + parseInt(y.uielement[0].style.left) + "px";
                                t.style.width = 6 + y.width + "px";
                                if (w[0]) {
                                    w[0].style.width = y.width - 6 - 22 + "px"
                                }
                            }
                        }
                    };
                    h._updateFilterRow = i;
                    h._arrangeFilterRow = s;
                    var r = function () {
                        h.filtercolumnsList.jqxDropDownList({disabled: true});
                        h.filterinput.addClass(h.toThemeProperty("jqx-fill-state-disabled"));
                        h.filterinput.attr("disabled", true);
                        h.filterbutton.addClass(h.toThemeProperty("jqx-fill-state-disabled"))
                    };
                    if (h.filter.find(".filterrow").length === 0) {
                        h._renderadvancedfilter();
                        r();
                        i();
                        h._arrange();
                        s()
                    } else {
                        if (h.filter.find(".filterrow").css("display") === "none") {
                            r();
                            h.filter.find(".filterrow").removeClass("filterrow-hidden");
                            i();
                            h.filter.find(".filterrow").show();
                            s()
                        } else {
                            h.filtercolumnsList.jqxDropDownList({disabled: false});
                            h.filterinput.removeClass(h.toThemeProperty("jqx-fill-state-disabled"));
                            h.filterinput.attr("disabled", false);
                            h.filterbutton.removeClass(h.toThemeProperty("jqx-fill-state-disabled"));
                            n(h.filtercolumnsList.jqxDropDownList("getSelectedItem").value);
                            h.filter.find(".filterrow").addClass("filterrow-hidden");
                            h.filter.find(".filterrow").hide()
                        }
                        h._arrange()
                    }
                    return false
                })
            }
            var k = b("<div style='float: left; width: 16px; height: 16px; position: relative; margin: 3px;'></div>");
            k.attr("title", h.gridlocalization.filterclearstring);
            k.addClass(h.toThemeProperty("jqx-icon-close"));
            j.append(k);
            k.hide();
            h.filtericon = k;
            k.click(function () {
                h.clearFilters();
                h.filtericon.fadeOut(200)
            });
            if (h.dataview.filters.length > 0) {
                if (h.filterMode != "advanced") {
                    n(h.dataview.filters[0].datafield)
                } else {
                    if (h._updateFilterRow) {
                        h._updateFilterRow()
                    }
                }
            }
        }, _renderadvancedfilter: function () {
            var h = this;
            var c = function () {
                h.clearFilters(false, false);
                var n = h.filtercolumnsList.jqxDropDownList("getSelectedItem").value;
                var p = h.filterinput.val();
                for (var m = 0; m < h.filterrow[0].cells.length; m++) {
                    var v = h.filterrow[0].cells[m];
                    var u = b(v).find("input:first");
                    var r = b(v).find(".filterconditions");
                    var l = h.columns.records[m];
                    var k = "";
                    if (!l.filterable) {
                        continue
                    }
                    if (l.displayfield === n) {
                        h.filterinput.val(u.val())
                    }
                    var q, t;
                    var o = h.getcolumntypebydatafield(l);
                    var j = new b.jqx.filter();
                    switch (o) {
                        case"number":
                        case"int":
                        case"float":
                        case"decimal":
                            q = "numericfilter";
                            t = j.getoperatorsbyfiltertype("numericfilter");
                            break;
                        case"boolean":
                        case"bool":
                            q = "booleanfilter";
                            t = j.getoperatorsbyfiltertype("booleanfilter");
                            break;
                        case"date":
                        case"time":
                            q = "datefilter";
                            t = j.getoperatorsbyfiltertype("datefilter");
                            break;
                        case"string":
                            q = "stringfilter";
                            t = j.getoperatorsbyfiltertype("stringfilter");
                            break
                    }
                    if (r.length == 0) {
                        if (q === "stringfilter") {
                            k = t[2]
                        } else {
                            k = t[0]
                        }
                    } else {
                        var y = r.jqxDropDownList("getSelectedItem");
                        if (y) {
                            k = t[y.index]
                        } else {
                            if (q === "stringfilter") {
                                k = t[2]
                            } else {
                                k = t[0]
                            }
                        }
                    }
                    var w = u.val();
                    if (w.length > 0 || (w.length == 0 && k == "NOT_NULL") || (w.length == 0 && k == "NOT_EMPTY") || (w.length == 0 && k == "EMPTY") || (w.length == 0 && k == "NULL")) {var s = l.displayfield;
                        var x = new b.jqx.filter();
                        if (q == "numericfilter") {
                            if (h.gridlocalization.decimalseparator == ",") {
                                if (w.indexOf(h.gridlocalization.decimalseparator) >= 0) {
                                    w = w.replace(h.gridlocalization.decimalseparator, ".")
                                }
                            }
                            if (w.indexOf(h.gridlocalization.currencysymbol) >= 0) {
                                w = w.replace(h.gridlocalization.currencysymbol, "")
                            }
                            if (w.indexOf(h.gridlocalization.percentagesymbol) >= 0) {
                                w = w.replace(h.gridlocalization.percentagesymbol, "")
                            }
                        }
                        var j = x.createfilter(q, w, k, null, l.cellsFormat, h.gridlocalization);
                        x.addfilter(0, j);
                        h.addFilter(s, x)
                    }
                }
                if (h.dataview.filters.length > 0) {
                    h.applyFilters()
                } else {
                    h.clearFilters()
                }
                if (h.dataview.filters.length == 0) {
                    h.filtericon.fadeOut(200)
                } else {
                    h.filtericon.fadeIn(200)
                }
            };
            var e = function () {
                var m = b("<div style='position: relative;' class='filterrow'></div>").appendTo(h.filter);
                h.filterrow = m;
                m[0].cells = new Array();
                m.height(24);
                m.width(h.table.width());
                var k = 0;
                var j = h.filtercolumnsList.jqxDropDownList("getSelectedItem").value;
                var l = h.filterinput.val();
                b.each(h.columns.records, function () {
                    var p = this;
                    var n = b("<div></div>").appendTo(m);
                    n.css("position", "absolute");
                    n.css("left", k + parseInt(p.uielement[0].style.left));
                    if (p.pinned) {
                        n.css("z-index", h.tableZIndex + h.columns.records.length);
                        n.addClass(h.toThemeProperty("jqx-widget-header"))
                    }
                    m[0].cells.push(n[0]);
                    if (!this.filterable) {
                        return true
                    }
                    var o = b("<input style='margin-left: 4px; height: 20px; float: left;' role='textbox' type='text'/>").appendTo(n);
                    o.keydown(function (r) {
                        if (r.keyCode === 13) {
                            c()
                        }
                    });
                    if (p.displayfield === j) {
                        o.val(l)
                    }
                    o.addClass(h.toThemeProperty("jqx-input"));
                    o.addClass(h.toThemeProperty("jqx-rc-all"));
                    o.addClass(h.toThemeProperty("jqx-widget"));
                    o.addClass(h.toThemeProperty("jqx-widget-content"));
                    var q = b("<div style='cursor: pointer; margin-left: 4px; margin-bottom: 4px; margin-top: 6px; width: 18px; position: relative; margin-top: 4px; float: left;'></div>").appendTo(n);
                    q.append(b("<div style='width: 16px; height: 16px;' class='" + h.toThemeProperty("jqx-grid-column-filterbutton") + "'></div>"));
                    o.focus(function () {
                        h.ensureColumnVisible(p.displayfield);
                        h.filter[0].scrollLeft = 0;
                        h.ensureColumnVisible(p.displayfield);
                        setTimeout(function () {
                            h.filter[0].scrollLeft = 0;
                            h.ensureColumnVisible(p.displayfield)
                        }, 10)
                    });
                    q.click(function () {
                        var u = b("<div class='filterconditions' style='position: relative; margin-top: 1px; float: left;'></div>");
                        u.insertAfter(q);
                        q.remove();
                        var s = h.getcolumntypebydatafield(p);
                        var t = h._getfiltersbytype(s);
                        var r;
                        if (s === "string") {
                            r = 2
                        } else {
                            r = 0
                        }
                        u.jqxDropDownList({
                            theme: h.theme,
                            enableBrowserBoundsDetection: true,
                            renderMode: "simple",
                            arrowSize: 0,
                            selectedIndex: r,
                            rtl: h.rtl,
                            dropDownWidth: 230,
                            dropDownHeight: 180,
                            width: 20,
                            height: 20,
                            source: t,
                            selectionRenderer: function () {
                                return "<div style='width: 16px; height: 16px;' class='" + h.toThemeProperty("jqx-grid-column-filterbutton") + "'></div>"
                            }
                        });
                        h.addHandler(u, "close", function (v) {
                            o.focus();
                            setTimeout(function () {
                                o.focus()
                            }, 10)
                        });
                        u.removeAttr("tabindex");
                        u.find("div").removeAttr("tabindex");
                        u.jqxDropDownList("open")
                    });
                    o[0].style.width = p.width - 6 - 22 + "px"
                });
                b("<div style='clear: both;'></div>").appendTo(m)
            };
            e();
            var i = b("<div style='position:relative;' class='filterrow'></div>").appendTo(h.filter);
            var f = b("<input type='button' style='position: relative; float: left; margin-top: 4px; margin-left: 4px;' value='" + h.gridlocalization.filterapplystring + "'/>").appendTo(i);
            var g = b("<input type='button' style='position: relative; float: left; margin-top: 4px;  margin-left: 4px;' value='" + h.gridlocalization.filtercancelstring + "'/>").appendTo(i);
            var d = 0;
            f.css("left", d);
            g.css("left", d);
            f.css("top", "4px");
            g.css("top", "4px");
            f.jqxButton({theme: h.theme});
            g.jqxButton({theme: h.theme});
            g.click(function () {
                h.filtercolumnsList.jqxDropDownList({disabled: false});
                h.filterinput.removeClass(h.toThemeProperty("jqx-fill-state-disabled"));
                h.filterinput.attr("disabled", false);
                h.filterbutton.removeClass(h.toThemeProperty("jqx-fill-state-disabled"));
                h.filter.find(".filterrow").addClass("filterrow-hidden");
                h.filter.find(".filterrow").hide();
                h._arrange()
            });
            f.click(function () {
                c()
            });
            h._renderhorizontalscroll()
        }, _getfiltertype: function (c) {
            var d = "stringfilter";
            switch (c) {
                case"number":
                case"int":
                case"float":
                case"decimal":
                    d = "numericfilter";
                    break;
                case"boolean":
                case"bool":
                    d = "booleanfilter";
                    break;
                case"date":
                case"time":
                    d = "datefilter";
                    break;
                case"string":
                    d = "stringfilter";
                    break
            }
            return d
        }, getcolumntypebydatafield: function (e) {
            var f = this;
            var d = "string";
            var c = f.source.datafields || ((f.source._source) ? f.source._source.datafields : null);
            if (c) {
                var g = "";
                b.each(c, function () {
                    if (this.name == e.displayfield) {
                        if (this.type) {
                            g = this.type
                        }
                        return false
                    }
                });
                if (g) {
                    return g
                }
            }
            return d
        }, _getfiltersbytype: function (c) {
            var d = this;
            var e = "";
            switch (c) {
                case"number":
                case"float":
                case"int":
                    e = d.gridlocalization.filternumericcomparisonoperators;
                    break;
                case"date":
                    e = d.gridlocalization.filterdatecomparisonoperators;
                    break;
                case"boolean":
                case"bool":
                    e = d.gridlocalization.filterbooleancomparisonoperators;
                    break;
                case"string":
                default:
                    e = d.gridlocalization.filterstringcomparisonoperators;
                    break
            }
            return e
        }, _getcellvalue: function (c, e) {
            var d = null;
            d = e[c.datafield];
            if (c.displayfield != null) {
                d = e[c.displayfield]
            }
            if (d == null) {
                d = ""
            }
            return d
        }, _renderrows: function (ap) {
            if (this.editable) {
                if (this.editKey != null) {
                    if (ap !== false) {
                        var M = this.endroweditbykey(this.editKey)
                    }
                }
            }
            if (this.treeGrid) {
                this.treeGrid._renderrows();
                return
            }
            if (this._loading) {
                return
            }
            if (this._updating) {
                return
            }
            if (this.rendering) {
                this.rendering()
            }
            var ab = this;
            var T = 0;
            this.table[0].rows = new Array();
            var H = this.toTP("jqx-cell") + " " + this.toTP("jqx-widget-content");
            if (this.rtl) {
                H += " " + this.toTP("jqx-cell-rtl")
            }
            var K = this.columns.records.length;
            var ao = b.jqx.browser.msie && b.jqx.browser.version < 8;
            if (ao) {
                this.host.attr("hideFocus", "true")
            }
            var R = ab.groups.length;
            var ai = new Array();
            var k = this.source.records;
            k = this.dataview.evaluate(k);
            this.dataViewRecords = k;
            if (this.dataview.pagesize == "all" || !this.pageable || this.serverProcessing) {
                var u = k;
                if (this.pageable && this.serverProcessing && k.length > this.dataview.pagesize) {
                    var u = k.slice(this.dataview.pagesize * this.dataview.pagenum, this.dataview.pagesize * this.dataview.pagenum + this.dataview.pagesize)
                }
            } else {
                var u = k.slice(this.dataview.pagesize * this.dataview.pagenum, this.dataview.pagesize * this.dataview.pagenum + this.dataview.pagesize)
            }
            if (ab.groups && ab.groups.length > 0) {
                var P = this.pageable ? this.dataview.pagesize * this.dataview.pagenum : 0;
                var z = function (w) {
                    var au = 0;
                    var i = new Array();
                    for (var c = 0; c < w.length; c++) {
                        var j = w[c];
                        if (j.level == 0) {
                            au++
                        }
                        if (au > ab.dataview.pagesize * ab.dataview.pagenum && au <= ab.dataview.pagesize * ab.dataview.pagenum + ab.dataview.pagesize) {
                            i.push(j)
                        }
                        if (au > ab.dataview.pagesize * ab.dataview.pagenum + ab.dataview.pagesize) {
                            break
                        }
                    }
                    return i
                };
                if (this.pageSizeMode === "root") {
                    var v = ab.source.getGroupedRecords(ab.groups, "records", "label", null, "data", null, "parent", k, 0);
                    ab.rootRecordsLength = v.length;
                    v = z(v)
                } else {
                    var v = ab.source.getGroupedRecords(ab.groups, "records", "label", null, "data", null, "parent", u, P)
                }
                var y = function (j, w) {
                    for (var av = 0; av < j.length; av++) {
                        var c = j[av];
                        w.push(c);
                        if (c.records && c.records.length > 0) {
                            var aw = y(c.records, new Array());
                            for (var au = 0; au < aw.length; au++) {
                                if (aw[au].leaf) {
                                    w.push(aw[au])
                                } else {
                                    w.push(aw[au])
                                }
                            }
                        }
                    }
                    return w
                };
                var ai = y.call(ab, v, new Array());
                u = ai;
                this.rowsByKey = new Array();
                for (var am = 0; am < u.length; am++) {
                    var G = u[am];
                    this.rowsByKey[G.uid] = G
                }
            }
            var ai = u;
            this.renderedRecords = ai;
            var U = ai.length;
            var V = this.tableZIndex;
            var aq = 0;
            var aa = 0;
            if (ao) {
                for (var al = 0; al < K; al++) {
                    var Z = this.columns.records[al];
                    var e = Z.width;
                    if (e < Z.minwidth) {
                        e = Z.minwidth
                    }
                    if (e > Z.maxwidth) {
                        e = Z.maxwidth
                    }
                    var l = b('<table><tr><td role="gridcell" style="max-width: ' + e + "px; width:" + e + 'px;" class="' + H + '"></td></tr></table>');
                    b(document.body).append(l);
                    var n = l.find("td");
                    aq = 1 + parseInt(n.css("padding-left")) + parseInt(n.css("padding-right"));
                    l.remove();
                    break
                }
            }
            var ak = this.rtl ? " " + this.toTP("jqx-grid-table-rtl") : "";
            var B = "<table cellspacing='0' cellpadding='0' class='" + this.toTP("jqx-grid-table") + ak + "' id='table" + this.element.id + "'><colgroup>";
            var ar = "<table cellspacing='0' cellpadding='0' class='" + this.toTP("jqx-grid-table") + ak + "' id='pinnedtable" + this.element.id + "'><colgroup>";
            var I = 0;
            var s = K;
            for (var al = 0; al < K; al++) {
                var Z = this.columns.records[al];
                if (Z.hidden) {
                    I++;
                    s--;
                    continue
                }
                var e = Z.width;
                if (e < Z.minwidth) {
                    e = Z.minwidth
                }
                if (e > Z.maxwidth) {
                    e = Z.maxwidth
                }
                e -= aq;
                if (e < 0) {
                    e = 0
                }
                if (ao) {
                    var ac = e;
                    if (al == I) {
                        ac++
                    }
                    if (Z.rowDetailscolumn) {
                        var ac = ac + 4;
                        ar += "<col style='max-width: " + ac + "px; width: " + ac + "px;'>";
                        B += "<col style='max-width: " + ac + "px; width: " + ac + "px;'>"
                    } else {
                        ar += "<col style='max-width: " + ac + "px; width: " + ac + "px;'>";
                        B += "<col style='max-width: " + ac + "px; width: " + ac + "px;'>"
                    }
                } else {
                    ar += "<col style='max-width: " + e + "px; width: " + e + "px;'>";
                    B += "<col style='max-width: " + e + "px; width: " + e + "px;'>"
                }
                aa += e
            }
            B += "</colgroup>";
            ar += "</colgroup>";
            this._hiddencolumns = false;
            var g = false;
            if (this.rowDetails && this._pinnedTable) {
                this._pinnedTable.find("[data-role=details]").detach();
                this._table.find("[data-role=details]").detach()
            }
            if (U === 0) {
                var o = '<tr role="row">';
                var m = this.host.height();
                if (this.pageable) {
                    m -= this.pagerHeight;
                    if (this.pagerPosition === "both") {
                        m -= this.pagerHeight
                    }
                }
                m -= this.columnsHeight;
                if (this.filterable) {
                    var ag = this.filter.find(".filterrow");
                    var D = this.filter.find(".filterrow-hidden");
                    var C = 1;
                    if (D.length > 0) {
                        C = 0
                    }
                    m -= this.filterHeight + this.filterHeight * ag.length * C
                }
                if (this.showstatusbar) {
                    m -= this.statusBarHeight
                }
                if (this.showAggregates) {
                    m -= this.aggregatesHeight
                }
                if (m < 25) {
                    m = 25
                }
                if (this.hScrollBar[0].style.visibility != "hidden") {
                    m -= this.hScrollBar.outerHeight()
                }
                if (this.height === "auto" || this.height === null || this.autoheight) {
                    m = 300
                }
                var l = '<td colspan="' + this.columns.records.length + '" role="gridcell" style="border: none; min-height: ' + m + "px; height: " + m + "px; max-width:" + aa + "px; width:" + aa + "px;";
                var H = this.toTP("jqx-cell") + " " + this.toTP("jqx-grid-cell") + " " + this.toTP("jqx-item");
                H += " " + this.toTP("jqx-center-align");
                l += '" class="' + H + '">';
                l += this.gridlocalization.emptydatastring;
                l += "</td>";
                o += l;
                B += o;
                ar += o;
                this.table[0].style.width = aa + 2 + "px";
                T = aa
            }
            var q = this.getRows();
            var x = new Array();
            for (var am = 0; am < ai.length; am++) {
                var G = ai[am];
                var L = G.uid;
                if (undefined === G.uid) {
                    G.uid = this.dataview.generatekey()
                }
                var o = '<tr data-key="' + L + '" role="row" id="row' + am + this.element.id + '">';
                var E = '<tr data-key="' + L + '" role="row" id="row' + am + this.element.id + '">';
                if (R > 0) {
                    if (G.level < R) {
                        var o = '<tr data-role="row-group" data-key="' + L + '" role="row" id="row' + am + this.element.id + '">';
                        var E = '<tr data-role="row-group" data-key="' + L + '" role="row" id="row' + am + this.element.id + '">'
                    }
                }
                var p = 0;
                var S = 0;
                for (var al = 0; al < K; al++) {
                    var ae = this.columns.records[al];
                    if (ae.pinned || (this.rtl && this.columns.records[K - 1].pinned)) {
                        g = true
                    }
                    var e = ae.width;
                    if (e < ae.minwidth) {
                        e = ae.minwidth
                    }
                    if (e > ae.maxwidth) {
                        e = ae.maxwidth
                    }
                    e -= aq;
                    if (e < 0) {
                        e = 0
                    }
                    var H = this.toTP("jqx-cell") + " " + this.toTP("jqx-grid-cell") + " " + this.toTP("jqx-item");
                    if (ae.pinned) {
                        H += " " + this.toTP("jqx-grid-cell-pinned")
                    }
                    if (this.sortcolumn === ae.displayfield) {
                        H += " " + this.toTP("jqx-grid-cell-sort")
                    }
                    if (this.altRows && am % 2 != 0) {
                        H += " " + this.toTP("jqx-grid-cell-alt")
                    }
                    if (this.rtl) {
                        H += " " + this.toTP("jqx-cell-rtl")
                    }
                    var O = "";
                    if (R > 0) {
                        if (G.level < R) {
                            if (!ao) {
                                H += " " + this.toTP("jqx-grid-cell-pinned");
                                O += ' colspan="' + K + '"';
                                var ac = 0;
                                for (var ad = 0; ad < K; ad++) {
                                    var at = ab.columns.records[ad];
                                    var A = at.width;
                                    if (A < at.minwidth) {
                                        e = at.minwidth
                                    }
                                    if (A > at.maxwidth) {
                                        e = at.maxwidth
                                    }
                                    A -= aq;
                                    if (A < 0) {
                                        A = 0
                                    }
                                    if (!at.hidden) {
                                        ac += A
                                    }
                                }
                                e = ac
                            } else {
                                H += " " + this.toTP("jqx-grid-cell-pinned")
                            }
                        }
                    }
                    var l = '<td role="gridcell" ' + O + ' style="max-width:' + e + "px; width:" + e + "px;";
                    var af = '<td role="gridcell" ' + O + ' style="pointer-events: none; visibility: hidden; border-color: transparent; max-width:' + e + "px; width:" + e + "px;";
                    if (al == K - 1 && K == 1) {
                        l += "border-right-color: transparent;";
                        af += "border-right-color: transparent;"
                    }
                    var Y = false;
                    if (R > 0) {
                        if (G.level < R) {
                            Y = true
                        }
                    }
                    if (!Y) {
                        if (ae.cellsalign != "left") {
                            if (ae.cellsalign === "right") {
                                H += " " + this.toTP("jqx-right-align")
                            } else {
                                H += " " + this.toTP("jqx-center-align")
                            }
                        }
                    } else {
                        if (this.rtl) {
                            H += " " + this.toTP("jqx-right-align")
                        }
                    }
                    if (this.rowinfo[G.uid]) {
                        if (this.rowinfo[G.uid].selected && !ae.rowDetailscolumn) {
                            if (this.editKey !== G.uid) {
                                if (this.selectionMode !== "none") {
                                    H += " " + this.toTP("jqx-grid-cell-selected");
                                    H += " " + this.toTP("jqx-fill-state-pressed")
                                }
                            }
                        }
                        if (this.rowinfo[G.uid].locked) {
                            H += " " + this.toTP("jqx-grid-cell-locked")
                        }
                    }
                    if (!(ae.hidden)) {
                        p += aq + e;
                        if (S == 0) {
                            l += "border-left-width: 0px;";
                            af += "border-left-width: 0px;"
                        }
                        S++
                    } else {
                        if (!Y) {
                            l += "display: none;";
                            af += "display: none;";
                            this._hiddencolumns = true
                        }
                    }
                    if (R > 0 && ao && Y && al >= R) {
                        l += "font-size: 1px; border-color: transparent;  color: transparent;";
                        af += "font-size: 1px; border-color: transparent; color: transparent;"
                    }
                    if (ae.pinned) {
                        l += "pointer-events: auto;";
                        af += "pointer-events: auto;"
                    }
                    if (!Y && ae.rowDetailscolumn) {
                        if (this.rowinfo[G.uid]) {
                            if (!this.rowinfo[G.uid].nodetails) {
                                if (this.rowinfo[G.uid].expanded) {
                                    if (!this.rtl) {
                                        H += " " + this.toTP("jqx-grid-group-expand")
                                    } else {
                                        H += " " + this.toTP("jqx-grid-group-expand-rtl")
                                    }
                                    H += " " + this.toTP("jqx-icon-arrow-down")
                                } else {
                                    if (!this.rtl) {
                                        H += " " + this.toTP("jqx-grid-group-collapse");
                                        H += " " + this.toTP("jqx-icon-arrow-right")
                                    } else {
                                        H += " " + this.toTP("jqx-grid-group-collapse-rtl");
                                        H += " " + this.toTP("jqx-icon-arrow-left")
                                    }
                                }
                            }
                        } else {
                            if (!this.rtl) {
                                H += " " + this.toTP("jqx-grid-group-collapse");
                                H += " " + this.toTP("jqx-icon-arrow-right")
                            } else {
                                H += " " + this.toTP("jqx-grid-group-collapse-rtl");
                                H += " " + this.toTP("jqx-icon-arrow-left")
                            }
                        }
                    }
                    if (!this.autoRowHeight || (this.autoRowHeight && !ae.autoCellHeight)) {
                        H += " " + this.toTP("jqx-grid-cell-nowrap ")
                    }
                    var aj = ab._getcellvalue(ae, G);
                    var f = ae.cellsFormat;
                    if (R > 0) {
                        if (G.level < R) {
                            aj = G.label;
                            f = ab.getColumn(ab.groups[G.level]).cellsFormat
                        }
                    }
                    if (f != "") {
                        if (b.jqx.dataFormat) {
                            if (b.jqx.dataFormat.isDate(aj)) {
                                aj = b.jqx.dataFormat.formatdate(aj, f, ab.gridlocalization)
                            } else {
                                if (b.jqx.dataFormat.isNumber(aj) || (!isNaN(parseFloat(aj)) && isFinite(aj))) {
                                    aj = b.jqx.dataFormat.formatnumber(aj, f, ab.gridlocalization)
                                }
                            }
                        }
                    }
                    if (!Y) {
                        if (ae.cellclassname != "" && ae.cellclassname) {
                            if (typeof ae.cellclassname == "string") {
                                H += " " + ae.cellclassname
                            } else {
                                var r = ae.cellclassname(am, ae.datafield, aj, G);
                                if (r) {
                                    H += " " + r
                                }
                            }
                        }
                        if (ae.cellsRenderer != "" && ae.cellsRenderer) {
                            var d = q.indexOf(G);
                            if (d === -1) {
                                if (G.originalRecord) {
                                    var d = q.indexOf(G.originalRecord)
                                }
                            }
                            aj = ae.cellsRenderer(d, ae.datafield, aj, G);
                            if (aj && (aj.indexOf("<jqx-") >= 0 || aj.indexOf(" ng-") >= 0)) {
                                x.push({rowKey: G.uid, row: d, column: ae.datafield, value: aj, columnIndex: al})
                            }
                        }
                    } else {
                        if (this.groupsRenderer) {
                            aj = this.groupsRenderer(aj, G, G.level)
                        }
                    }
                    l += '" class="' + H + '">';
                    l += aj;
                    l += "</td>";
                    af += '" class="' + H + '">';
                    af += aj;
                    af += "</td>";
                    if (!ae.pinned) {
                        o += l;
                        if (g) {
                            E += af
                        }
                    } else {
                        E += l;
                        o += l
                    }
                    if (R > 0 && !ao) {
                        if (G.level < R) {
                            break
                        }
                    }
                }
                if (T == 0) {
                    this.table[0].style.width = p + 2 + "px";
                    T = p
                }
                o += "</tr>";
                E += "</tr>";
                B += o;
                ar += E;
                if (!this.rowinfo[G.uid]) {
                    this.rowinfo[G.uid] = {
                        group: Y,
                        row: G,
                        details: null,
                        detailsHeight: 200,
                        initialized: false,
                        expanded: false
                    }
                } else {
                    if (!("group" in this.rowinfo[G.uid])) {
                        this.rowinfo[G.uid].group = Y
                    }
                    if (!("row" in this.rowinfo[G.uid])) {
                        this.rowinfo[G.uid].row = G
                    }
                    if (!("details" in this.rowinfo[G.uid])) {
                        this.rowinfo[G.uid].details = null
                    }
                    if (!("detailsHeight" in this.rowinfo[G.uid])) {
                        this.rowinfo[G.uid].detailsHeight = 200
                    }
                    if (!("initialized" in this.rowinfo[G.uid])) {
                        this.rowinfo[G.uid].initialized = false
                    }
                    if (!("expanded" in this.rowinfo[G.uid])) {
                        this.rowinfo[G.uid].expanded = false
                    }
                }
                if (this.serverProcessing) {
                    this.rowinfo[G.uid].row = G
                }
                if (this.rowDetails) {
                    var F = this.rowinfo[G.uid].detailsHeight;
                    if (this.rowinfo[G.uid]) {
                        if (this.rowinfo[G.uid].expanded) {
                            var ah = '<tr data-role="row-details"><td valign="top" style="pointer-events: auto; overflow: hidden; min-height: ' + F + "px; max-height: " + F + "px; height: " + F + 'px; overflow: hidden; border-left: none; border-right: none;" colspan="' + this.columns.records.length + '" role="gridcell"'
                        } else {
                            var ah = '<tr data-role="row-details" style="display: none;"><td valign="top" style="pointer-events: auto; overflow: hidden; min-height: ' + F + "px; max-height: " + F + "px; height: " + F + 'px; overflow: hidden; border-left: none; border-right: none;" colspan="' + this.columns.records.length + '" role="gridcell"'
                        }
                    } else {
                        var ah = '<tr data-role="row-details" style="display: none;"><td valign="top" style="pointer-events: auto; overflow: hidden; min-height: ' + F + "px; max-height: " + F + "px; height: " + F + 'px; overflow: hidden; border-left: none; border-right: none;" colspan="' + this.columns.records.length + '" role="gridcell"'
                    }
                    var H = this.toTP("jqx-cell") + " " + this.toTP("jqx-grid-cell") + " " + this.toTP("jqx-item");
                    H += " " + this.toTP("jqx-details");
                    H += " " + this.toTP("jqx-reset");
                    ah += '" class="' + H + '"><div style="pointer-events: auto; overflow: hidden; min-height: ' + F + "px; max-height: " + F + "px; height: " + F + 'px;"><div data-role="details"></div></div></td></tr>';
                    B += ah;
                    ar += ah
                }
            }
            B += "</table>";
            ar += "</table>";
            if (g) {
                if (ab.WinJS) {
                    MSApp.execUnsafeLocalFunction(function () {
                        ab.table.html(ar + B)
                    })
                } else {
                    ab.table[0].innerHTML = ar + B
                }
                var W = this.table.find("#table" + this.element.id);
                var X = this.table.find("#pinnedtable" + this.element.id);
                X.css("float", "left");
                X.css("pointer-events", "none");
                W.css("float", "left");
                X[0].style.position = "absolute";
                W[0].style.position = "relative";
                W[0].style.zIndex = V - 10;
                X[0].style.zIndex = V + 10;
                this._table = W;
                this._table[0].style.left = "0px";
                this._pinnedTable = X;
                this._pinnedTable[0].style.left = "0px";
                this._pinnedTable[0].style.width = T + "px";
                this._table[0].style.width = T + "px";
                if (this.rtl) {
                    if (T > parseInt(this.element.style.width) && this._haspinned) {
                        this._pinnedTable[0].style.left = 3 - T + parseInt(this.element.style.width) + "px"
                    }
                }
                if (this.rowDetails) {
                    for (var am = 0; am < U; am++) {
                        var G = ai[am];
                        var L = G.uid;
                        if (this.rowinfo[L].details) {
                            var N = b(this._table.children()[1]).children(("[data-key=" + L + "]"));
                            var Q = b(this._pinnedTable.children()[1]).children(("[data-key=" + L + "]"));
                            if (N) {
                                var h = Q.next();
                                var J = b(b(h).children().children());
                                J.children().detach();
                                J.append(this.rowinfo[G.uid].details)
                            }
                        }
                    }
                }
            } else {
                if (ab.WinJS) {
                    MSApp.execUnsafeLocalFunction(function () {
                        ab.table.html(B)
                    })
                } else {
                    ab.table[0].innerHTML = B
                }
                var ad = this.table.find("#table" + this.element.id);
                this._table = ad;
                if (b.jqx.browser.msie && b.jqx.browser.version < 10) {
                    this._table[0].style.width = T + "px"
                }
                if (U === 0) {
                    this._table[0].style.width = (2 + T) + "px"
                }
            }
            if (U === 0) {
                this._table[0].style.tableLayout = "auto";
                if (this._pinnedTable) {
                    this._pinnedTable[0].style.tableLayout = "auto"
                }
            }
            if (x && x.length > 0) {
                var an = this._table[0].rows;
                b.each(x, function () {
                    var w = this.row;
                    var au = this.rowKey;
                    var j = this.column;
                    var i = this.columnIndex;
                    var t = ab._getuirow(au);
                    if (t) {
                        var c = t[0].cells[i];
                        if (b.jqx.angularCompile) {
                            b.jqx.angularCompile(c, "<div>" + c.innerHTML + "</div>")
                        }
                    }
                })
            }
            if (this.rendered) {
                this.rendered()
            }
        }, getcolumnindex: function (c) {
            var d = this.getColumn(c);
            var e = this.columns.records.indexOf(d);
            return e
        }, setcolumnindex: function (e, i, j) {
            var h = this.getColumn(e);
            if (h.pinned) {
                return
            }
            if (h.hidden) {
                return
            }
            if (h.checkboxcolumn) {
                return
            }
            if (h.grouped) {
                return
            }
            var l = this.columns.records.indexOf(h);
            this.columns.records.splice(l, 1);
            this.columns.records.splice(i, 0, h);
            var f = 0;
            var n = this.headerZIndex;
            this.columnsrow.children().detach();
            var k = this.toThemeProperty("jqx-grid-cell");
            k += " " + this.toThemeProperty("jqx-grid-cell-pinned");
            k += " " + this.toThemeProperty("jqx-item");
            var m = this;
            var c = null;
            if (m.filterrow != undefined) {
                var c = b(m.filterrow.children()[0])
            }
            this.columnsrow[0].cells = [];
            var g = false;
            b.each(this.columns.records, function (p, s) {
                var q = this.uielement;
                m.columnsrow.append(q);
                if (!m.rtl) {
                    q.css("z-index", n--)
                } else {
                    q.css("z-index", n++)
                }
                var o = !m.rtl ? 250 + n - 1 : 250 + n + 1;
                if (this.pinned) {
                    q.css("z-index", o)
                }
                var r = this.width;
                q.css("left", f);
                m.columnsrow[0].cells[m.columnsrow[0].cells.length] = q[0];
                if (this.hidden) {
                    g = true
                }
                if (!(this.hidden && this.hideable)) {
                    f += r
                }
            });
            if (this.groupable) {
                var d = this.groups.length;
                if (d > 0) {
                    if (l - d >= 0) {
                        l -= d;
                        i -= d
                    }
                }
            }
            if (this.rowDetails) {
                if (l - 1 >= 0) {
                    l--;
                    i--
                }
            }
            if (this.selectionMode == "checkbox") {
                if (l - 1 >= 0) {
                    l--;
                    i--
                }
            }
            var h = this._columns[l];
            this._columns.splice(l, 1);
            this._columns.splice(i, 0, h);
            this.resize();
            this._rendercolumnGroups();
            this._raiseEvent("columnReordered", {dataField: h.datafield, oldIndex: l, newIndex: i})
        }, _pinnedColumnsLength: function () {
            var c = 0;
            b.each(this.columns.records, function () {
                if (this.pinned) {
                    c++
                }
                if (this.grouped) {
                    c++
                }
            });
            if (this.rowDetails) {
                c++
            }
            if (this.selectionMode == "checkbox") {
                c++
            }
            return c
        }, _handlecolumnsReorder: function () {
            var g = this;
            var h = -1;
            var d = false;
            if (!g.columnsReorder) {
                return
            }
            var f = "mousemove.reorder" + this.element.id;
            var e = "mousedown.reorder" + this.element.id;
            var i = "mouseup.reorder" + this.element.id;
            var c = false;
            if (this.isTouchDevice() && this.touchmode !== true) {
                c = true;
                f = b.jqx.mobile.getTouchEventName("touchmove") + ".reorder" + this.element.id;
                e = b.jqx.mobile.getTouchEventName("touchstart") + ".reorder" + this.element.id;
                i = b.jqx.mobile.getTouchEventName("touchend") + ".reorder" + this.element.id
            }
            this.removeHandler(b(document), f);
            this.addHandler(b(document), f, function (x) {
                if (g.resizing) {
                    return true
                }
                if (g.reordercolumn != null) {
                    var m = parseInt(x.pageX);
                    var u = parseInt(x.pageY);
                    if (c) {
                        var t = g.getTouches(x);
                        var p = t[0];
                        if (p != undefined) {
                            m = parseInt(p.pageX);
                            u = parseInt(p.pageY)
                        }
                    }
                    var j = g.host.coord();
                    var w = parseInt(j.left);
                    var k = parseInt(j.top);
                    if (g.dragmousedownoffset == undefined || g.dragmousedownoffset == null) {
                        g.dragmousedownoffset = {left: 0, top: 0}
                    }
                    var B = parseInt(m) - parseInt(g.dragmousedownoffset.left);
                    var s = parseInt(u) - parseInt(g.dragmousedownoffset.top);
                    g.reordercolumn.css({left: B + "px", top: s + "px"});
                    d = false;
                    if (m >= w && m <= w + g.host.width()) {
                        if (u >= k && u <= k + g.host.height()) {
                            d = true
                        }
                    }
                    h = -1;
                    if (d) {
                        g.reordercolumnicon.removeClass(g.toThemeProperty("jqx-grid-dragcancel-icon"));
                        g.reordercolumnicon.addClass(g.toThemeProperty("jqx-grid-drag-icon"));
                        var n = g.columnsheader.coord();
                        var q = n.top + g.columnsheader.height();
                        if (g.columnsdropline != null) {
                            if (u >= n.top && u <= q) {
                                h = g._handlereordercolumnsdroplines(m);
                                if (g.columnGroups) {
                                    if (h != -1) {
                                        var l = 0;
                                        l += g._pinnedColumnsLength();
                                        var o = h.index;
                                        if (o >= l) {
                                            var y = g.columns.records[o];
                                            if (y != undefined) {
                                                var v = g.columns.records.indexOf(g.getColumn(y.datafield));
                                                if (y.datafield == null) {
                                                    var v = g.columns.records.indexOf(g.getcolumnbytext(y.text))
                                                }
                                                var r = b.data(g.reordercolumn[0], "reorderrecord");
                                                var A = g.columns.records.indexOf(g.getColumn(r));
                                                var z = y;
                                                if (A < v) {
                                                    if (h.position == "before") {
                                                        z = g.columns.records[v - 1]
                                                    }
                                                }
                                                if (z.columngroup != g.getColumn(r).columngroup) {
                                                    g.columnsdropline.hide();
                                                    return
                                                }
                                            }
                                        }
                                    }
                                }
                            } else {
                                g.columnsdropline.fadeOut("slow")
                            }
                        }
                    } else {
                        if (g.columnsdropline != null) {
                            g.columnsdropline.fadeOut("slow")
                        }
                        g.reordercolumnicon.removeClass(g.toThemeProperty("jqx-grid-drag-icon"));
                        g.reordercolumnicon.addClass(g.toThemeProperty("jqx-grid-dragcancel-icon"))
                    }
                    if (x.preventDefault) {
                        x.preventDefault();
                        x.stopPropagation()
                    }
                    if (c) {
                        x.preventDefault();
                        x.stopPropagation();
                        return false
                    }
                }
            });
            this.columnsbounds = new Array();
            this.removeHandler(b(document), e);
            this.addHandler(b(document), e, function (k) {
                if (g.resizing) {
                    return true
                }
                g.columnsbounds = new Array();
                var m = g.host.coord().left;
                var l = g.host.coord().top;
                if (g.showtoolbar) {
                    l += g.toolbarHeight
                }
                if (g.filter) {
                    l += g.filter.height()
                }
                var j = 0;
                b.each(g.columns.records, function (o) {
                    var p = this;
                    if (p.hidden) {
                        g.columnsbounds[g.columnsbounds.length] = {top: l, column: p, left: m, width: 0, height: 2};
                        return true
                    }
                    if (j == 0) {
                        if (!g.rtl) {
                            m = parseInt(g.host.coord().left) - g.hScrollInstance.value
                        } else {
                            m = parseInt(g.host.coord().left) - g.hScrollInstance.max + g.hScrollInstance.value
                        }
                    }
                    j++;
                    var n = 2 + g.columnsHeight;
                    if (g.columnshierarchy) {
                        l = b(p.uielement).coord().top;
                        n = b(p.uielement).height()
                    }
                    g.columnsbounds[g.columnsbounds.length] = {top: l, column: p, left: m, width: p.width, height: n};
                    m += p.width
                })
            });
            this.removeHandler(b(document), i);
            this.addHandler(b(document), i, function (j) {
                if (g.resizing) {
                    return true
                }
                g.__drag = false;
                b(document.body).removeClass("jqx-disableselect");
                var l = parseInt(j.pageX);
                var t = parseInt(j.pageY);
                if (c) {
                    var o = g.getTouches(j);
                    var n = o[0];
                    l = parseInt(n.pageX);
                    t = parseInt(n.pageY)
                }
                var m = g.host.coord();
                var v = parseInt(m.left);
                var w = parseInt(m.top);
                if (g.showtoolbar) {
                    w += g.toolbarHeight
                }
                g.columndragstarted = false;
                g.dragmousedown = null;
                if (g.reordercolumn != null) {
                    var k = b.data(g.reordercolumn[0], "reorderrecord");
                    var x = g.columns.records.indexOf(g.getColumn(k));
                    g.reordercolumn.remove();
                    g.reordercolumn = null;
                    var p = 0;
                    p += g._pinnedColumnsLength();
                    if (k != null) {
                        if (d) {
                            if (h != -1) {
                                var q = h.index;
                                if (q >= p) {
                                    var s = g.columns.records[q];
                                    if (s != undefined) {
                                        var u = g.columns.records.indexOf(g.getColumn(s.datafield));
                                        if (s.datafield == null) {
                                            var u = g.columns.records.indexOf(g.getcolumnbytext(s.text))
                                        }
                                        if (g.columnGroups) {
                                            var r = s;
                                            if (x < u) {
                                                if (h.position == "before") {
                                                    r = g.columns.records[u - 1]
                                                }
                                            }
                                            if (r.columngroup != g.getColumn(k).columngroup) {
                                                if (g.columnsdropline != null) {
                                                    g.columnsdropline.remove();
                                                    g.columnsdropline = null
                                                }
                                                return
                                            }
                                        }
                                        if (x < u) {
                                            if (h.position == "before") {
                                                g.setcolumnindex(k, u - 1)
                                            } else {
                                                g.setcolumnindex(k, u)
                                            }
                                        } else {
                                            if (x > u) {
                                                g.setcolumnindex(k, u)
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        if (g.columnsdropline != null) {
                            g.columnsdropline.remove();
                            g.columnsdropline = null
                        }
                    }
                }
            })
        }, getcolumnbytext: function (d) {
            var c = null;
            if (this.columns.records) {
                b.each(this.columns.records, function () {
                    if (this.text == d) {
                        c = this;
                        return false
                    }
                })
            }
            return c
        }, _handlereordercolumnsdroplines: function (i) {
            var c = this;
            var h = -1;
            var e = c._pinnedColumnsLength();
            var g = parseInt(c.host.coord().left);
            var d = g + c.host.width();
            var f = c.vScrollBar.css("visibility") != "hidden" ? 19 : 0;
            if (!c.rtl) {
                f = 0
            }
            b.each(c.columnsbounds, function (j) {
                if (j >= e) {
                    if (this.width == 0) {
                        return true
                    }
                    if (i <= this.left + this.width / 2) {
                        if (i > d) {
                            c.columnsdropline.fadeOut();
                            return false
                        }
                        c.columnsdropline.css("left", f + parseInt(this.left) + "px");
                        c.columnsdropline.css("top", parseInt(this.top) + "px");
                        c.columnsdropline.height(this.height);
                        c.columnsdropline.fadeIn("slow");
                        h = {index: j, position: "before"};
                        return false
                    } else {
                        if (i >= this.left + this.width / 2) {
                            if (this.left + this.width > d) {
                                c.columnsdropline.fadeOut();
                                return false
                            }
                            c.columnsdropline.css("left", f + 1 + this.left + this.width);
                            c.columnsdropline.css("top", this.top);
                            c.columnsdropline.height(this.height);
                            c.columnsdropline.fadeIn("slow");
                            h = {index: j, position: "after"}
                        }
                    }
                }
            });
            return h
        }, _createreordercolumn: function (d, f, i) {
            var h = this;
            var g = f;
            if (h.reordercolumn) {
                h.reordercolumn.remove()
            }
            if (h.columnsdropline) {
                h.columnsdropline.remove()
            }
            h.reordercolumn = b("<div></div>");
            var k = d.clone();
            h.reordercolumn.css("z-index", 999999);
            k.css("border-width", "1px");
            k.css("opacity", "0.4");
            var j = b(k.find("." + h.toThemeProperty("jqx-grid-column-menubutton")));
            if (j.length > 0) {
                j.css("display", "none")
            }
            var c = b(k.find(".jqx-icon-close"));
            if (c.length > 0) {
                c.css("display", "none")
            }
            h.reordercolumnicon = b('<div style="z-index: 9999; position: absolute; left: 100%; top: 50%; margin-left: -18px; margin-top: -7px;"></div>');
            h.reordercolumnicon.addClass(h.toThemeProperty("jqx-grid-drag-icon"));
            h.reordercolumn.css("float", "left");
            h.reordercolumn.css("position", "absolute");
            var e = h.host.coord();
            k.width(d.width() + 16);
            h.reordercolumn.append(k);
            h.reordercolumn.height(d.height());
            h.reordercolumn.width(k.width());
            h.reordercolumn.append(h.reordercolumnicon);
            b(document.body).append(h.reordercolumn);
            k.css("margin-left", 0);
            k.css("left", 0);
            k.css("top", 0);
            h.reordercolumn.css("left", g.left + h.dragmousedown.left);
            h.reordercolumn.css("top", g.top + h.dragmousedown.top);
            if (i != undefined && i) {
                h.columnsdropline = b('<div style="z-index: 9999; display: none; position: absolute;"></div>');
                h.columnsdropline.width(2);
                h.columnsdropline.addClass(h.toThemeProperty("jqx-grid-group-drag-line"));
                b(document.body).append(h.columnsdropline)
            }
        }, _handlecolumnsdragreorder: function (d, g) {
            if (this.reordercolumn) {
                this.reordercolumn.remove()
            }
            if (this.columnsdropline) {
                this.columnsdropline.remove()
            }
            this.dragmousedown = null;
            this.dragmousedownoffset = null;
            this.columndragstarted = false;
            this.reordercolumn = null;
            var h = this;
            var f;
            var c = false;
            if (this.isTouchDevice() && this.touchmode !== true) {
                c = true
            }
            var e = "mousedown.drag";
            var f = "mousemove.drag";
            if (c) {
                e = b.jqx.mobile.getTouchEventName("touchstart") + ".drag";
                f = b.jqx.mobile.getTouchEventName("touchmove") + ".drag"
            } else {
                this.addHandler(g, "dragstart", function (i) {
                    return false
                })
            }
            this.addHandler(g, e, function (k) {
                if (false == d.draggable) {
                    return true
                }
                if (h.resizing) {
                    return true
                }
                h.__drag = true;
                var j = k.pageX;
                var i = k.pageY;
                if (c) {
                    var l = h.getTouches(k);
                    var n = l[0];
                    j = n.pageX;
                    i = n.pageY
                }
                h.dragmousedown = {left: j, top: i};
                var m = b(k.target).coord();
                h.dragmousedownoffset = {left: parseInt(j) - parseInt(m.left), top: parseInt(i - m.top)};
                if (k.preventDefault) {
                    k.preventDefault()
                }
                return true
            });
            this.addHandler(g, f, function (k) {
                if (!d.draggable) {
                    return true
                }
                if (undefined == d.datafield) {
                    return true
                }
                if (d.pinned) {
                    return true
                }
                if (h.resizing) {
                    return true
                }
                if (h.dragmousedown) {
                    var j = k.pageX;
                    var i = k.pageY;
                    if (c) {
                        var m = h.getTouches(k);
                        var o = m[0];
                        if (o != undefined) {
                            j = o.pageX;
                            i = o.pageY
                        }
                    }
                    f = {left: j, top: i};
                    if (!h.columndragstarted && h.reordercolumn == null) {
                        var l = Math.abs(f.left - h.dragmousedown.left);
                        var n = Math.abs(f.top - h.dragmousedown.top);
                        if (l > 3 || n > 3) {
                            h._createreordercolumn(g, f, true);
                            b(document.body).addClass("jqx-disableselect");
                            b.data(h.reordercolumn[0], "reorderrecord", d.datafield)
                        }
                    }
                }
            })
        }, getTouches: function (c) {
            return b.jqx.mobile.getTouches(c)
        }, _handlecolumnsResize: function () {
            var i = this;
            if (this.columnsResize) {
                var k = false;
                if (i.isTouchDevice()) {
                    k = true
                }
                var g = "mousemove.resize" + this.element.id;
                var d = "mousedown.resize" + this.element.id;
                var e = "mouseup.resize" + this.element.id;
                if (k) {
                    var g = b.jqx.mobile.getTouchEventName("touchmove") + ".resize" + this.element.id;
                    var d = b.jqx.mobile.getTouchEventName("touchstart") + ".resize" + this.element.id;
                    var e = b.jqx.mobile.getTouchEventName("touchend") + ".resize" + this.element.id
                }
                this.removeHandler(b(document), g);
                this.addHandler(b(document), g, function (n) {
                    if (i.resizablecolumn != null && !i.disabled && i.resizing) {
                        if (i.resizeline != null) {
                            var s = i.resizablecolumn.columnelement;
                            var p = i.host.coord();
                            var v = parseInt(i.resizestartline.coord().left);
                            var l = v - i._startcolumnwidth;
                            var w = i.resizablecolumn.column.minwidth;
                            if (w == "auto") {
                                w = 0
                            } else {
                                w = parseInt(w)
                            }
                            var m = i.resizablecolumn.column.maxwidth;
                            if (m == "auto") {
                                m = 0
                            } else {
                                m = parseInt(m)
                            }
                            var q = n.pageX;
                            if (k) {
                                var t = b.jqx.mobile.getTouches(n);
                                var r = t[0];
                                q = r.pageX
                            }
                            l += w;
                            var u = m > 0 ? v + m : 0;
                            var o = m == 0 ? true : i._startcolumnwidth + q - v < m ? true : false;
                            if (i.rtl) {
                                var o = true
                            }
                            if (o) {
                                if (!i.rtl) {
                                    if (q >= p.left && q >= l) {
                                        if (u != 0 && n.pageX < u) {
                                            i.resizeline.css("left", q)
                                        } else {
                                            if (u == 0) {
                                                i.resizeline.css("left", q)
                                            }
                                        }
                                        if (k) {
                                            return false
                                        }
                                    }
                                } else {
                                    if (q >= p.left && q <= p.left + i.host.width()) {
                                        i.resizeline.css("left", q);
                                        if (k) {
                                            return false
                                        }
                                    }
                                }
                            }
                        }
                    }
                    if (!k && i.resizablecolumn != null) {
                        return false
                    }
                });
                this.removeHandler(b(document), d);
                this.addHandler(b(document), d, function (m) {
                    if (i.resizablecolumn != null && !i.disabled) {
                        var l = i.resizablecolumn.columnelement;
                        if (l.coord().top + l.height() + 5 < m.pageY) {
                            i.resizablecolumn = null;
                            return
                        }
                        if (l.coord().top - 5 > m.pageY) {
                            i.resizablecolumn = null;
                            return
                        }
                        i._startcolumnwidth = i.resizablecolumn.column.width;
                        i.resizablecolumn.column._width = null;
                        b(document.body).addClass("jqx-disableselect");
                        b(document.body).addClass("jqx-position-reset");
                        i._mouseDownResize = new Date();
                        i.resizing = true;
                        i._resizecolumn = i.resizablecolumn.column;
                        i.resizeline = i.resizeline || b('<div style="position: absolute;"></div>');
                        i.resizestartline = i.resizestartline || b('<div style="position: absolute;"></div>');
                        i.resizebackground = i.resizebackground || b('<div style="position: absolute; left: 0; top: 0; background: #000;"></div>');
                        i.resizebackground.css("opacity", 0.01);
                        i.resizebackground.css("cursor", "col-resize");
                        i.resizeline.css("cursor", "col-resize");
                        i.resizestartline.css("cursor", "col-resize");
                        i.resizeline.addClass(i.toThemeProperty("jqx-grid-column-resizeline"));
                        i.resizestartline.addClass(i.toThemeProperty("jqx-grid-column-resizestartline"));
                        b(document.body).append(i.resizeline);
                        b(document.body).append(i.resizestartline);
                        b(document.body).append(i.resizebackground);
                        var n = i.resizablecolumn.columnelement.coord();
                        i.resizebackground.css("left", i.host.coord().left);
                        i.resizebackground.css("top", i.host.coord().top);
                        i.resizebackground.width(i.host.width());
                        i.resizebackground.height(i.host.height());
                        i.resizebackground.css("z-index", 999999999);
                        var o = function (q) {
                            if (!i.rtl) {
                                q.css("left", parseInt(n.left) + i._startcolumnwidth)
                            } else {
                                q.css("left", parseInt(n.left))
                            }
                            var s = 0;
                            var t = i.showtoolbar ? i.toolbarHeight : 0;
                            s += t;
                            var v = i.showstatusbar ? i.statusBarHeight : 0;
                            s += v;
                            var r = i.showAggregates ? i.aggregatesHeight : 0;
                            s += r;
                            if (i.pageable && i.pagerPosition != "bottom") {
                                s += i.pagerHeight
                            }
                            if (i.filterable) {
                                s += i.filter.height()
                            }
                            var p = 0;
                            if (i.pageable && i.pagerPosition != "top") {
                                p = i.pagerHeight
                            }
                            var u = i.hScrollBar.css("visibility") != "hidden" ? i.scrollBarSize : 0;
                            q.css("top", parseInt(n.top));
                            q.css("z-index", 9999999999);
                            if (i.columnGroups) {
                                q.height(i.host.height() + i.resizablecolumn.columnelement.height() - p - s - u - i.columnGroupslevel * i.columnsHeight)
                            } else {
                                q.height(i.host.height() - p - s - u)
                            }
                            q.show("fast")
                        };
                        o(i.resizeline);
                        o(i.resizestartline);
                        i.dragmousedown = null
                    }
                });
                var f = function () {
                    b(document.body).removeClass("jqx-disableselect");
                    b(document.body).removeClass("jqx-position-reset");
                    if (!i.resizing) {
                        return
                    }
                    i._mouseUpResize = new Date();
                    var t = i._mouseUpResize - i._mouseDownResize;
                    if (t < 200) {
                        i.resizing = false;
                        if (i._resizecolumn != null && i.resizeline != null && i.resizeline.css("display") == "block") {
                            i._resizecolumn = null;
                            i.resizeline.hide();
                            i.resizestartline.hide();
                            i.resizebackground.remove()
                        }
                        return
                    }
                    i.resizing = false;
                    if (i.disabled) {
                        return
                    }
                    var n = i.host.width();
                    if (i.vScrollBar[0].style.visibility != "hidden") {
                        n -= 20
                    }
                    if (n < 0) {
                        n = 0
                    }
                    if (i._resizecolumn != null && i.resizeline != null && i.resizeline.css("display") == "block") {
                        var u = parseInt(i.resizeline.css("left"));
                        var o = parseInt(i.resizestartline.css("left"));
                        var s = i._startcolumnwidth + u - o;
                        if (i.rtl) {
                            var s = i._startcolumnwidth - u + o
                        }
                        var r = i._resizecolumn.width;
                        i._resizecolumn.width = s;
                        if (i._resizecolumn._percentagewidth != undefined) {
                            i._resizecolumn._percentagewidth = (s / n) * 100
                        }
                        for (var q = 0; q < i._columns.length; q++) {
                            if (i._columns[q].datafield === i._resizecolumn.datafield) {
                                i._columns[q].width = i._resizecolumn.width;
                                break
                            }
                        }
                        var l = i.hScrollBar[0].style.visibility;
                        var p = i._resizecolumn.displayfield;
                        i._updatecolumnwidths();
                        i.refresh();
                        i._resizecolumn = null;
                        i.resizeline.hide();
                        i.resizestartline.hide();
                        i.resizebackground.remove();
                        i.resizablecolumn = null;
                        i._raiseEvent("columnResized", {dataField: p, oldWidth: r, newWidth: s})
                    } else {
                        i.resizablecolumn = null
                    }
                };
                try {
                    if (document.referrer != "" || window.frameElement) {
                        var c = null;
                        if (window.top != null && window.top != window.self) {
                            if (window.parent && document.referrer) {
                                c = document.referrer
                            }
                        }
                        if (c && c.indexOf(document.location.host) != -1) {
                            var h = function (l) {
                                f()
                            };
                            if (window.top.document.addEventListener) {
                                window.top.document.addEventListener("mouseup", h, false)
                            } else {
                                if (window.top.document.attachEvent) {
                                    window.top.document.attachEvent("onmouseup", h)
                                }
                            }
                        }
                    }
                } catch (j) {
                }
                this.removeHandler(b(document), e);
                this.addHandler(b(document), e, function (m) {
                    var l = b.data(document.body, "contextmenu" + i.element.id);
                    if (l != null && i.autoshowcolumnsmenubutton) {
                        return true
                    }
                    f()
                })
            }
        }, _updatecolumnwidths: function () {
            var k = this.host.width();
            var c = k;
            if (this.vScrollBar.css("visibility") !== "hidden" && this.scrollBarSize > 0) {
                k -= parseInt(this.scrollBarSize) + 6;
                c = k
            }
            var j = "";
            if (this.columns == undefined || this.columns.records == undefined) {
                return
            }
            var i = this;
            var h = false;
            b.each(this.columns.records, function (l, m) {
                if (!(this.hidden)) {
                    if (this.width.toString().indexOf("%") != -1 || this._percentagewidth != undefined) {
                        var m = 0;
                        var n = i.vScrollBar[0].style.visibility == "hidden" ? 0 : i.scrollBarSize + 5;
                        if (i.scrollBarSize == 0) {
                            n = 0
                        }
                        m = parseFloat(this.width) * c / 100;
                        if (this._percentagewidth != undefined) {
                            m = parseFloat(this._percentagewidth) * (c) / 100
                        }
                        if (m < this.minwidth && this.minwidth != "auto") {
                            m = this.minwidth
                        }
                        if (m > this.maxwidth && this.maxwidth != "auto") {
                            m = this.maxwidth
                        }
                        k -= Math.round(m)
                    } else {
                        if (this.width != "auto" && !this._width) {
                            k -= this.width
                        } else {
                            j += this.text
                        }
                    }
                }
            });
            var f = this.columnsheader.find("#columntable" + this.element.id);
            if (f.length == 0) {
                return
            }
            var d = 0;
            var g = f.find(".jqx-grid-column-header");
            var e = 0;
            b.each(this.columns.records, function (n, q) {
                var m = b(g[n]);
                var t = false;
                var s = this.width;
                var o = this.width;
                if (this.width.toString().indexOf("%") != -1 || this._percentagewidth != undefined) {
                    if (this._percentagewidth != undefined) {
                        s = parseFloat(this._percentagewidth) * c / 100
                    } else {
                        s = parseFloat(this.width) * c / 100
                    }
                    s = Math.round(s);
                    t = true
                }
                if (this.width != "auto" && !this._width && !t) {
                    if (parseInt(m[0].style.width) != this.width) {
                        m.width(this.width)
                    }
                } else {
                    if (t) {
                        if (s < this.minwidth && this.minwidth != "auto") {
                            s = this.minwidth;
                            this.width = s
                        }
                        if (s > this.maxwidth && this.maxwidth != "auto") {
                            s = this.maxwidth;
                            this.width = s
                        }
                        if (parseInt(m[0].style.width) != s) {
                            m.width(s);
                            this.width = s
                        }
                    } else {
                        var l = Math.floor(k * (this.text.length / j.length));
                        if (isNaN(l)) {
                            l = this.minwidth
                        }
                        var p = (k * (this.text.length / j.length)) - l;
                        d += p;
                        if (d >= 1) {
                            d -= 1;
                            l++
                        }
                        if (d >= 0.5 && n == i.columns.records.length - 1) {
                            l++
                        }
                        if (l < 0) {
                            var r = b("<span>" + i.escape_HTML(this.text) + "</span>");
                            b(document.body).append(r);
                            l = 10 + r.width();
                            r.remove()
                        }
                        if (l < this.minwidth) {
                            l = this.minwidth
                        }
                        if (l > this.maxwidth) {
                            l = this.maxwidth
                        }
                        this._width = "auto";
                        this.width = l;
                        m.width(this.width)
                    }
                }
                if (parseInt(m[0].style.left) != e) {
                    m.css("left", e)
                }
                if (!(this.hidden)) {
                    e += this.width
                }
                this._requirewidthupdate = true;
                if (o !== this.width) {
                    h = true
                }
            });
            this.columnsheader.width(2 + e);
            f.width(this.columnsheader.width());
            this._resizecolumnGroups();
            if (h) {
                this._renderrows()
            }
            if (this.showAggregates) {
                this._refreshcolumnsaggregates()
            }
        }, _rendercolumnheaders: function () {
            var r = this;
            if (this._updating) {
                return
            }
            if (r.columns.records.length > r.headerZIndex) {
                r.headerZIndex = r.columns.records.length + 10
            }
            this._columnsbydatafield = new Array();
            this.columnsheader.find("#columntable" + this.element.id).remove();
            var g = b('<div id="columntable' + this.element.id + '" style="height: 100%; position: relative;"></div>');
            g[0].cells = new Array();
            var l = 0;
            var h = 0;
            var s = "";
            var u = this.host.width();
            var f = u;
            var w = new Array();
            var t = new Array();
            b.each(this.columns.records, function (j, k) {
                if (!(this.hidden)) {
                    if (this.width != "auto" && !this._width) {
                        if (this.width < this.minwidth && this.minwidth != "auto") {
                            u -= this.minwidth
                        } else {
                            if (this.width > this.maxwidth && this.maxwidth != "auto") {
                                u -= this.maxwidth
                            } else {
                                if (this.width.toString().indexOf("%") != -1) {
                                    var k = 0;
                                    k = parseFloat(this.width) * f / 100;
                                    if (k < this.minwidth && this.minwidth != "auto") {
                                        k = this.minwidth
                                    }
                                    if (k > this.maxwidth && this.maxwidth != "auto") {
                                        k = this.maxwidth
                                    }
                                    u -= k
                                } else {
                                    if (typeof this.width == "string") {
                                        this.width = parseInt(this.width)
                                    }
                                    u -= this.width
                                }
                            }
                        }
                    } else {
                        s += this.text
                    }
                }
                if (this.pinned || this.grouped || this.checkboxcolumn) {
                    if (r._haspinned) {
                        this.pinned = true
                    }
                    w[w.length] = this
                } else {
                    t[t.length] = this
                }
            });
            if (!this.rtl) {
                for (var o = 0; o < w.length; o++) {
                    this.columns.replace(o, w[o])
                }
                for (var m = 0; m < t.length; m++) {
                    this.columns.replace(w.length + m, t[m])
                }
            } else {
                var e = 0;
                w.reverse();
                for (var o = this.columns.records.length - 1; o >= this.columns.records.length - w.length; o--) {
                    this.columns.replace(o, w[e++])
                }
                for (var m = 0; m < t.length; m++) {
                    this.columns.replace(m, t[m])
                }
            }
            var v = this.headerZIndex;
            var d = 0;
            var n = r.columnsHeight;
            var q = function (j, k) {
                var i = r.columnGroupslevel * r.columnsHeight;
                i = i - (k.level * r.columnsHeight);
                return i
            };
            var c = 0;
            b.each(this.columns.records, function (K, I) {
                this.height = r.columnsHeight;
                if (r.columnGroups) {
                    if (r.columnGroups.length) {
                        this.height = q(this.datafield, this);
                        n = this.height
                    }
                }
                var N = r.toTP("jqx-grid-column-header") + " " + r.toTP("jqx-widget-header");
                if (r.rtl) {
                    N += " " + r.toTP("jqx-grid-column-header-rtl")
                }
                if (!r.enableBrowserSelection) {
                    N += " " + r.toTP("jqx-disableselect")
                }
                var L = !r.rtl ? 250 + v - 1 : 250 + v + 1;
                var G = !r.rtl ? v-- : v++;
                var x = b('<div role="columnheader" style="z-index: ' + G + ';position: absolute; height: 100%;" class="' + N + '"><div style="height: 100%; width: 100%;"></div></div>');
                if (r.rtl && K === 0) {
                    x[0].style.borderLeftColor = "transparent"
                }
                if (r.columnGroups) {
                    x[0].style.height = n + "px";
                    x[0].style.bottom = "0px";
                    if (this.pinned) {
                        x[0].style.zIndex = L
                    }
                }
                this.uielement = x;
                this.element = x;
                if (this.classname != "" && this.classname) {
                    x.addClass(this.classname)
                }
                var C = this.width;
                var D = false;
                if (this.width === null) {
                    this.width = "auto"
                }
                if (this.width.toString().indexOf("%") != -1 || this._percentagewidth != undefined) {
                    if (this._percentagewidth != undefined) {
                        C = parseFloat(this._percentagewidth) * f / 100
                    } else {
                        C = parseFloat(this.width) * f / 100
                    }
                    C = Math.round(C);
                    D = true
                }
                if (this.width != "auto" && !this._width && !D) {
                    if (C < this.minwidth && this.minwidth != "auto") {
                        C = this.minwidth
                    }
                    if (C > this.maxwidth && this.maxwidth != "auto") {
                        C = this.maxwidth
                    }
                    x[0].style.width = parseInt(C) + "px"
                } else {
                    if (D) {
                        if (C < this.minwidth && this.minwidth != "auto") {
                            C = this.minwidth
                        }
                        if (C > this.maxwidth && this.maxwidth != "auto") {
                            C = this.maxwidth
                        }
                        if (this._percentagewidth == undefined || this.width.toString().indexOf("%") != -1) {
                            this._percentagewidth = this.width
                        }
                        x.width(C);
                        this.width = C
                    } else {
                        var H = Math.floor(u * (this.text.length / s.length));
                        var E = (u * (this.text.length / s.length)) - H;
                        c += E;
                        if (c >= 1) {
                            c -= 1;
                            H++
                        }
                        if (c >= 0.5 && K == r.columns.records.length - 1) {
                            H++
                        }
                        if (isNaN(H)) {
                            H = this.minwidth
                        }
                        if (H < 0) {
                            var F = b("<span>" + r.escape_HTML(this.text) + "</span>");
                            b(document.body).append(F);
                            H = 10 + F.width();
                            F.remove()
                        }
                        if (H < this.minwidth) {
                            H = this.minwidth
                        }
                        if (H > this.maxwidth) {
                            H = this.maxwidth
                        }
                        this._width = "auto";
                        this.width = parseInt(H);
                        C = this.width;
                        x.width(this.width)
                    }
                }
                if (this.hidden) {
                    x.css("display", "none")
                }
                var k = b(x.children()[0]);
                g[0].cells[K] = x[0];
                var p = false;
                var J = false;
                var z = this.renderer != null ? this.renderer(r.escape_HTML(this.text), this.align, n) : r._rendercolumnheader(r.escape_HTML(this.text), this.align, n, r);
                if (z == null) {
                    z = r._rendercolumnheader(r.escape_HTML(this.text), this.align, n, r)
                }
                if (this.renderer != null) {
                    z = b(z)
                }
                p = true;
                if (r.WinJS) {
                    MSApp.execUnsafeLocalFunction(function () {
                        k.append(b(z))
                    })
                } else {
                    if (this.renderer) {
                        k.append(b(z))
                    } else {
                        if (z) {
                            k[0].innerHTML = z
                        }
                    }
                }
                if (z != null) {
                    var B = b('<div class="iconscontainer" style="height: ' + n + 'px; margin-left: -32px; display: block; position: absolute; left: 100%; top: 0%; width: 32px;"><div class="filtericon ' + r.toTP("jqx-widget-header") + '" style="height: ' + n + 'px; float: right; display: none; width: 16px;"><div class="' + r.toTP("jqx-grid-column-filterbutton") + '" style="width: 100%; height:100%;"></div></div><div class="sortasc ' + r.toTP("jqx-widget-header") + '" style="height: ' + n + 'px; float: right; display: none; width: 16px;"><div class="' + r.toTP("jqx-grid-column-sortascbutton") + '" style="width: 100%; height:100%;"></div></div><div class="sortdesc ' + r.toTP("jqx-widget-header") + '" style="height: ' + n + 'px; float: right; display: none; width: 16px;"><div class="' + r.toTP("jqx-grid-column-sortdescbutton") + '" style="width: 100%; height:100%;"></div></div></div>');
                    k.append(B);
                    var O = B.children();
                    this.sortasc = O[1];
                    this.sortdesc = O[2];
                    this.filtericon = O[0];
                    this.iconscontainer = B;
                    if (r.rtl) {
                        B.css("margin-left", "0px");
                        B.css("left", "0px");
                        b(this.sortasc).css("float", "left");
                        b(this.filtericon).css("float", "left");
                        b(this.sortdesc).css("float", "left")
                    }
                }
                g.append(x);
                if (r.columnsReorder && this.draggable && r._handlecolumnsdragreorder) {
                    r._handlecolumnsdragreorder(this, x)
                }
                var M = this;
                r.addHandler(x, "click", function (i) {
                    if (M.checkboxcolumn) {
                        return true
                    }
                    if (r._togglesort) {
                        if (!r._loading) {
                            r._togglesort(M)
                        }
                    }
                    i.preventDefault()
                });
                if (r.columnsResize && !J) {
                    var y = false;
                    var j = "mousemove";
                    if (r.isTouchDevice()) {
                        y = true;
                        j = b.jqx.mobile.getTouchEventName("touchstart")
                    }
                    r.addHandler(x, j, function (P) {
                        if (!M.resizable) {
                            r.resizablecolumn = null;
                            return true
                        }
                        var i = parseInt(P.pageX);
                        var R = 5;
                        var U = parseInt(x.coord().left);
                        if (r.hasTransform) {
                            U = b.jqx.utilities.getOffset(x).left
                        }
                        if (r._handlecolumnsResize) {
                            if (y) {
                                var Q = b.jqx.mobile.getTouches(P);
                                var T = Q[0];
                                i = T.pageX;
                                R = 40;
                                if (i >= U + M.width - R) {
                                    r.resizablecolumn = {columnelement: x, column: M};
                                    x.css("cursor", "col-resize")
                                } else {
                                    x.css("cursor", "");
                                    r.resizablecolumn = null
                                }
                                return true
                            }
                            var S = M.width;
                            if (r.rtl) {
                                S = 0
                            }
                            if (i >= U + S - R) {
                                if (i <= U + S + R) {
                                    r.resizablecolumn = {columnelement: x, column: M};
                                    x.css("cursor", "col-resize");
                                    return false
                                } else {
                                    x.css("cursor", "");
                                    r.resizablecolumn = null
                                }
                            } else {
                                x.css("cursor", "");
                                if (i < U + S - R) {
                                    if (!M._animating && !M._menuvisible) {
                                        x.mouseenter()
                                    }
                                }
                                r.resizablecolumn = null
                            }
                        }
                    })
                }
                x.css("left", h);
                if (!(this.hidden)) {
                    h += C
                }
                if (M.rendered) {
                    var A = M.rendered(b(k[0].firstChild), M.align, n);
                    if (A && B != null) {
                        B.hide()
                    }
                }
            });
            if (h > 0) {
                this.columnsheader.width(2 + h)
            } else {
                this.columnsheader.width(h)
            }
            this.columnsrow = g;
            r.columnsheader.append(g);
            g.width(h);
            if (this._handlecolumnsdragdrop) {
                this._handlecolumnsdragdrop()
            }
            if (this._handlecolumnsReorder) {
                this._handlecolumnsReorder()
            }
            if (this._handlecolumnsResize) {
                this._handlecolumnsResize()
            }
            if (this.columnGroups) {
                this._rendercolumnGroups()
            }
        }, _rendercolumnGroups: function () {
            if (!this.columnGroups) {
                return
            }
            var o = 0;
            for (var l = 0; l < this.columns.records.length; l++) {
                if (this.columns.records[l].pinned) {
                    o++
                }
            }
            var t = this.headerZIndex - o + this.columns.records.length;
            var n = this;
            var g = n.toTP("jqx-grid-column-header") + " " + n.toTP("jqx-grid-columngroup-header") + " " + n.toTP("jqx-widget-header");
            if (n.rtl) {
                g += " " + n.toTP("jqx-grid-columngroup-header-rtl")
            }
            var e = this.columnsheader.find("#columntable" + this.element.id);
            e.find("jqx-grid-columngroup-header").remove();
            for (var h = 0; h < this.columnGroupslevel - 1; h++) {
                for (var l = 0; l < this.columnGroups.length; l++) {
                    var q = this.columnGroups[l];
                    var c = q.level;
                    if (c !== h) {
                        continue
                    }
                    var p = c * this.columnsHeight;
                    var d = 99999;
                    if (q.groups) {
                        var s = function (w) {
                            var v = 0;
                            for (var u = 0; u < w.groups.length; u++) {
                                var i = w.groups[u];
                                if (!i.groups) {
                                    if (!i.hidden) {
                                        v += i.width;
                                        d = Math.min(parseInt(i.element[0].style.left), d)
                                    }
                                } else {
                                    v += s(i)
                                }
                            }
                            return v
                        };
                        q.width = s(q);
                        q.left = d;
                        var r = this.columnsHeight;
                        var m = t--;
                        var f = b('<div role="columnheader" style="z-index: ' + m + ';position: absolute;" class="' + g + '"></div>');
                        var k = b(this._rendercolumnheader(q.text, q.align, this.columnsHeight, this));
                        f.append(k);
                        f[0].style.left = d + "px";
                        if (d === 0) {
                            f[0].style.borderLeftColor = "transparent"
                        }
                        f[0].style.top = p + "px";
                        f[0].style.height = r + "px";
                        f[0].style.width = -1 + q.width + "px";
                        e.append(f);
                        q.element = f
                    }
                }
            }
        }, _resizecolumnGroups: function () {
            if (!this.columnGroups) {
                return
            }
            for (var d = 0; d < this.columnGroups.length; d++) {
                var j = this.columnGroups[d];
                var k = j.level;
                var h = k * this.columnsHeight;
                var g = 99999;
                if (j.groups) {
                    var f = function (n) {
                        var m = 0;
                        for (var l = 0; l < n.groups.length; l++) {
                            var i = n.groups[l];
                            if (!i.groups) {
                                if (!i.hidden) {
                                    m += i.width;
                                    g = Math.min(parseInt(i.element[0].style.left), g)
                                }
                            } else {
                                m += f(i)
                            }
                        }
                        return m
                    };
                    j.width = f(j);
                    j.left = g;
                    var c = this.columnsHeight;
                    var e = j.element;
                    e[0].style.left = g + "px";
                    e[0].style.top = h + "px";
                    e[0].style.height = c + "px";
                    e[0].style.width = -1 + j.width + "px"
                }
            }
        }, _removecolumnhandlers: function (f) {
            var d = this;
            var c = b(f.element);
            if (c.length > 0) {
                d.removeHandler(c, "mouseenter");
                d.removeHandler(c, "mouseleave");
                var e = b(f.filtericon);
                d.removeHandler(e, "mousedown");
                d.removeHandler(e, "click");
                d.removeHandler(c, "click")
            }
        }, _calculateaggregate: function (k, o, d, h) {
            if (!k.datafield) {
                return null
            }
            var e = k.aggregates;
            if (!e) {
                e = o
            }
            if (e) {
                var f = new Array();
                for (var n = 0; n < e.length; n++) {
                    if (e[n] == "count") {
                        continue
                    }
                    f[f.length] = k.cellsFormat
                }
                if (this.source && this.source.getAggregatedData) {
                    if (h == undefined) {
                        h = this.getRows();
                        if (this.dataViewRecords) {
                            h = this.dataViewRecords
                        }
                    }
                    var s = h;
                    var c = -1;
                    if (this.treeGrid) {
                        var q = new Array();
                        var r = function (u) {
                            for (var t = 0; t < u.length; t++) {
                                if (u[t] == undefined) {
                                    continue
                                }
                                if (c == -1) {
                                    c = u[t].level
                                }
                                if (!u[t].aggregate) {
                                    q.push(u[t])
                                }
                                if (!u[t].leaf && u[t].records && u[t].records.length > 0) {
                                    r(u[t].records)
                                }
                            }
                        };
                        r(h);
                        h = q
                    }
                    if (this.treeGrid && this.filterable && this.dataview.filters.length > 0) {
                        var p = new Array();
                        for (var n = 0; n < h.length; n++) {
                            if (h[n] && h[n]._visible !== false) {
                                p.push(h[n])
                            }
                        }
                        h = p;
                        var l = new Array();
                        for (var n = 0; n < s.length; n++) {
                            if (s[n] && s[n]._visible !== false) {
                                l.push(s[n])
                            }
                        }
                        s = l
                    }
                    if (d == undefined || d == true) {
                        var m = this.source.getAggregatedData([{
                            name: k.datafield,
                            aggregates: e,
                            formatStrings: f
                        }], this.gridlocalization, h, c);
                        if (this.treeGrid) {
                            var g = this.source._source.hierarchy && this.source._source.hierarchy.groupingDataFields ? this.source._source.hierarchy.groupingDataFields.length : 0;
                            if (g == 0 || c >= g) {
                                if (m) {
                                    if (m[k.datafield].sum != undefined || m[k.datafield].avg != undefined) {
                                        var j = this.source.getAggregatedData([{
                                            name: k.datafield,
                                            aggregates: e,
                                            formatStrings: f
                                        }], this.gridlocalization, s, c);
                                        if (m[k.datafield].sum != undefined) {
                                            m[k.datafield].sum = j[k.datafield].sum
                                        }
                                        if (m[k.datafield].avg != undefined) {
                                            m[k.datafield].avg = j[k.datafield].avg
                                        }
                                    }
                                }
                            }
                        }
                        return m
                    } else {
                        var m = this.source.getAggregatedData([{
                            name: k.datafield,
                            aggregates: e
                        }], this.gridlocalization, h, c);
                        if (this.treeGrid && m) {
                            if (m[k.datafield].sum != undefined || m[k.datafield].avg != undefined) {
                                var g = this.source._source.hierarchy && this.source._source.hierarchy.groupingDataFields ? this.source._source.hierarchy.groupingDataFields.length : 0;
                                if (g == 0 || c >= g) {
                                    var j = this.source.getAggregatedData([{
                                        name: k.datafield,
                                        aggregates: e
                                    }], this.gridlocalization, s, c);
                                    if (m[k.datafield].sum != undefined) {
                                        m[k.datafield].sum = j[k.datafield].sum
                                    }
                                    if (m[k.datafield].avg != undefined) {
                                        m[k.datafield].avg = j[k.datafield].avg
                                    }
                                }
                            }
                        }
                        return m
                    }
                }
            }
            return null
        }, getcolumnaggregateddata: function (d, h, i, e) {
            var f = this.getColumn(d);
            if (!f) {
                return ""
            }
            var k = (i == undefined || i == false) ? false : i;
            if (h == null) {
                return ""
            }
            var c = f.aggregates;
            f.aggregates = null;
            var j = this._calculateaggregate(f, h, k, e);
            var g = {};
            if (j) {
                g = j[d];
                f.aggregates = c
            }
            return g
        }, _updatecolumnaggregates: function (e, h, c) {
            var f = this;
            if (!h) {
                c.children().remove();
                c.html("");
                if (e.aggregatesRenderer) {
                    var g = {};
                    if (e.aggregates) {
                        g = this.getcolumnaggregateddata(e.datafield, e.aggregates)
                    }
                    var d = e.aggregatesRenderer({}, e, c, null);
                    c.html(d)
                }
                return
            }
            c.children().remove();
            c.html("");
            if (e.aggregatesRenderer) {
                if (h) {
                    var d = e.aggregatesRenderer(h[e.datafield], e, c, this.getcolumnaggregateddata(e.datafield, e.aggregates), "aggregates");
                    c.html(d)
                }
            } else {
                b.each(h, function () {
                    var j = this;
                    for (g in j) {
                        var k = b('<div style="position: relative; margin: 4px; overflow: hidden;"></div>');
                        var i = g;
                        i = f._getaggregatename(i);
                        k.html(i + ":" + j[g]);
                        if (f.rtl) {
                            k.addClass(f.toThemeProperty("jqx-rtl"))
                        }
                        c.append(k)
                    }
                })
            }
        }, _getaggregatetype: function (d) {
            switch (d) {
                case"min":
                case"max":
                case"count":
                case"avg":
                case"product":
                case"var":
                case"varp":
                case"stdev":
                case"stdevp":
                case"sum":
                    return d
            }
            var c = d;
            for (var e in d) {
                c = e;
                break
            }
            return c
        }, _getaggregatename: function (d) {
            var c = d;
            switch (d) {
                case"min":
                    c = "Min";
                    break;
                case"max":
                    c = "Max";
                    break;
                case"count":
                    c = "Count";
                    break;
                case"avg":
                    c = "Avg";
                    break;
                case"product":
                    c = "Product";
                    break;
                case"var":
                    c = "Var";
                    break;
                case"stdevp":
                    c = "StDevP";
                    break;
                case"stdev":
                    c = "StDev";
                    break;
                case"varp":
                    c = "VarP";
                case"sum":
                    c = "Sum";
                    break
            }
            if (d === c && typeof (c) != "string") {
                for (var e in d) {
                    c = e;
                    break
                }
            }
            return c
        }, _updatecolumnsaggregates: function () {
            var g = this.getRows();
            if (this.dataViewRecords) {
                g = this.dataViewRecords
            }
            var c = this.columns.records.length;
            if (undefined != this.aggregates[0].cells) {
                for (var f = 0; f < c; f++) {
                    var h = b(this.aggregates[0].cells[f]);
                    var e = this.columns.records[f];
                    var d = this._calculateaggregate(e, null, true, g);
                    this._updatecolumnaggregates(e, d, h)
                }
            }
        }, _refreshcolumnsaggregates: function () {
            var c = this.columns.records.length;
            if (undefined != this.aggregates[0].cells) {
                var f = 0;
                for (var e = 0; e < c; e++) {
                    var g = b(this.aggregates[0].cells[e]);
                    var d = this.columns.records[e];
                    if (g) {
                        g.width(d.width);
                        g[0].style.left = f + "px";
                        if (!(d.hidden && d.hideable)) {
                            f += d.width
                        } else {
                            g.css("display", "none")
                        }
                    }
                }
            }
        }, _updateaggregates: function () {
            var c = b('<div style="position: relative;" id="statusrow' + this.element.id + '"></div>');
            var f = 0;
            var m = this.columns.records.length;
            var l = this.toThemeProperty("jqx-grid-cell");
            if (this.rtl) {
                l += " " + this.toThemeProperty("jqx-grid-cell-rtl");
                f = 0;
                c.css("border-left-width", "0px");
                this.aggregates.css("border-left-color", "transparent")
            }
            l += " " + this.toThemeProperty("jqx-grid-cell-pinned");
            var n = m + 10;
            var o = new Array();
            this.aggregates[0].cells = o;
            for (var h = 0; h < m; h++) {
                var g = this.columns.records[h];
                var i = this._calculateaggregate(g);
                var d = g.width;
                if (d < g.minwidth) {
                    d = g.minwidth
                }
                if (d > g.maxwidth) {
                    d = g.maxwidth
                }
                var e = l;
                if (g.cellsalign) {
                    e += " " + this.toThemeProperty("jqx-" + g.cellsalign + "-align")
                }
                var k = b('<div style="overflow: hidden; position: absolute; height: 100%;" class="' + e + '"></div>');
                c.append(k);
                k.css("left", f);
                if (!this.rtl) {
                    k.css("z-index", n--)
                } else {
                    k.css("z-index", n++);
                    if (h == 0) {
                        k.css("border-left-width", "0px")
                    }
                }
                k.width(d);
                k[0].style.left = f + "px";
                if (!(g.hidden && g.hideable)) {
                    f += d
                } else {
                    k.css("display", "none")
                }
                o[o.length] = k[0];
                this._updatecolumnaggregates(g, i, k)
            }
            if (b.jqx.browser.msie && b.jqx.browser.version < 8) {
                c.css("z-index", n--)
            }
            c.width(parseInt(f) + 2);
            c.height(this.aggregatesHeight);
            this.aggregates.children().remove();
            this.aggregates.append(c);
            this.aggregates.removeClass(this.toThemeProperty("jqx-widget-header"));
            this.aggregates.addClass(l);
            this.aggregates.css("border-bottom-color", "transparent");
            this.aggregates.css("border-top-width", "1px");
            if (this.rtl && this.hScrollBar.css("visibility") != "hidden") {
                this._renderhorizontalscroll()
            }
        }, destroy: function () {
            var h = this;
            if (h.columns && h.columns.records) {
                for (var f = 0; f < h.columns.records.length; f++) {
                    h._removecolumnhandlers(h.columns.records[f])
                }
            }
            h.removeHandler(b(document), "mouseup.pagerbuttonstop");
            h.removeHandler(b(document), "mouseup.pagerbuttonsbottom");
            h.removeHandler(h.content, "scroll");
            h.removeHandler(h.content, "mousedown");
            h.removeHandler(b(document), "mousedown.gridedit" + h.element.id);
            var g = "mousemove.resize" + h.element.id;
            var c = "mousedown.resize" + h.element.id;
            var e = "mouseup.resize" + h.element.id;
            h.removeHandler(b(document), g);
            h.removeHandler(b(document), c);
            h.removeHandler(b(document), e);
            var g = "mousemove.reorder" + h.element.id;
            var c = "mousedown.reorder" + h.element.id;
            var e = "mouseup.reorder" + h.element.id;
            h.removeHandler(b(document), g);
            h.removeHandler(b(document), c);
            h.removeHandler(b(document), e);
            if (h.filterable) {
                if (h.filterrow) {
                    for (var f = 0; f < h.filterrow[0].cells.length; f++) {
                        var k = h.filterrow[0].cells[f];
                        var j = b(k).find(".filterconditions");
                        var d = h.columns.records[f];
                        if (j.length > 0) {
                            j.jqxDropDownList("destroy")
                        }
                    }
                }
                if (h.filtercolumnsList) {
                    h.filtercolumnsList.jqxDropDownList("destroy")
                }
            }
            if (h.pageable) {
                if (h.pagershowrowscombotop && h.pagershowrowscombotop.jqxDropDownList) {
                    h.pagershowrowscombotop.jqxDropDownList("destroy")
                }
                if (h.pagershowrowscombobottom && h.pagershowrowscombobottom.jqxDropDownList) {
                    h.pagershowrowscombobottom.jqxDropDownList("destroy")
                }
                var l = h.pagerbuttonsbottom.find("a");
                h.removeHandler(l, "click");
                h.removeHandler(l, "mouseenter");
                h.removeHandler(l, "mouseleave");
                l.remove();
                var l = h.pagerbuttonstop.find("a");
                h.removeHandler(l, "click");
                h.removeHandler(l, "mouseenter");
                h.removeHandler(l, "mouseleave");
                l.remove();
                if (h.pagernexttop) {
                    h.pagernexttop.jqxButton("destroy");
                    h.pagerprevioustop.jqxButton("destroy");
                    h.pagernextbottom.jqxButton("destroy");
                    h.pagerpreviousbottom.jqxButton("destroy");
                    h.pagerfirsttop.jqxButton("destroy");
                    h.pagerfirstbottom.jqxButton("destroy");
                    h.pagerlasttop.jqxButton("destroy");
                    h.pagerlastbottom.jqxButton("destroy")
                }
            }
            h._removeHandlers();
            h.vScrollBar.jqxScrollBar("destroy");
            h.hScrollBar.jqxScrollBar("destroy");
            delete h.vScrollBar;
            delete h.hScrollBar;
            delete h._mousewheelfunc;
            b.jqx.utilities.resize(h.host, null, true);
            h.host.remove()
        }, propertiesChangedHandler: function (c, d, e) {
            if (e.width && e.height && Object.keys(e).length == 2) {
                c.refresh()
            }
        }, propertyChangedHandler: function (e, l, d, k) {
            if (this.isInitialized == undefined || this.isInitialized == false) {
                return
            }
            if (e.batchUpdate && e.batchUpdate.width && e.batchUpdate.height && Object.keys(e.batchUpdate).length == 2) {
                return
            }
            if (k !== d) {
                if (l == "filterable") {
                    e._render()
                } else {
                    if (l === "height") {
                        e.host.height(e.height);
                        e.host.width(e.width);
                        e._updatesize(false, true)
                    } else {
                        if (l === "width") {
                            e.host.height(e.height);
                            e.host.width(e.width);
                            e._updatesize(true, false)
                        } else {
                            if (l === "source") {
                                e.updateBoundData()
                            } else {
                                if (l === "columnGroups") {
                                    e._render()
                                } else {
                                    if (l === "columns") {
                                        e._columns = null;
                                        e._render()
                                    } else {
                                        if (l === "rtl") {
                                            e.content.css("left", "");
                                            e.columns = e._columns;
                                            e.vScrollBar.jqxScrollBar({rtl: k});
                                            e.hScrollBar.jqxScrollBar({rtl: k});
                                            e._render()
                                        } else {
                                            if (l === "pagerMode") {
                                                e.pagerMode = k;
                                                e._initpager()
                                            } else {
                                                if (l == "pageSizeOptions") {
                                                    e._initpager();
                                                    var j = false;
                                                    for (var f = 0; f < k.length; f++) {
                                                        if (parseInt(k[f]) == e.pageSize) {
                                                            j = true;
                                                            break
                                                        }
                                                    }
                                                    if (!j) {
                                                        b.jqx.set(e, [{pageSize: k[0]}])
                                                    }
                                                } else {
                                                    if (l == "pageSize") {
                                                        var g = e.dataview.pagenum * e.dataview.pagesize;
                                                        e.dataview.pagesize = e.pageSize;
                                                        var h = Math.floor(g / e.dataview.pagesize);
                                                        if (h !== e.dataview.pagenum || parseInt(k) !== parseInt(d)) {
                                                            e._raiseEvent("pageSizeChanged", {
                                                                pagenum: k,
                                                                oldpageSize: d,
                                                                pageSize: e.dataview.pagesize
                                                            });
                                                            var m = e.goToPage(h);
                                                            if (!m) {
                                                                if (!e.serverProcessing) {
                                                                    e.refresh()
                                                                } else {
                                                                    e.updateBoundData("pager")
                                                                }
                                                            }
                                                        }
                                                    } else {
                                                        if (l === "pagerPosition") {
                                                            e.refresh()
                                                        } else {
                                                            if (l === "selectionMode") {
                                                                e.selectionMode = k.toLowerCase()
                                                            } else {
                                                                if (l == "touchmode") {
                                                                    e.touchDevice = null;
                                                                    e._removeHandlers();
                                                                    e.touchDevice = null;
                                                                    e.vScrollBar.jqxScrollBar({touchMode: k});
                                                                    e.hScrollBar.jqxScrollBar({touchMode: k});
                                                                    e._updateTouchScrolling();
                                                                    e._arrange();
                                                                    e._updatecolumnwidths();
                                                                    e._renderrows();
                                                                    e._addHandlers()
                                                                } else {
                                                                    if (l == "enableHover") {
                                                                        return
                                                                    } else {
                                                                        if (l == "disabled") {
                                                                            if (k) {
                                                                                e.host.addClass(this.toThemeProperty("jqx-fill-state-disabled"))
                                                                            } else {
                                                                                e.host.removeClass(this.toThemeProperty("jqx-fill-state-disabled"))
                                                                            }
                                                                            if (e.pageable) {
                                                                                if (e.pagernexttop) {
                                                                                    e.pagernexttop.jqxButton({disabled: k});
                                                                                    e.pagerprevioustop.jqxButton({disabled: k});
                                                                                    e.pagernextbottom.jqxButton({disabled: k});
                                                                                    e.pagerpreviousbottom.jqxButton({disabled: k});
                                                                                    e.pagerfirsttop.jqxButton({disabled: k});
                                                                                    e.pagerfirstbottom.jqxButton({disabled: k});
                                                                                    e.pagerlasttop.jqxButton({disabled: k});
                                                                                    e.pagerlastbottom.jqxButton({disabled: k});
                                                                                    if (e.pagershowrowscombotop.jqxDropDownList) {
                                                                                        if (e.pagerMode == "advanced") {
                                                                                            e.pagershowrowscombotop.jqxDropDownList({disabled: false});
                                                                                            e.pagershowrowscombobottom.jqxDropDownList({disabled: false})
                                                                                        }
                                                                                    }
                                                                                }
                                                                                e.host.find(".jqx-grid-pager-number").css("cursor", k ? "default" : "pointer")
                                                                            }
                                                                            e.host.find(".jqx-grid-group-collapse").css("cursor", k ? "default" : "pointer");
                                                                            e.host.find(".jqx-grid-group-expand").css("cursor", k ? "default" : "pointer")
                                                                        } else {
                                                                            if (l == "columnsHeight") {
                                                                                e._render()
                                                                            } else {
                                                                                if (l == "theme") {
                                                                                    b.jqx.utilities.setTheme(d, k, e.host);
                                                                                    e.vScrollBar.jqxScrollBar({theme: e.theme});
                                                                                    e.hScrollBar.jqxScrollBar({theme: e.theme});
                                                                                    if (e.pageable && e.pagernexttop) {
                                                                                        e.pagernexttop.jqxButton({theme: e.theme});
                                                                                        e.pagerprevioustop.jqxButton({theme: e.theme});
                                                                                        e.pagernextbottom.jqxButton({theme: e.theme});
                                                                                        e.pagerpreviousbottom.jqxButton({theme: e.theme});
                                                                                        e.pagerfirsttop.jqxButton({theme: e.theme});
                                                                                        e.pagerfirstbottom.jqxButton({theme: e.theme});
                                                                                        e.pagerlasttop.jqxButton({theme: e.theme});
                                                                                        e.pagerlastbottom.jqxButton({theme: e.theme});
                                                                                        if (e.pagershowrowscombotop.jqxDropDownList) {
                                                                                            if (e.pagerMode == "advanced") {
                                                                                                e.pagershowrowscombotop.jqxDropDownList({theme: e.theme});
                                                                                                e.pagershowrowscombobottom.jqxDropDownList({theme: e.theme})
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                    if (e.filterable) {
                                                                                        var c = b(".filterconditions");
                                                                                        if (c.length > 0) {
                                                                                            c.jqxDropDownList({theme: e.theme})
                                                                                        }
                                                                                        if (e.filtercolumnsList) {
                                                                                            e.filtercolumnsList.jqxDropDownList({theme: e.theme})
                                                                                        }
                                                                                    }
                                                                                    e.refresh()
                                                                                } else {
                                                                                    e.refresh()
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }, _rendercolumnheader: function (f, g, c, d) {
            var e = "4px";
            if (d.columnGroups) {
                e = (c / 2 - this._columnheight / 2);
                if (e < 0) {
                    e = 4
                }
                e += "px"
            } else {
                if (this.columnsHeight != 25) {
                    e = (this.columnsHeight / 2 - this._columnheight / 2);
                    if (e < 0) {
                        e = 4
                    }
                    e += "px"
                }
            }
            return '<div style="overflow: hidden; text-overflow: ellipsis; text-align: ' + g + "; margin-left: 4px; margin-right: 4px; margin-bottom: " + e + "; margin-top: " + e + ';"><span style="text-overflow: ellipsis; cursor: default;">' + f + "</span></div>"
        }
    });

    function a(c, d) {
        this.owner = c;
        this.datafield = null;
        this.displayfield = null;
        this.text = "";
        this.sortable = true;
        this.editable = true;
        this.hidden = false;
        this.hideable = true;
        this.groupable = true;
        this.renderer = null;
        this.cellsRenderer = null;
        this.columntype = null;
        this.cellsFormat = "";
        this.align = "left";
        this.cellsalign = "left";
        this.width = "auto";
        this.minwidth = 25;
        this.maxwidth = "auto";
        this.pinned = false;
        this.visibleindex = -1;
        this.filterable = true;
        this.filter = null;
        this.resizable = true;
        this.draggable = true;
        this.initeditor = null;
        this.createeditor = null;
        this.destroyeditor = null;
        this.geteditorvalue = null;
        this.autoCellHeight = true;
        this.validation = null;
        this.classname = "";
        this.cellclassname = "";
        this.aggregates = null;
        this.aggregatesRenderer = null;
        this.rendered = null;
        this.exportable = true;
        this.nullable = true;
        this.columngroup = null;
        this.columntype = "textbox";
        this.getcolumnproperties = function () {
            return {
                nullable: this.nullable,
                sortable: this.sortable,
                hidden: this.hidden,
                groupable: this.groupable,
                width: this.width,
                align: this.align,
                editable: this.editable,
                minwidth: this.minwidth,
                maxwidth: this.maxwidth,
                resizable: this.resizable,
                datafield: this.datafield,
                text: this.text,
                exportable: this.exportable,
                cellsalign: this.cellsalign,
                pinned: this.pinned,
                cellsFormat: this.cellsFormat,
                columntype: this.columntype,
                classname: this.classname,
                cellclassname: this.cellclassname,
                menu: this.menu
            }
        }, this.setproperty = function (e, f) {
            if (this[e]) {
                var g = this[e];
                this[e] = f;
                this.owner._columnPropertyChanged(this, e, f, g)
            } else {
                if (this[e.toLowerCase()]) {
                    var g = this[e.toLowerCase()];
                    this[e.toLowerCase()] = f;
                    this.owner._columnPropertyChanged(this, e.toLowerCase(), f, g)
                }
            }
        };
        this._initfields = function (f) {
            if (f != null) {
                var e = this;
                if (b.jqx.hasProperty(f, "dataField")) {
                    this.datafield = b.jqx.get(f, "dataField")
                }
                if (b.jqx.hasProperty(f, "displayField")) {
                    this.displayfield = b.jqx.get(f, "displayField")
                } else {
                    this.displayfield = this.datafield
                }
                if (b.jqx.hasProperty(f, "columnType")) {
                    this.columntype = b.jqx.get(f, "columnType")
                }
                if (b.jqx.hasProperty(f, "validation")) {
                    this.validation = b.jqx.get(f, "validation")
                }
                if (b.jqx.hasProperty(f, "autoCellHeight")) {
                    this.autoCellHeight = b.jqx.get(f, "autoCellHeight")
                }
                if (b.jqx.hasProperty(f, "text")) {
                    this.text = b.jqx.get(f, "text")
                } else {
                    this.text = this.displayfield
                }
                if (b.jqx.hasProperty(f, "sortable")) {
                    this.sortable = b.jqx.get(f, "sortable")
                }
                if (b.jqx.hasProperty(f, "hidden")) {
                    this.hidden = b.jqx.get(f, "hidden")
                }
                if (b.jqx.hasProperty(f, "groupable")) {
                    this.groupable = b.jqx.get(f, "groupable")
                }
                if (b.jqx.hasProperty(f, "renderer")) {
                    this.renderer = b.jqx.get(f, "renderer")
                }
                if (b.jqx.hasProperty(f, "align")) {
                    this.align = b.jqx.get(f, "align")
                }
                if (b.jqx.hasProperty(f, "cellsAlign")) {
                    this.cellsalign = b.jqx.get(f, "cellsAlign")
                }
                if (b.jqx.hasProperty(f, "cellsFormat")) {
                    this.cellsFormat = b.jqx.get(f, "cellsFormat")
                }
                if (b.jqx.hasProperty(f, "width")) {
                    this.width = b.jqx.get(f, "width")
                }
                if (b.jqx.hasProperty(f, "minWidth")) {
                    this.minwidth = b.jqx.get(f, "minWidth")
                }
                if (b.jqx.hasProperty(f, "maxWidth")) {
                    this.maxwidth = b.jqx.get(f, "maxWidth")
                }
                if (b.jqx.hasProperty(f, "cellsRenderer")) {
                    this.cellsRenderer = b.jqx.get(f, "cellsRenderer")
                }
                if (b.jqx.hasProperty(f, "columnType")) {
                    this.columntype = b.jqx.get(f, "columnType")
                }
                if (b.jqx.hasProperty(f, "pinned")) {
                    this.pinned = b.jqx.get(f, "pinned")
                }
                if (b.jqx.hasProperty(f, "filterable")) {
                    this.filterable = b.jqx.get(f, "filterable")
                }
                if (b.jqx.hasProperty(f, "filter")) {
                    this.filter = b.jqx.get(f, "filter")
                }
                if (b.jqx.hasProperty(f, "resizable")) {
                    this.resizable = b.jqx.get(f, "resizable")
                }
                if (b.jqx.hasProperty(f, "draggable")) {
                    this.draggable = b.jqx.get(f, "draggable")
                }
                if (b.jqx.hasProperty(f, "editable")) {
                    this.editable = b.jqx.get(f, "editable")
                }
                if (b.jqx.hasProperty(f, "initEditor")) {
                    this.initeditor = b.jqx.get(f, "initEditor")
                }
                if (b.jqx.hasProperty(f, "createEditor")) {
                    this.createeditor = b.jqx.get(f, "createEditor")
                }
                if (b.jqx.hasProperty(f, "destroyEditor")) {
                    this.destroyeditor = b.jqx.get(f, "destroyEditor")
                }
                if (b.jqx.hasProperty(f, "getEditorValue")) {
                    this.geteditorvalue = b.jqx.get(f, "getEditorValue")
                }
                if (b.jqx.hasProperty(f, "className")) {
                    this.classname = b.jqx.get(f, "className")
                }
                if (b.jqx.hasProperty(f, "cellClassName")) {
                    this.cellclassname = b.jqx.get(f, "cellClassName")
                }
                if (b.jqx.hasProperty(f, "aggregates")) {
                    this.aggregates = b.jqx.get(f, "aggregates")
                }
                if (b.jqx.hasProperty(f, "aggregatesRenderer")) {
                    this.aggregatesRenderer = b.jqx.get(f, "aggregatesRenderer")
                }
                if (b.jqx.hasProperty(f, "rendered")) {
                    this.rendered = b.jqx.get(f, "rendered")
                }
                if (b.jqx.hasProperty(f, "exportable")) {
                    this.exportable = b.jqx.get(f, "exportable")
                }
                if (b.jqx.hasProperty(f, "nullable")) {
                    this.nullable = b.jqx.get(f, "nullable")
                }
                if (b.jqx.hasProperty(f, "columnGroup")) {
                    this.columngroup = b.jqx.get(f, "columnGroup")
                }
                if (!f instanceof String && !(typeof f == "string")) {
                    for (var g in f) {
                        if (!e.hasOwnProperty(g)) {
                            if (!e.hasOwnProperty(g.toLowerCase())) {
                                c.host.remove();
                                throw new Error("jqxDataTable: Invalid property name - " + g + ".")
                            }
                        }
                    }
                }
            }
        };
        this._initfields(d);
        return this
    }

    b.jqx.dataCollection = function (c) {
        this.records = new Array();
        this.owner = c;
        this.updating = false;
        this.beginUpdate = function () {
            this.updating = true
        };
        this.resumeupdate = function () {
            this.updating = false
        };
        this.clear = function () {
            this.records = new Array()
        };
        this.replace = function (e, d) {
            this.records[e] = d
        };
        this.isempty = function (d) {
            if (this.records[d] == undefined) {
                return true
            }
            return false
        };
        this.initialize = function (d) {
            if (d < 1) {
                d = 1
            }
            this.records[d - 1] = -1
        };
        this.length = function () {
            return this.records.length
        };
        this.indexOf = function (d) {
            return this.records.indexOf(d)
        };
        this.add = function (d) {
            if (d == null) {
                return false
            }
            this.records[this.records.length] = d;
            return true
        };
        this.insertAt = function (e, d) {
            if (e == null || e == undefined) {
                return false
            }
            if (d == null) {
                return false
            }
            if (e >= 0) {
                if (e < this.records.length) {
                    this.records.splice(e, 0, d);
                    return true
                } else {
                    return this.add(d)
                }
            }
            return false
        };
        this.remove = function (e) {
            if (e == null || e == undefined) {
                return false
            }
            var d = this.records.indexOf(e);
            if (d != -1) {
                this.records.splice(d, 1);
                return true
            }
            return false
        };
        this.removeAt = function (e) {
            if (e == null || e == undefined) {
                return false
            }
            if (e < 0) {
                return false
            }
            if (e < this.records.length) {
                var d = this.records[e];
                this.records.splice(e, 1);
                return true
            }
            return false
        };
        return this
    };
    b.jqx.dataView = function () {
        this.that = this;
        this.grid = null;
        this.records = [];
        this.rows = [];
        this.columns = [];
        this.filters = new Array();
        this.pagesize = 0;
        this.pagenum = 0;
        this.source = null;
        this.databind = function (y, p) {
            var w = y._source ? true : false;
            var g = null;
            this._sortData = null;
            this._sortHierarchyData = null;
            if (w) {
                g = y;
                y = y._source
            } else {
                g = new b.jqx.dataAdapter(y, {autoBind: false})
            }
            var e = function (m) {
                g.recordids = [];
                g.records = new Array();
                g.cachedrecords = new Array();
                g.originaldata = new Array();
                g._options.totalrecords = m.totalrecords;
                g._options.originaldata = m.originaldata;
                g._options.recordids = m.recordids;
                g._options.cachedrecords = new Array();
                g._options.pagenum = m.pagenum;
                g._options.pageable = m.pageable;
                if (y.type != undefined) {
                    g._options.type = y.type
                }
                if (y.formatdata != undefined) {
                    g._options.formatData = y.formatdata
                }
                if (y.contenttype != undefined) {
                    g._options.contentType = y.contenttype
                }
                if (y.async != undefined) {
                    g._options.async = y.async
                }
                if (y.updaterow != undefined) {
                    g._options.updaterow = y.updaterow
                }
                if (y.addrow != undefined) {
                    g._options.addrow = y.addrow
                }
                if (y.deleterow != undefined) {
                    g._options.deleterow = y.deleterow
                }
                if (m.pagesize == 0) {
                    m.pagesize = 10
                }
                g._options.pagesize = m.pagesize
            };
            var B = function (m) {
                m.originaldata = g.originaldata;
                m.records = g.records;
                m.hierarchy = g.hierarchy;
                if (!m.grid.serverProcessing) {
                    m._sortData = null;
                    m._sortfield = null;
                    m._filteredData = null;
                    m._sortHierarchyData = null
                }
                if (!m.hierarchy) {
                    m.hierarchy = new Array();
                    g.hierarchy = new Array()
                }
                if (g._source.totalrecords) {
                    m.totalrecords = g._source.totalrecords
                } else {
                    if (g._source.totalRecords) {
                        m.totalrecords = g._source.totalRecords
                    } else {
                        if (m.hierarchy.length !== 0) {
                            m.totalrecords = m.hierarchy.length
                        } else {
                            m.totalrecords = m.records.length
                        }
                    }
                }
                m.cachedrecords = g.cachedrecords
            };
            e(this);
            this.source = y;
            if (p !== undefined) {
                var k = p
            }
            var h = this;
            switch (y.datatype) {
                case"local":
                case"array":
                default:
                    if (y.localdata == null) {
                        y.localdata = []
                    }
                    if (y.localdata != null) {
                        g.unbindBindingUpdate(h.grid.element.id);
                        if ((!h.grid.autoBind && h.grid.isInitialized) || h.grid.autoBind) {
                            g.dataBind()
                        }
                        var n = function () {
                            B(h);
                            h.update()
                        };
                        n();
                        g.bindBindingUpdate(h.grid.element.id, n)
                    }
                    break;
                case"json":
                case"jsonp":
                case"xml":
                case"xhtml":
                case"script":
                case"text":
                case"csv":
                case"tab":
                    if (y.localdata != null) {
                        g.unbindBindingUpdate(h.grid.element.id);
                        if ((!h.grid.autoBind && h.grid.isInitialized) || h.grid.autoBind) {
                            g.dataBind()
                        }
                        var n = function (m) {
                            B(h);
                            h.update()
                        };
                        n();
                        g.bindBindingUpdate(h.grid.element.id, n);
                        return
                    }
                    var D = {};
                    var C = [];
                    var v = 0;
                    var E = {};
                    for (var j = 0; j < this.filters.length; j++) {
                        var f = this.filters[j].datafield;
                        var l = this.filters[j].filter;
                        if (!l.getfilters) {
                            continue
                        }
                        var i = l.getfilters();
                        E[f + "operator"] = l.operator;
                        for (var A = 0; A < i.length; A++) {
                            i[A].datafield = f;
                            var u = i[A].value;
                            if (i[A].type == "datefilter") {
                                if (i[A].value && i[A].value.toLocaleString) {
                                    var c = this.grid.getColumn(i[A].datafield);
                                    if (c && c.cellsformat) {
                                        var z = this.grid.source.formatDate(i[A].value, c.cellsformat, this.grid.gridlocalization);
                                        if (z) {
                                            E["filtervalue" + v] = z
                                        } else {
                                            E["filtervalue" + v] = i[A].value.toLocaleString()
                                        }
                                    } else {
                                        E["filtervalue" + v] = u.toString()
                                    }
                                } else {
                                    E["filtervalue" + v] = u.toString()
                                }
                            } else {
                                E["filtervalue" + v] = u.toString();
                                if (i[A].data) {
                                    E["filterid" + v] = i[A].data.toString()
                                }
                                if (i[A].id) {
                                    E["filterid" + v] = i[A].id.toString()
                                }
                            }
                            E["filtercondition" + v] = i[A].condition;
                            E["filteroperator" + v] = i[A].operator;
                            E["filterdatafield" + v] = f;
                            var t = {label: u.toString()};
                            if (i[A].data) {
                                t.value = i[A].data.toString()
                            }
                            if (i[A].id) {
                                t.value = i[A].id.toString()
                            } else {
                                t.value = u.toString()
                            }
                            t.condition = i[A].condition;
                            t.operator = i[A].operator == 0 ? "and" : "or";
                            t.field = f;
                            t.type = i[A].type;
                            var d = false;
                            if (C.length > 0) {
                                for (var s = 0; s < C.length; s++) {
                                    var r = C[s];
                                    if (r.field == f) {
                                        r.filters.push(t);
                                        d = true;
                                        break
                                    }
                                }
                            }
                            if (!d) {
                                C.push({field: f, filters: []});
                                C[C.length - 1].filters.push(t)
                            }
                            v++
                        }
                    }
                    E.filterGroups = C;
                    E.filterslength = v;
                    b.extend(E, {
                        sortdatafield: h.sortfield,
                        sortorder: h.sortfielddirection,
                        pagenum: h.pagenum,
                        pagesize: h.grid.pageSize
                    });
                    var F = g._options.data;
                    if (g._options.data) {
                        b.extend(g._options.data, E)
                    } else {
                        if (y.data) {
                            b.extend(E, y.data)
                        }
                        g._options.data = E
                    }
                    var n = function () {
                        var o = b.jqx.browser.msie && b.jqx.browser.version < 9;
                        var q = function () {
                            B(h);
                            h.update()
                        };
                        if (o) {
                            try {
                                q()
                            } catch (m) {
                            }
                        } else {
                            q()
                        }
                    };
                    g.unbindDownloadComplete(h.grid.element.id);
                    g.bindDownloadComplete(h.grid.element.id, n);
                    g._source.loaderror = function (q, m, o) {
                        n()
                    };
                    if ((!h.grid.autoBind && h.grid.isInitialized) || h.grid.autoBind) {
                        g.dataBind()
                    }
                    g._options.data = F
            }
        };
        this.addFilter = function (f, e) {
            this._sortData = null;
            this._sortHierarchyData = null;
            var d = -1;
            for (var c = 0; c < this.filters.length; c++) {
                if (this.filters[c].datafield == f) {
                    d = c;
                    break
                }
            }
            if (d == -1) {
                this.filters[this.filters.length] = {filter: e, datafield: f}
            } else {
                this.filters[d] = {filter: e, datafield: f}
            }
        };
        this.removeFilter = function (d) {
            this._sortData = null;
            this._sortHierarchyData = null;
            for (var c = 0; c < this.filters.length; c++) {
                if (this.filters[c].datafield == d) {
                    this.filters.splice(c, 1);
                    break
                }
            }
        };
        this.sortBy = function (e, c) {
            var d = this;
            if (c == null) {
                this.sortfield = "";
                this.sortfielddirection = "";
                return
            }
            if (c == undefined) {
                c = true
            }
            if (c == "a" || c == "asc" || c == "ascending" || c == true) {
                c = true
            } else {
                c = false
            }
            if (e == "constructor") {
                e = ""
            }
            this.sortfield = e;
            this.sortfielddirection = c ? "asc" : "desc"
        };
        this._sort = function (d) {
            if (!this.sortfield || !this.sortfielddirection) {
                return d
            }
            if (this._sortfield == this.sortfield && this._sortfielddirection == this.sortfielddirection && this._sortData) {
                return this._sortData
            }
            var g = this;
            var j = Object.prototype.toString;
            Object.prototype.toString = (typeof g.sortfield == "function") ? g.sortfield : function () {
                return this[g.sortfield]
            };
            var f = "";
            if (this.source.datafields) {
                b.each(this.source.datafields, function () {
                    if (this.name == g.sortfield) {
                        if (this.type) {
                            f = this.type
                        }
                        return false
                    }
                })
            }
            var c = new Array();
            for (var e = 0; e < d.length; e++) {
                c.push(b.extend({originalRecord: d[e]}, d[e]))
            }
            this._sortfield = this.sortfield;
            this._sortfielddirection = this.sortfielddirection;
            if (this.sortfielddirection === "desc") {
                var h = c.sort(function (k, i) {
                    return g._compare(k, i, f)
                }).reverse()
            } else {
                var h = c.sort(function (k, i) {
                    return g._compare(k, i, f)
                })
            }
            this._sortData = h;
            Object.prototype.toString = j;
            return h
        };
        this._compare = function (d, c, f) {
            var d = d;
            var c = c;
            if (d === undefined) {
                d = null
            }
            if (c === undefined) {
                c = null
            }
            if (d === null && c === null) {
                return 0
            }
            if (d === null && c !== null) {
                return 1
            }
            if (d !== null && c === null) {
                return 1
            }
            d = d.toString();
            c = c.toString();
            if (b.jqx.dataFormat) {
                if (f && f != "") {
                    switch (f) {
                        case"number":
                        case"int":
                        case"float":
                            if (d < c) {
                                return -1
                            }
                            if (d > c) {
                                return 1
                            }
                            return 0;
                        case"date":
                        case"time":
                            if (d < c) {
                                return -1
                            }
                            if (d > c) {
                                return 1
                            }
                            return 0;
                        case"string":
                        case"text":
                            d = String(d).toLowerCase();
                            c = String(c).toLowerCase();
                            break
                    }
                } else {
                    if (b.jqx.dataFormat.isNumber(d) && b.jqx.dataFormat.isNumber(c)) {
                        if (d < c) {
                            return -1
                        }
                        if (d > c) {
                            return 1
                        }
                        return 0
                    } else {
                        if (b.jqx.dataFormat.isDate(d) && b.jqx.dataFormat.isDate(c)) {
                            if (d < c) {
                                return -1
                            }
                            if (d > c) {
                                return 1
                            }
                            return 0
                        } else {
                            if (!b.jqx.dataFormat.isNumber(d) && !b.jqx.dataFormat.isNumber(c)) {
                                d = String(d).toLowerCase();
                                c = String(c).toLowerCase()
                            }
                        }
                    }
                }
            }
            try {
                if (d < c) {
                    return -1
                }
                if (d > c) {
                    return 1
                }
            } catch (e) {
                var g = e
            }
            return 0
        };
        this._equals = function (d, c) {
            return (this._compare(d, c) === 0)
        };
        this.evaluate = function (p) {
            if (this.grid.serverProcessing) {
                if (p) {
                    if (this.grid.source._source.id == "" || this.grid.source._source.id == null) {
                        if (this.grid.pageable) {
                            var c = this.grid.pageSize * this.pagenum;
                            this.grid.rowsByKey = new Array();
                            var h = this;
                            b.each(p, function (i) {
                                this.uid = c;
                                h.grid.rowsByKey[this.uid] = this;
                                c++
                            })
                        }
                    }
                }
                return p
            }
            var d = new Array();
            if (this.filters.length) {
                var j = new Array();
                var o = function (s, w) {
                    for (var u = 0; u < s.length; u++) {
                        var v = s[u];
                        v._visible = true;
                        var q = undefined;
                        for (var t = 0; t < this.filters.length; t++) {
                            var r = this.filters[t].filter;
                            var x = v[this.filters[t].datafield];
                            var y = r.evaluate(x);
                            if (q == undefined) {
                                q = y
                            } else {
                                if (r.operator == "or") {
                                    q = q || y
                                } else {
                                    q = q && y
                                }
                            }
                        }
                        v._visible = false;
                        if (q || v.aggregate) {
                            v._visible = true;
                            w.push(v);
                            j[v.uid] = v
                        }
                    }
                };
                if (!this._filteredData) {
                    if (this.source.hierarchy || (this.grid.source.hierarchy && this.grid.source.hierarchy.length > 0)) {
                        var n = new Array();
                        var k = function (r, s) {
                            for (var q = 0; q < s.length; q++) {
                                var t = s[q];
                                n.push(t);
                                if (t.records && t.records.length > 0) {
                                    k(t, t.records)
                                }
                            }
                        };
                        k(null, p);
                        o.call(this, n, d);
                        for (var e = 0; e < d.length; e++) {
                            var g = d[e];
                            while (g.parent) {
                                var m = g.parent;
                                if (!j[m.uid]) {
                                    m._visible = true;
                                    j[m.uid] = m
                                }
                                g = m
                            }
                        }
                        d = p
                    } else {
                        o.call(this, p, d)
                    }
                    this._filteredData = d;
                    this.rows = d
                } else {
                    this.rows = this._filteredData
                }
            } else {
                this.rows = p
            }
            if (this.source.hierarchy || (this.grid.source.hierarchy && this.grid.source.hierarchy.length > 0)) {
                var h = this;
                var l = new Array();
                this._sortData = null;
                var f = function (t, q) {
                    h._sortData = null;
                    var r = null;
                    if (h.source.hierarchy.groupingDataFields) {
                        if (q && q.length > 0 && q[0].level < h.source.hierarchy.groupingDataFields.length) {
                            r = new Array();
                            for (var s = 0; s < q.length; s++) {
                                r.push(b.extend({originalRecord: q[s]}, q[s]))
                            }
                        } else {
                            r = h._sort(q)
                        }
                    } else {
                        r = h._sort(q)
                    }
                    if (t.records) {
                        t.records = r
                    } else {
                        t = t.concat(r)
                    }
                    for (var s = 0; s < r.length; s++) {
                        if (r[s].records && r[s].records.length) {
                            f(r[s], r[s].records)
                        }
                    }
                    return t
                };
                if (this.sortfield || this.sortfielddirection) {
                    if (this._sortHierarchyData) {
                        l = this._sortHierarchyData
                    } else {
                        l = f(l, p)
                    }
                    this.rows = l;
                    this._sortHierarchyData = l
                }
            } else {
                this.rows = this._sort(this.rows)
            }
            return this.rows
        };
        this.getid = function (j, d, e) {
            if (b(j, d).length > 0) {
                return b(j, d).text()
            }
            if (this.rows && j != "" && j != undefined && this.rows.length > 0) {
                var h = this.rows[this.rows.length - 1][j];
                if (h == null) {
                    h = null
                }
                for (var f = 1; f <= 100; f++) {
                    var g = this.grid.rowsByKey[f + h];
                    if (!g) {
                        if (this.grid && this.grid.treeGrid && this.grid.treeGrid.virtualModeCreateRecords) {
                            var g = this.grid.rowsByKey["jqx" + h + f];
                            if (g) {
                                continue
                            }
                            return "jqx" + h + f
                        }
                        return h + f
                    }
                }
            }
            if (j != undefined) {
                if (j.toString().length > 0) {
                    var c = b(d).attr(j);
                    if (c != null && c.toString().length > 0) {
                        if (this.grid && this.grid.treeGrid && this.grid.treeGrid.virtualModeCreateRecords) {
                            return "jqx" + c
                        }
                        return c
                    }
                }
            }
            if (this.rows && this.rows.length > 0) {
                var g = this.grid.rowsByKey[e];
                if (g) {
                    var h = this.rows[this.rows.length - 1][j];
                    if (h == null) {
                        h = ""
                    }
                    for (var f = 1; f <= 1000; f++) {
                        var g = this.grid.rowsByKey[f + h];
                        if (!g) {
                            if (this.grid && this.grid.treeGrid && this.grid.treeGrid.virtualModeCreateRecords) {
                                var g = this.grid.rowsByKey["jqx" + h + f];
                                if (g) {
                                    continue
                                }
                                return "jqx" + h + f
                            }
                            return h + f
                        }
                    }
                }
            }
            if (this.grid && this.grid.treeGrid && this.grid.treeGrid.virtualModeCreateRecords) {
                var g = this.grid.rowsByKey["jqx" + e];
                if (!g) {
                    return "jqx" + e
                } else {
                    for (var f = e + 1; f <= 100; f++) {
                        var g = this.grid.rowsByKey["jqx" + f];
                        if (!g) {
                            var g = this.grid.rowsByKey["jqx" + f];
                            if (g) {
                                continue
                            }
                            return "jqx" + f
                        }
                    }
                }
            }
            return e
        };
        this.generatekey = function () {
            var c = function () {
                return (((1 + Math.random()) * 16) | 0)
            };
            return ("" + c() + c() + "-" + c() + "-" + c())
        };
        return this
    }
})(jqxBaseFramework);

