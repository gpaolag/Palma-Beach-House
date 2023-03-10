! function(e) {
    var t = {};

    function n(r) {
        if (t[r]) return t[r].exports;
        var o = t[r] = {
            i: r,
            l: !1,
            exports: {}
        };
        return e[r].call(o.exports, o, o.exports, n), o.l = !0, o.exports
    }
    n.m = e, n.c = t, n.d = function(e, t, r) {
        n.o(e, t) || Object.defineProperty(e, t, {
            enumerable: !0,
            get: r
        })
    }, n.r = function(e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(e, "__esModule", {
            value: !0
        })
    }, n.t = function(e, t) {
        if (1 & t && (e = n(e)), 8 & t) return e;
        if (4 & t && "object" == typeof e && e && e.__esModule) return e;
        var r = Object.create(null);
        if (n.r(r), Object.defineProperty(r, "default", {
                enumerable: !0,
                value: e
            }), 2 & t && "string" != typeof e)
            for (var o in e) n.d(r, o, function(t) {
                return e[t]
            }.bind(null, o));
        return r
    }, n.n = function(e) {
        var t = e && e.__esModule ? function() {
            return e.default
        } : function() {
            return e
        };
        return n.d(t, "a", t), t
    }, n.o = function(e, t) {
        return Object.prototype.hasOwnProperty.call(e, t)
    }, n.p = "", n(n.s = 33)
}([function(e, t) {
    e.exports = wp.element
}, function(e, t, n) {
    var r = n(14),
        o = n(15),
        i = n(16),
        a = n(18);
    e.exports = function(e, t) {
        return r(e) || o(e, t) || i(e, t) || a()
    }, e.exports.default = e.exports, e.exports.__esModule = !0
}, function(e, t) {
    e.exports = wp.blockEditor
}, function(e, t) {
    e.exports = wp.components
}, function(e, t) {
    e.exports = wp.data
}, function(e, t) {
    e.exports = wp.i18n
}, function(e, t, n) {
    var r = n(19),
        o = n(9),
        i = n(28),
        a = {
            lowerCaseAttributeNames: !1
        };

    function c(e, t) {
        if ("string" != typeof e) throw new TypeError("First argument must be a string");
        return "" === e ? [] : r(i(e, (t = t || {}).htmlparser2 || a), t)
    }
    c.domToReact = r, c.htmlToDOM = i, c.attributesToProps = o, e.exports = c, e.exports.default = c
}, function(e, t) {
    e.exports = function(e, t, n) {
        return t in e ? Object.defineProperty(e, t, {
            value: n,
            enumerable: !0,
            configurable: !0,
            writable: !0
        }) : e[t] = n, e
    }, e.exports.default = e.exports, e.exports.__esModule = !0
}, function(e, t) {
    e.exports = React
}, function(e, t, n) {
    var r = n(20),
        o = n(10),
        i = o.setStyleProp,
        a = r.html,
        c = r.svg,
        l = r.isCustomAttribute,
        s = Object.prototype.hasOwnProperty;
    e.exports = function(e) {
        var t, n, r, u;
        e = e || {};
        var p = {};
        for (t in e) r = e[t], l(t) ? p[t] = r : (n = t.toLowerCase(), s.call(a, n) ? p[(u = a[n]).propertyName] = !!(u.hasBooleanValue || u.hasOverloadedBooleanValue && !r) || r : s.call(c, t) ? p[(u = c[t]).propertyName] = r : o.PRESERVE_CUSTOM_ATTRIBUTES && (p[t] = r));
        return i(e.style, p), p
    }
}, function(e, t, n) {
    var r = n(8),
        o = n(24).default;
    var i = {
        reactCompat: !0
    };
    var a = r.version.split(".")[0] >= 16;
    e.exports = {
        PRESERVE_CUSTOM_ATTRIBUTES: a,
        invertObject: function(e, t) {
            if (!e || "object" != typeof e) throw new TypeError("First argument must be an object");
            var n, r, o = "function" == typeof t,
                i = {},
                a = {};
            for (n in e) r = e[n], o && (i = t(n, r)) && 2 === i.length ? a[i[0]] = i[1] : "string" == typeof r && (a[r] = n);
            return a
        },
        isCustomComponent: function(e, t) {
            if (-1 === e.indexOf("-")) return t && "string" == typeof t.is;
            switch (e) {
                case "annotation-xml":
                case "color-profile":
                case "font-face":
                case "font-face-src":
                case "font-face-uri":
                case "font-face-format":
                case "font-face-name":
                case "missing-glyph":
                    return !1;
                default:
                    return !0
            }
        },
        setStyleProp: function(e, t) {
            null != e && (t.style = o(e, i))
        }
    }
}, function(e, t, n) {
    for (var r, o = n(30), i = n(31), a = o.CASE_SENSITIVE_TAG_NAMES, c = i.Comment, l = i.Element, s = i.ProcessingInstruction, u = i.Text, p = {}, f = 0, d = a.length; f < d; f++) r = a[f], p[r.toLowerCase()] = r;

    function m(e) {
        for (var t, n = {}, r = 0, o = e.length; r < o; r++) n[(t = e[r]).name] = t.value;
        return n
    }

    function h(e) {
        var t = function(e) {
            return p[e]
        }(e = e.toLowerCase());
        return t || e
    }
    e.exports = {
        formatAttributes: m,
        formatDOM: function e(t, n, r) {
            n = n || null;
            for (var o = [], i = 0, a = t.length; i < a; i++) {
                var p, f = t[i];
                switch (f.nodeType) {
                    case 1:
                        (p = new l(h(f.nodeName), m(f.attributes))).children = e(f.childNodes, p);
                        break;
                    case 3:
                        p = new u(f.nodeValue);
                        break;
                    case 8:
                        p = new c(f.nodeValue);
                        break;
                    default:
                        continue
                }
                var d = o[i - 1] || null;
                d && (d.next = p), p.parent = n, p.prev = d, p.next = null, o.push(p)
            }
            return r && ((p = new s(r.substring(0, r.indexOf(" ")).toLowerCase(), r)).next = o[0] || null, p.parent = n, o.unshift(p), o[1] && (o[1].prev = o[0])), o
        },
        isIE: function() {
            return /(MSIE |Trident\/|Edge\/)/.test(navigator.userAgent)
        }
    }
}, function(e, t) {
    function n(t) {
        return "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? (e.exports = n = function(e) {
            return typeof e
        }, e.exports.default = e.exports, e.exports.__esModule = !0) : (e.exports = n = function(e) {
            return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
        }, e.exports.default = e.exports, e.exports.__esModule = !0), n(t)
    }
    e.exports = n, e.exports.default = e.exports, e.exports.__esModule = !0
}, function(e, t) {
    e.exports = wp.blocks
}, function(e, t) {
    e.exports = function(e) {
        if (Array.isArray(e)) return e
    }, e.exports.default = e.exports, e.exports.__esModule = !0
}, function(e, t) {
    e.exports = function(e, t) {
        var n = null == e ? null : "undefined" != typeof Symbol && e[Symbol.iterator] || e["@@iterator"];
        if (null != n) {
            var r, o, i = [],
                a = !0,
                c = !1;
            try {
                for (n = n.call(e); !(a = (r = n.next()).done) && (i.push(r.value), !t || i.length !== t); a = !0);
            } catch (e) {
                c = !0, o = e
            } finally {
                try {
                    a || null == n.return || n.return()
                } finally {
                    if (c) throw o
                }
            }
            return i
        }
    }, e.exports.default = e.exports, e.exports.__esModule = !0
}, function(e, t, n) {
    var r = n(17);
    e.exports = function(e, t) {
        if (e) {
            if ("string" == typeof e) return r(e, t);
            var n = Object.prototype.toString.call(e).slice(8, -1);
            return "Object" === n && e.constructor && (n = e.constructor.name), "Map" === n || "Set" === n ? Array.from(e) : "Arguments" === n || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n) ? r(e, t) : void 0
        }
    }, e.exports.default = e.exports, e.exports.__esModule = !0
}, function(e, t) {
    e.exports = function(e, t) {
        (null == t || t > e.length) && (t = e.length);
        for (var n = 0, r = new Array(t); n < t; n++) r[n] = e[n];
        return r
    }, e.exports.default = e.exports, e.exports.__esModule = !0
}, function(e, t) {
    e.exports = function() {
        throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")
    }, e.exports.default = e.exports, e.exports.__esModule = !0
}, function(e, t, n) {
    var r = n(8),
        o = n(9),
        i = n(10),
        a = i.setStyleProp;

    function c(e) {
        return i.PRESERVE_CUSTOM_ATTRIBUTES && "tag" === e.type && i.isCustomComponent(e.name, e.attribs)
    }
    e.exports = function e(t, n) {
        for (var i, l, s, u, p = (n = n || {}).library || r, f = p.cloneElement, d = p.createElement, m = p.isValidElement, h = [], b = "function" == typeof n.replace, g = n.trim, y = 0, v = t.length; y < v; y++)
            if (i = t[y], b && m(l = n.replace(i))) v > 1 && (l = f(l, {
                key: l.key || y
            })), h.push(l);
            else if ("text" !== i.type) {
            switch (s = i.attribs, c(i) ? a(s.style, s) : s && (s = o(s)), u = null, i.type) {
                case "script":
                case "style":
                    i.children[0] && (s.dangerouslySetInnerHTML = {
                        __html: i.children[0].data
                    });
                    break;
                case "tag":
                    "textarea" === i.name && i.children[0] ? s.defaultValue = i.children[0].data : i.children && i.children.length && (u = e(i.children, n));
                    break;
                default:
                    continue
            }
            v > 1 && (s.key = y), h.push(d(i.name, s, u))
        } else g ? i.data.trim() && h.push(i.data) : h.push(i.data);
        return 1 === h.length ? h[0] : h
    }
}, function(e, t, n) {
    var r = n(21),
        o = n(22),
        i = n(23),
        a = i.MUST_USE_PROPERTY,
        c = i.HAS_BOOLEAN_VALUE,
        l = i.HAS_NUMERIC_VALUE,
        s = i.HAS_POSITIVE_NUMERIC_VALUE,
        u = i.HAS_OVERLOADED_BOOLEAN_VALUE;

    function p(e, t) {
        return (e & t) === t
    }

    function f(e, t, n) {
        var r, o, i, f = e.Properties,
            d = e.DOMAttributeNames;
        for (o in f) r = d[o] || (n ? o : o.toLowerCase()), i = f[o], t[r] = {
            attributeName: r,
            propertyName: o,
            mustUseProperty: p(i, a),
            hasBooleanValue: p(i, c),
            hasNumericValue: p(i, l),
            hasPositiveNumericValue: p(i, s),
            hasOverloadedBooleanValue: p(i, u)
        }
    }
    var d = {};
    f(r, d);
    var m = {};
    f(o, m, !0);
    var h = {};
    f(r, h), f(o, h, !0);
    e.exports = {
        html: d,
        svg: m,
        properties: h,
        isCustomAttribute: RegExp.prototype.test.bind(new RegExp("^(data|aria)-[:A-Z_a-z\\u00C0-\\u00D6\\u00D8-\\u00F6\\u00F8-\\u02FF\\u0370-\\u037D\\u037F-\\u1FFF\\u200C-\\u200D\\u2070-\\u218F\\u2C00-\\u2FEF\\u3001-\\uD7FF\\uF900-\\uFDCF\\uFDF0-\\uFFFD\\-.0-9\\u00B7\\u0300-\\u036F\\u203F-\\u2040]*$"))
    }
}, function(e, t) {
    e.exports = {
        Properties: {
            autoFocus: 4,
            accept: 0,
            acceptCharset: 0,
            accessKey: 0,
            action: 0,
            allowFullScreen: 4,
            allowTransparency: 0,
            alt: 0,
            as: 0,
            async: 4,
            autoComplete: 0,
            autoPlay: 4,
            capture: 4,
            cellPadding: 0,
            cellSpacing: 0,
            charSet: 0,
            challenge: 0,
            checked: 5,
            cite: 0,
            classID: 0,
            className: 0,
            cols: 24,
            colSpan: 0,
            content: 0,
            contentEditable: 0,
            contextMenu: 0,
            controls: 4,
            controlsList: 0,
            coords: 0,
            crossOrigin: 0,
            data: 0,
            dateTime: 0,
            default: 4,
            defer: 4,
            dir: 0,
            disabled: 4,
            download: 32,
            draggable: 0,
            encType: 0,
            form: 0,
            formAction: 0,
            formEncType: 0,
            formMethod: 0,
            formNoValidate: 4,
            formTarget: 0,
            frameBorder: 0,
            headers: 0,
            height: 0,
            hidden: 4,
            high: 0,
            href: 0,
            hrefLang: 0,
            htmlFor: 0,
            httpEquiv: 0,
            icon: 0,
            id: 0,
            inputMode: 0,
            integrity: 0,
            is: 0,
            keyParams: 0,
            keyType: 0,
            kind: 0,
            label: 0,
            lang: 0,
            list: 0,
            loop: 4,
            low: 0,
            manifest: 0,
            marginHeight: 0,
            marginWidth: 0,
            max: 0,
            maxLength: 0,
            media: 0,
            mediaGroup: 0,
            method: 0,
            min: 0,
            minLength: 0,
            multiple: 5,
            muted: 5,
            name: 0,
            nonce: 0,
            noValidate: 4,
            open: 4,
            optimum: 0,
            pattern: 0,
            placeholder: 0,
            playsInline: 4,
            poster: 0,
            preload: 0,
            profile: 0,
            radioGroup: 0,
            readOnly: 4,
            referrerPolicy: 0,
            rel: 0,
            required: 4,
            reversed: 4,
            role: 0,
            rows: 24,
            rowSpan: 8,
            sandbox: 0,
            scope: 0,
            scoped: 4,
            scrolling: 0,
            seamless: 4,
            selected: 5,
            shape: 0,
            size: 24,
            sizes: 0,
            span: 24,
            spellCheck: 0,
            src: 0,
            srcDoc: 0,
            srcLang: 0,
            srcSet: 0,
            start: 8,
            step: 0,
            style: 0,
            summary: 0,
            tabIndex: 0,
            target: 0,
            title: 0,
            type: 0,
            useMap: 0,
            value: 0,
            width: 0,
            wmode: 0,
            wrap: 0,
            about: 0,
            datatype: 0,
            inlist: 0,
            prefix: 0,
            property: 0,
            resource: 0,
            typeof: 0,
            vocab: 0,
            autoCapitalize: 0,
            autoCorrect: 0,
            autoSave: 0,
            color: 0,
            itemProp: 0,
            itemScope: 4,
            itemType: 0,
            itemID: 0,
            itemRef: 0,
            results: 0,
            security: 0,
            unselectable: 0
        },
        DOMAttributeNames: {
            acceptCharset: "accept-charset",
            className: "class",
            htmlFor: "for",
            httpEquiv: "http-equiv"
        }
    }
}, function(e, t) {
    e.exports = {
        Properties: {
            accentHeight: 0,
            accumulate: 0,
            additive: 0,
            alignmentBaseline: 0,
            allowReorder: 0,
            alphabetic: 0,
            amplitude: 0,
            arabicForm: 0,
            ascent: 0,
            attributeName: 0,
            attributeType: 0,
            autoReverse: 0,
            azimuth: 0,
            baseFrequency: 0,
            baseProfile: 0,
            baselineShift: 0,
            bbox: 0,
            begin: 0,
            bias: 0,
            by: 0,
            calcMode: 0,
            capHeight: 0,
            clip: 0,
            clipPath: 0,
            clipRule: 0,
            clipPathUnits: 0,
            colorInterpolation: 0,
            colorInterpolationFilters: 0,
            colorProfile: 0,
            colorRendering: 0,
            contentScriptType: 0,
            contentStyleType: 0,
            cursor: 0,
            cx: 0,
            cy: 0,
            d: 0,
            decelerate: 0,
            descent: 0,
            diffuseConstant: 0,
            direction: 0,
            display: 0,
            divisor: 0,
            dominantBaseline: 0,
            dur: 0,
            dx: 0,
            dy: 0,
            edgeMode: 0,
            elevation: 0,
            enableBackground: 0,
            end: 0,
            exponent: 0,
            externalResourcesRequired: 0,
            fill: 0,
            fillOpacity: 0,
            fillRule: 0,
            filter: 0,
            filterRes: 0,
            filterUnits: 0,
            floodColor: 0,
            floodOpacity: 0,
            focusable: 0,
            fontFamily: 0,
            fontSize: 0,
            fontSizeAdjust: 0,
            fontStretch: 0,
            fontStyle: 0,
            fontVariant: 0,
            fontWeight: 0,
            format: 0,
            from: 0,
            fx: 0,
            fy: 0,
            g1: 0,
            g2: 0,
            glyphName: 0,
            glyphOrientationHorizontal: 0,
            glyphOrientationVertical: 0,
            glyphRef: 0,
            gradientTransform: 0,
            gradientUnits: 0,
            hanging: 0,
            horizAdvX: 0,
            horizOriginX: 0,
            ideographic: 0,
            imageRendering: 0,
            in: 0,
            in2: 0,
            intercept: 0,
            k: 0,
            k1: 0,
            k2: 0,
            k3: 0,
            k4: 0,
            kernelMatrix: 0,
            kernelUnitLength: 0,
            kerning: 0,
            keyPoints: 0,
            keySplines: 0,
            keyTimes: 0,
            lengthAdjust: 0,
            letterSpacing: 0,
            lightingColor: 0,
            limitingConeAngle: 0,
            local: 0,
            markerEnd: 0,
            markerMid: 0,
            markerStart: 0,
            markerHeight: 0,
            markerUnits: 0,
            markerWidth: 0,
            mask: 0,
            maskContentUnits: 0,
            maskUnits: 0,
            mathematical: 0,
            mode: 0,
            numOctaves: 0,
            offset: 0,
            opacity: 0,
            operator: 0,
            order: 0,
            orient: 0,
            orientation: 0,
            origin: 0,
            overflow: 0,
            overlinePosition: 0,
            overlineThickness: 0,
            paintOrder: 0,
            panose1: 0,
            pathLength: 0,
            patternContentUnits: 0,
            patternTransform: 0,
            patternUnits: 0,
            pointerEvents: 0,
            points: 0,
            pointsAtX: 0,
            pointsAtY: 0,
            pointsAtZ: 0,
            preserveAlpha: 0,
            preserveAspectRatio: 0,
            primitiveUnits: 0,
            r: 0,
            radius: 0,
            refX: 0,
            refY: 0,
            renderingIntent: 0,
            repeatCount: 0,
            repeatDur: 0,
            requiredExtensions: 0,
            requiredFeatures: 0,
            restart: 0,
            result: 0,
            rotate: 0,
            rx: 0,
            ry: 0,
            scale: 0,
            seed: 0,
            shapeRendering: 0,
            slope: 0,
            spacing: 0,
            specularConstant: 0,
            specularExponent: 0,
            speed: 0,
            spreadMethod: 0,
            startOffset: 0,
            stdDeviation: 0,
            stemh: 0,
            stemv: 0,
            stitchTiles: 0,
            stopColor: 0,
            stopOpacity: 0,
            strikethroughPosition: 0,
            strikethroughThickness: 0,
            string: 0,
            stroke: 0,
            strokeDasharray: 0,
            strokeDashoffset: 0,
            strokeLinecap: 0,
            strokeLinejoin: 0,
            strokeMiterlimit: 0,
            strokeOpacity: 0,
            strokeWidth: 0,
            surfaceScale: 0,
            systemLanguage: 0,
            tableValues: 0,
            targetX: 0,
            targetY: 0,
            textAnchor: 0,
            textDecoration: 0,
            textRendering: 0,
            textLength: 0,
            to: 0,
            transform: 0,
            u1: 0,
            u2: 0,
            underlinePosition: 0,
            underlineThickness: 0,
            unicode: 0,
            unicodeBidi: 0,
            unicodeRange: 0,
            unitsPerEm: 0,
            vAlphabetic: 0,
            vHanging: 0,
            vIdeographic: 0,
            vMathematical: 0,
            values: 0,
            vectorEffect: 0,
            version: 0,
            vertAdvY: 0,
            vertOriginX: 0,
            vertOriginY: 0,
            viewBox: 0,
            viewTarget: 0,
            visibility: 0,
            widths: 0,
            wordSpacing: 0,
            writingMode: 0,
            x: 0,
            xHeight: 0,
            x1: 0,
            x2: 0,
            xChannelSelector: 0,
            xlinkActuate: 0,
            xlinkArcrole: 0,
            xlinkHref: 0,
            xlinkRole: 0,
            xlinkShow: 0,
            xlinkTitle: 0,
            xlinkType: 0,
            xmlBase: 0,
            xmlns: 0,
            xmlnsXlink: 0,
            xmlLang: 0,
            xmlSpace: 0,
            y: 0,
            y1: 0,
            y2: 0,
            yChannelSelector: 0,
            z: 0,
            zoomAndPan: 0
        },
        DOMAttributeNames: {
            accentHeight: "accent-height",
            alignmentBaseline: "alignment-baseline",
            arabicForm: "arabic-form",
            baselineShift: "baseline-shift",
            capHeight: "cap-height",
            clipPath: "clip-path",
            clipRule: "clip-rule",
            colorInterpolation: "color-interpolation",
            colorInterpolationFilters: "color-interpolation-filters",
            colorProfile: "color-profile",
            colorRendering: "color-rendering",
            dominantBaseline: "dominant-baseline",
            enableBackground: "enable-background",
            fillOpacity: "fill-opacity",
            fillRule: "fill-rule",
            floodColor: "flood-color",
            floodOpacity: "flood-opacity",
            fontFamily: "font-family",
            fontSize: "font-size",
            fontSizeAdjust: "font-size-adjust",
            fontStretch: "font-stretch",
            fontStyle: "font-style",
            fontVariant: "font-variant",
            fontWeight: "font-weight",
            glyphName: "glyph-name",
            glyphOrientationHorizontal: "glyph-orientation-horizontal",
            glyphOrientationVertical: "glyph-orientation-vertical",
            horizAdvX: "horiz-adv-x",
            horizOriginX: "horiz-origin-x",
            imageRendering: "image-rendering",
            letterSpacing: "letter-spacing",
            lightingColor: "lighting-color",
            markerEnd: "marker-end",
            markerMid: "marker-mid",
            markerStart: "marker-start",
            overlinePosition: "overline-position",
            overlineThickness: "overline-thickness",
            paintOrder: "paint-order",
            panose1: "panose-1",
            pointerEvents: "pointer-events",
            renderingIntent: "rendering-intent",
            shapeRendering: "shape-rendering",
            stopColor: "stop-color",
            stopOpacity: "stop-opacity",
            strikethroughPosition: "strikethrough-position",
            strikethroughThickness: "strikethrough-thickness",
            strokeDasharray: "stroke-dasharray",
            strokeDashoffset: "stroke-dashoffset",
            strokeLinecap: "stroke-linecap",
            strokeLinejoin: "stroke-linejoin",
            strokeMiterlimit: "stroke-miterlimit",
            strokeOpacity: "stroke-opacity",
            strokeWidth: "stroke-width",
            textAnchor: "text-anchor",
            textDecoration: "text-decoration",
            textRendering: "text-rendering",
            underlinePosition: "underline-position",
            underlineThickness: "underline-thickness",
            unicodeBidi: "unicode-bidi",
            unicodeRange: "unicode-range",
            unitsPerEm: "units-per-em",
            vAlphabetic: "v-alphabetic",
            vHanging: "v-hanging",
            vIdeographic: "v-ideographic",
            vMathematical: "v-mathematical",
            vectorEffect: "vector-effect",
            vertAdvY: "vert-adv-y",
            vertOriginX: "vert-origin-x",
            vertOriginY: "vert-origin-y",
            wordSpacing: "word-spacing",
            writingMode: "writing-mode",
            xHeight: "x-height",
            xlinkActuate: "xlink:actuate",
            xlinkArcrole: "xlink:arcrole",
            xlinkHref: "xlink:href",
            xlinkRole: "xlink:role",
            xlinkShow: "xlink:show",
            xlinkTitle: "xlink:title",
            xlinkType: "xlink:type",
            xmlBase: "xml:base",
            xmlnsXlink: "xmlns:xlink",
            xmlLang: "xml:lang",
            xmlSpace: "xml:space"
        }
    }
}, function(e, t) {
    e.exports = {
        MUST_USE_PROPERTY: 1,
        HAS_BOOLEAN_VALUE: 4,
        HAS_NUMERIC_VALUE: 8,
        HAS_POSITIVE_NUMERIC_VALUE: 24,
        HAS_OVERLOADED_BOOLEAN_VALUE: 32
    }
}, function(e, t, n) {
    "use strict";
    var r = this && this.__importDefault || function(e) {
        return e && e.__esModule ? e : {
            default: e
        }
    };
    t.__esModule = !0;
    var o = r(n(25)),
        i = n(27);
    t.default = function(e, t) {
        var n = {};
        return e && "string" == typeof e ? (o.default(e, (function(e, r) {
            e && r && (n[i.camelCase(e, t)] = r)
        })), n) : n
    }
}, function(e, t, n) {
    var r = n(26);
    e.exports = function(e, t) {
        var n, o = null;
        if (!e || "string" != typeof e) return o;
        for (var i, a, c = r(e), l = "function" == typeof t, s = 0, u = c.length; s < u; s++) i = (n = c[s]).property, a = n.value, l ? t(i, a, n) : a && (o || (o = {}), o[i] = a);
        return o
    }
}, function(e, t) {
    var n = /\/\*[^*]*\*+([^/*][^*]*\*+)*\//g,
        r = /\n/g,
        o = /^\s*/,
        i = /^(\*?[-#/*\\\w]+(\[[0-9a-z_-]+\])?)\s*/,
        a = /^:\s*/,
        c = /^((?:'(?:\\'|.)*?'|"(?:\\"|.)*?"|\([^)]*?\)|[^};])+)/,
        l = /^[;\s]*/,
        s = /^\s+|\s+$/g;

    function u(e) {
        return e ? e.replace(s, "") : ""
    }
    e.exports = function(e, t) {
        if ("string" != typeof e) throw new TypeError("First argument must be a string");
        if (!e) return [];
        t = t || {};
        var s = 1,
            p = 1;

        function f(e) {
            var t = e.match(r);
            t && (s += t.length);
            var n = e.lastIndexOf("\n");
            p = ~n ? e.length - n : p + e.length
        }

        function d() {
            var e = {
                line: s,
                column: p
            };
            return function(t) {
                return t.position = new m(e), y(), t
            }
        }

        function m(e) {
            this.start = e, this.end = {
                line: s,
                column: p
            }, this.source = t.source
        }
        m.prototype.content = e;
        var h = [];

        function b(n) {
            var r = new Error(t.source + ":" + s + ":" + p + ": " + n);
            if (r.reason = n, r.filename = t.source, r.line = s, r.column = p, r.source = e, !t.silent) throw r;
            h.push(r)
        }

        function g(t) {
            var n = t.exec(e);
            if (n) {
                var r = n[0];
                return f(r), e = e.slice(r.length), n
            }
        }

        function y() {
            g(o)
        }

        function v(e) {
            var t;
            for (e = e || []; t = x();) !1 !== t && e.push(t);
            return e
        }

        function x() {
            var t = d();
            if ("/" == e.charAt(0) && "*" == e.charAt(1)) {
                for (var n = 2;
                    "" != e.charAt(n) && ("*" != e.charAt(n) || "/" != e.charAt(n + 1));) ++n;
                if (n += 2, "" === e.charAt(n - 1)) return b("End of comment missing");
                var r = e.slice(2, n - 2);
                return p += 2, f(r), e = e.slice(n), p += 2, t({
                    type: "comment",
                    comment: r
                })
            }
        }

        function O() {
            var e = d(),
                t = g(i);
            if (t) {
                if (x(), !g(a)) return b("property missing ':'");
                var r = g(c),
                    o = e({
                        type: "declaration",
                        property: u(t[0].replace(n, "")),
                        value: r ? u(r[0].replace(n, "")) : ""
                    });
                return g(l), o
            }
        }
        return y(),
            function() {
                var e, t = [];
                for (v(t); e = O();) !1 !== e && (t.push(e), v(t));
                return t
            }()
    }
}, function(e, t, n) {
    "use strict";
    t.__esModule = !0, t.camelCase = void 0;
    var r = /^--[a-zA-Z0-9-]+$/,
        o = /-([a-z])/g,
        i = /^[^-]+$/,
        a = /^-(webkit|moz|ms|o|khtml)-/,
        c = function(e, t) {
            return t.toUpperCase()
        },
        l = function(e, t) {
            return t + "-"
        };
    t.camelCase = function(e, t) {
        return void 0 === t && (t = {}),
            function(e) {
                return !e || i.test(e) || r.test(e)
            }(e) ? e : (e = e.toLowerCase(), t.reactCompat || (e = e.replace(a, l)), e.replace(o, c))
    }
}, function(e, t, n) {
    var r = n(29),
        o = n(11).formatDOM,
        i = /<(![a-zA-Z\s]+)>/;
    e.exports = function(e) {
        if ("string" != typeof e) throw new TypeError("First argument must be a string");
        if ("" === e) return [];
        var t, n = e.match(i);
        return n && n[1] && (t = n[1]), o(r(e), null, t)
    }
}, function(e, t, n) {
    var r = /<([a-zA-Z]+[0-9]?)/,
        o = /<head.*>/i,
        i = /<body.*>/i,
        a = function() {
            throw new Error("This browser does not support `document.implementation.createHTMLDocument`")
        },
        c = function() {
            throw new Error("This browser does not support `DOMParser.prototype.parseFromString`")
        };
    if ("function" == typeof window.DOMParser) {
        var l = new window.DOMParser;
        a = c = function(e, t) {
            return t && (e = "<" + t + ">" + e + "</" + t + ">"), l.parseFromString(e, "text/html")
        }
    }
    if (document.implementation) {
        var s = n(11).isIE,
            u = document.implementation.createHTMLDocument(s() ? "html-dom-parser" : void 0);
        a = function(e, t) {
            return t ? (u.documentElement.getElementsByTagName(t)[0].innerHTML = e, u) : (u.documentElement.innerHTML = e, u)
        }
    }
    var p, f = document.createElement("template");
    f.content && (p = function(e) {
        return f.innerHTML = e, f.content.childNodes
    }), e.exports = function(e) {
        var t, n, l, s, u = e.match(r);
        switch (u && u[1] && (t = u[1].toLowerCase()), t) {
            case "html":
                return n = c(e), o.test(e) || (l = n.getElementsByTagName("head")[0]) && l.parentNode.removeChild(l), i.test(e) || (l = n.getElementsByTagName("body")[0]) && l.parentNode.removeChild(l), n.getElementsByTagName("html");
            case "head":
            case "body":
                return s = a(e).getElementsByTagName(t), i.test(e) && o.test(e) ? s[0].parentNode.childNodes : s;
            default:
                return p ? p(e) : a(e, "body").getElementsByTagName("body")[0].childNodes
        }
    }
}, function(e, t) {
    e.exports = {
        CASE_SENSITIVE_TAG_NAMES: ["animateMotion", "animateTransform", "clipPath", "feBlend", "feColorMatrix", "feComponentTransfer", "feComposite", "feConvolveMatrix", "feDiffuseLighting", "feDisplacementMap", "feDropShadow", "feFlood", "feFuncA", "feFuncB", "feFuncG", "feFuncR", "feGaussainBlur", "feImage", "feMerge", "feMergeNode", "feMorphology", "feOffset", "fePointLight", "feSpecularLighting", "feSpotLight", "feTile", "feTurbulence", "foreignObject", "linearGradient", "radialGradient", "textPath"]
    }
}, function(e, t, n) {
    "use strict";
    var r, o = this && this.__extends || (r = function(e, t) {
            return (r = Object.setPrototypeOf || {
                    __proto__: []
                }
                instanceof Array && function(e, t) {
                    e.__proto__ = t
                } || function(e, t) {
                    for (var n in t) Object.prototype.hasOwnProperty.call(t, n) && (e[n] = t[n])
                })(e, t)
        }, function(e, t) {
            if ("function" != typeof t && null !== t) throw new TypeError("Class extends value " + String(t) + " is not a constructor or null");

            function n() {
                this.constructor = e
            }
            r(e, t), e.prototype = null === t ? Object.create(t) : (n.prototype = t.prototype, new n)
        }),
        i = this && this.__assign || function() {
            return (i = Object.assign || function(e) {
                for (var t, n = 1, r = arguments.length; n < r; n++)
                    for (var o in t = arguments[n]) Object.prototype.hasOwnProperty.call(t, o) && (e[o] = t[o]);
                return e
            }).apply(this, arguments)
        };
    Object.defineProperty(t, "__esModule", {
        value: !0
    }), t.cloneNode = t.hasChildren = t.isDocument = t.isDirective = t.isComment = t.isText = t.isCDATA = t.isTag = t.Element = t.Document = t.NodeWithChildren = t.ProcessingInstruction = t.Comment = t.Text = t.DataNode = t.Node = void 0;
    var a = n(32),
        c = new Map([
            [a.ElementType.Tag, 1],
            [a.ElementType.Script, 1],
            [a.ElementType.Style, 1],
            [a.ElementType.Directive, 1],
            [a.ElementType.Text, 3],
            [a.ElementType.CDATA, 4],
            [a.ElementType.Comment, 8],
            [a.ElementType.Root, 9]
        ]),
        l = function() {
            function e(e) {
                this.type = e, this.parent = null, this.prev = null, this.next = null, this.startIndex = null, this.endIndex = null
            }
            return Object.defineProperty(e.prototype, "nodeType", {
                get: function() {
                    var e;
                    return null !== (e = c.get(this.type)) && void 0 !== e ? e : 1
                },
                enumerable: !1,
                configurable: !0
            }), Object.defineProperty(e.prototype, "parentNode", {
                get: function() {
                    return this.parent
                },
                set: function(e) {
                    this.parent = e
                },
                enumerable: !1,
                configurable: !0
            }), Object.defineProperty(e.prototype, "previousSibling", {
                get: function() {
                    return this.prev
                },
                set: function(e) {
                    this.prev = e
                },
                enumerable: !1,
                configurable: !0
            }), Object.defineProperty(e.prototype, "nextSibling", {
                get: function() {
                    return this.next
                },
                set: function(e) {
                    this.next = e
                },
                enumerable: !1,
                configurable: !0
            }), e.prototype.cloneNode = function(e) {
                return void 0 === e && (e = !1), E(this, e)
            }, e
        }();
    t.Node = l;
    var s = function(e) {
        function t(t, n) {
            var r = e.call(this, t) || this;
            return r.data = n, r
        }
        return o(t, e), Object.defineProperty(t.prototype, "nodeValue", {
            get: function() {
                return this.data
            },
            set: function(e) {
                this.data = e
            },
            enumerable: !1,
            configurable: !0
        }), t
    }(l);
    t.DataNode = s;
    var u = function(e) {
        function t(t) {
            return e.call(this, a.ElementType.Text, t) || this
        }
        return o(t, e), t
    }(s);
    t.Text = u;
    var p = function(e) {
        function t(t) {
            return e.call(this, a.ElementType.Comment, t) || this
        }
        return o(t, e), t
    }(s);
    t.Comment = p;
    var f = function(e) {
        function t(t, n) {
            var r = e.call(this, a.ElementType.Directive, n) || this;
            return r.name = t, r
        }
        return o(t, e), t
    }(s);
    t.ProcessingInstruction = f;
    var d = function(e) {
        function t(t, n) {
            var r = e.call(this, t) || this;
            return r.children = n, r
        }
        return o(t, e), Object.defineProperty(t.prototype, "firstChild", {
            get: function() {
                var e;
                return null !== (e = this.children[0]) && void 0 !== e ? e : null
            },
            enumerable: !1,
            configurable: !0
        }), Object.defineProperty(t.prototype, "lastChild", {
            get: function() {
                return this.children.length > 0 ? this.children[this.children.length - 1] : null
            },
            enumerable: !1,
            configurable: !0
        }), Object.defineProperty(t.prototype, "childNodes", {
            get: function() {
                return this.children
            },
            set: function(e) {
                this.children = e
            },
            enumerable: !1,
            configurable: !0
        }), t
    }(l);
    t.NodeWithChildren = d;
    var m = function(e) {
        function t(t) {
            return e.call(this, a.ElementType.Root, t) || this
        }
        return o(t, e), t
    }(d);
    t.Document = m;
    var h = function(e) {
        function t(t, n, r, o) {
            void 0 === r && (r = []), void 0 === o && (o = "script" === t ? a.ElementType.Script : "style" === t ? a.ElementType.Style : a.ElementType.Tag);
            var i = e.call(this, o, r) || this;
            return i.name = t, i.attribs = n, i
        }
        return o(t, e), Object.defineProperty(t.prototype, "tagName", {
            get: function() {
                return this.name
            },
            set: function(e) {
                this.name = e
            },
            enumerable: !1,
            configurable: !0
        }), Object.defineProperty(t.prototype, "attributes", {
            get: function() {
                var e = this;
                return Object.keys(this.attribs).map((function(t) {
                    var n, r;
                    return {
                        name: t,
                        value: e.attribs[t],
                        namespace: null === (n = e["x-attribsNamespace"]) || void 0 === n ? void 0 : n[t],
                        prefix: null === (r = e["x-attribsPrefix"]) || void 0 === r ? void 0 : r[t]
                    }
                }))
            },
            enumerable: !1,
            configurable: !0
        }), t
    }(d);

    function b(e) {
        return a.isTag(e)
    }

    function g(e) {
        return e.type === a.ElementType.CDATA
    }

    function y(e) {
        return e.type === a.ElementType.Text
    }

    function v(e) {
        return e.type === a.ElementType.Comment
    }

    function x(e) {
        return e.type === a.ElementType.Directive
    }

    function O(e) {
        return e.type === a.ElementType.Root
    }

    function E(e, t) {
        var n;
        if (void 0 === t && (t = !1), y(e)) n = new u(e.data);
        else if (v(e)) n = new p(e.data);
        else if (b(e)) {
            var r = t ? k(e.children) : [],
                o = new h(e.name, i({}, e.attribs), r);
            r.forEach((function(e) {
                return e.parent = o
            })), e["x-attribsNamespace"] && (o["x-attribsNamespace"] = i({}, e["x-attribsNamespace"])), e["x-attribsPrefix"] && (o["x-attribsPrefix"] = i({}, e["x-attribsPrefix"])), n = o
        } else if (g(e)) {
            r = t ? k(e.children) : [];
            var c = new d(a.ElementType.CDATA, r);
            r.forEach((function(e) {
                return e.parent = c
            })), n = c
        } else if (O(e)) {
            r = t ? k(e.children) : [];
            var l = new m(r);
            r.forEach((function(e) {
                return e.parent = l
            })), e["x-mode"] && (l["x-mode"] = e["x-mode"]), n = l
        } else {
            if (!x(e)) throw new Error("Not implemented yet: " + e.type);
            var s = new f(e.name, e.data);
            null != e["x-name"] && (s["x-name"] = e["x-name"], s["x-publicId"] = e["x-publicId"], s["x-systemId"] = e["x-systemId"]), n = s
        }
        return n.startIndex = e.startIndex, n.endIndex = e.endIndex, n
    }

    function k(e) {
        for (var t = e.map((function(e) {
                return E(e, !0)
            })), n = 1; n < t.length; n++) t[n].prev = t[n - 1], t[n - 1].next = t[n];
        return t
    }
    t.Element = h, t.isTag = b, t.isCDATA = g, t.isText = y, t.isComment = v, t.isDirective = x, t.isDocument = O, t.hasChildren = function(e) {
        return Object.prototype.hasOwnProperty.call(e, "children")
    }, t.cloneNode = E
}, function(e, t, n) {
    "use strict";
    var r;
    Object.defineProperty(t, "__esModule", {
            value: !0
        }), t.Doctype = t.CDATA = t.Tag = t.Style = t.Script = t.Comment = t.Directive = t.Text = t.Root = t.isTag = t.ElementType = void 0,
        function(e) {
            e.Root = "root", e.Text = "text", e.Directive = "directive", e.Comment = "comment", e.Script = "script", e.Style = "style", e.Tag = "tag", e.CDATA = "cdata", e.Doctype = "doctype"
        }(r = t.ElementType || (t.ElementType = {})), t.isTag = function(e) {
            return e.type === r.Tag || e.type === r.Script || e.type === r.Style
        }, t.Root = r.Root, t.Text = r.Text, t.Directive = r.Directive, t.Comment = r.Comment, t.Script = r.Script, t.Style = r.Style, t.Tag = r.Tag, t.CDATA = r.CDATA, t.Doctype = r.Doctype
}, function(e, t, n) {
    "use strict";
    n.r(t);
    var r = n(7),
        o = n.n(r),
        i = n(12),
        a = n.n(i),
        c = n(0),
        l = n(2),
        s = n(13),
        u = n(4),
        p = n(1),
        f = n.n(p),
        d = n(3),
        m = n(5);

    function h(e, t) {
        var n = Object.keys(e);
        if (Object.getOwnPropertySymbols) {
            var r = Object.getOwnPropertySymbols(e);
            t && (r = r.filter((function(t) {
                return Object.getOwnPropertyDescriptor(e, t).enumerable
            }))), n.push.apply(n, r)
        }
        return n
    }

    function b(e) {
        for (var t = 1; t < arguments.length; t++) {
            var n = null != arguments[t] ? arguments[t] : {};
            t % 2 ? h(Object(n), !0).forEach((function(t) {
                o()(e, t, n[t])
            })) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(n)) : h(Object(n)).forEach((function(t) {
                Object.defineProperty(e, t, Object.getOwnPropertyDescriptor(n, t))
            }))
        }
        return e
    }
    var g = jQuery,
        y = function(e) {
            return g.ajax({
                url: ajaxurl,
                type: "POST",
                cache: !1,
                data: b({
                    action: "ctrlbp_blocks_fetch",
                    nonce: CTRLBPBlocks.nonce,
                    post_id: Object(u.select)("core/editor").getCurrentPostId()
                }, e),
                dataType: "html"
            })
        },
        v = jQuery,
        x = function(e) {
            var t = e.block,
                n = e.attributes,
                r = e.update,
                o = Object(c.useState)(!1),
                i = f()(o, 2),
                a = i[0],
                l = i[1],
                s = Object(c.useState)(""),
                p = f()(s, 2),
                m = p[0],
                h = p[1],
                b = Object(c.useRef)(),
                g = function() {
                    r(b.current);
                    var e = Object(u.select)("core/editor").getEditedPostAttribute("title");
                    Object(u.dispatch)("core/editor").editPost({
                        title: e
                    })
                };
            return Object(c.useEffect)((function() {
                l(!0), h(""), y({
                    block: t,
                    attributes: n,
                    mode: "edit"
                }).done((function(e) {
                    l(!1), h(e)
                }))
            }), []), Object(c.useEffect)((function() {
                if (m && !a) {
                    var e = t.replace("ctrlbp/", "");
                    return v(b.current).trigger("ctrlbp_ready").trigger("ctrlbp_blocks_edit").trigger("ctrlbp_blocks_edit/".concat(e)).trigger("ctrlbp-blocks-edit-ready").on("change keyup input ctrlbp_change", "input, textarea, select, button", _.debounce(g, 300)),
                        function() {
                            g(), v(b.current).off("change keyup input ctrlbp_change")
                        }
                }
            }), [m, a]), Object(c.createElement)("form", {
                ref: b,
                className: "ctrlbp-block-edit"
            }, a ? Object(c.createElement)(d.Placeholder, null, Object(c.createElement)(d.Spinner, null)) : Object(c.createElement)(c.RawHTML, null, m))
        },
        O = n(6),
        E = (O.domToReact, O.htmlToDOM, O.attributesToProps, O),
        k = jQuery,
        T = function(e) {
            var t = e.block,
                n = e.attributes,
                r = e.context,
                o = Object(c.useState)(!1),
                i = f()(o, 2),
                a = i[0],
                l = i[1],
                s = Object(c.useState)(""),
                u = f()(s, 2),
                p = u[0],
                h = u[1],
                b = Object(c.useRef)(),
                g = JSON.stringify(n);
            return Object(c.useEffect)((function() {
                l(!0), h(""), y({
                    block: t,
                    attributes: n,
                    mode: "preview"
                }).done((function(e) {
                    l(!1), h(e)
                }))
            }), [g]), Object(c.useEffect)((function() {
                if (p && !a) {
                    var e = t.replace("ctrlbp/", "");
                    k(b.current).trigger("ctrlbp_blocks_preview").trigger("ctrlbp_blocks_preview/".concat(e))
                }
            }), [p, a]), n.data && Object.keys(n.data).length > 0 ? Object(c.createElement)("div", {
                ref: b,
                className: "ctrlbp-block-preview ".concat(a ? " ctrlbp-block--fetching" : "")
            }, a ? Object(c.createElement)("div", {
                className: "ctrlbp-block__placeholder"
            }, Object(c.createElement)(d.Spinner, null)) : w(p)) : Object(c.createElement)("div", {
                ref: b,
                className: "ctrlbp-block-preview"
            }, Object(c.createElement)(d.Placeholder, null, "side" === r ? Object(m.__)("Enter content in the block settings on the right side.", "ctrlbp-blocks") : Object(m.__)("Click the Edit icon in the block toolbar to enter content.", "ctrlbp-blocks")))
        },
        w = function(e) {
            return E(e, {
                replace: S
            })
        },
        S = function(e) {
            if ("innerblocks" !== e.name) return e;
            var t = {},
                n = {
                    allowedblocks: "allowedBlocks",
                    templatelock: "templateLock"
                };
            return Object.entries(e.attribs).forEach((function(e) {
                var r, o = f()(e, 2),
                    i = o[0],
                    a = o[1],
                    c = n.hasOwnProperty(i) ? n[i] : i;
                try {
                    r = JSON.parse(a)
                } catch (e) {
                    r = a
                }
                t[c] = r
            })), Object(c.createElement)(l.InnerBlocks, t)
        },
        j = function(e) {
            var t = e.block,
                n = e.attributes,
                r = e.context,
                o = e.update,
                i = e.mode,
                a = Object(c.useState)("edit" === i),
                s = f()(a, 2),
                u = s[0],
                p = s[1];
            return Object(c.createElement)(c.Fragment, null, Object(c.createElement)(l.BlockControls, null, Object(c.createElement)(d.ToolbarButton, {
                icon: u ? "visibility" : "edit",
                title: u ? Object(m.__)("Preview", "ctrlbp-blocks") : Object(m.__)("Edit", "ctrlbp-blocks"),
                onClick: function() {
                    return p(!u)
                }
            })), u ? Object(c.createElement)(x, {
                block: t,
                attributes: n,
                update: o
            }) : Object(c.createElement)(T, {
                block: t,
                attributes: n,
                context: r
            }))
        },
        P = function(e) {
            var t = e.block,
                n = e.attributes,
                r = e.context,
                o = e.update;
            return Object(c.createElement)(c.Fragment, null, Object(c.createElement)(l.InspectorControls, null, Object(c.createElement)(x, {
                block: t,
                attributes: n,
                update: o
            })), Object(c.createElement)(T, {
                block: t,
                attributes: n,
                context: r
            }))
        };

    function A(e, t) {
        var n = Object.keys(e);
        if (Object.getOwnPropertySymbols) {
            var r = Object.getOwnPropertySymbols(e);
            t && (r = r.filter((function(t) {
                return Object.getOwnPropertyDescriptor(e, t).enumerable
            }))), n.push.apply(n, r)
        }
        return n
    }

    function C(e) {
        for (var t = 1; t < arguments.length; t++) {
            var n = null != arguments[t] ? arguments[t] : {};
            t % 2 ? A(Object(n), !0).forEach((function(t) {
                o()(e, t, n[t])
            })) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(n)) : A(Object(n)).forEach((function(t) {
                Object.defineProperty(e, t, Object.getOwnPropertyDescriptor(n, t))
            }))
        }
        return e
    }
    ctrlbp.blocks.forEach((function(e) {
        e = function(e) {
            if ("string" == typeof e.icon && "<svg" === e.icon.substr(0, 4)) e.icon = Object(c.createElement)(c.RawHTML, null, e.icon);
            else if ("string" == typeof e.icon && e.icon.includes("fa-")) {
                var t = '<i class="'.concat(e.icon, '"></i>');
                e.icon = Object(c.createElement)(c.RawHTML, null, t)
            } else if ("object" === a()(e.icon) && e.icon.src.includes("fa-")) {
                var n = '<i class="'.concat(e.icon.src, '"></i>');
                e.icon.src = Object(c.createElement)(c.RawHTML, null, n)
            }
            return e.attributes = {
                id: {
                    type: "string"
                },
                data: {
                    type: "object"
                }
            }, e.supports.html = !1, e.supports.anchor && (e.attributes.anchor = {
                type: "string"
            }), e
        }(e);
        var t = "ctrlbp/".concat(e.id);
        Object(s.registerBlockType)(t, C(C({}, e), {}, {
            getEditWrapperProps: function(e) {
                var t = e.align;
                if (["left", "right", "center", "wide", "full"].includes(t)) return {
                    "data-align": t
                }
            },
            edit: function(n) {
                var r = n.attributes,
                    o = n.setAttributes,
                    i = n.clientId,
                    a = function(e) {
                        if (e) {
                            var n = new FormData(e);
                            n.append("action", "ctrlbp_blocks_save"), n.append("post_id", Object(u.select)("core/editor").getCurrentPostId()), n.append("block", t), fetch(ajaxurl, {
                                method: "POST",
                                body: n
                            }).then((function(e) {
                                return e.json()
                            })).then((function(e) {
                                o({
                                    data: e.data
                                })
                            }))
                        }
                    };
                return r.id = "ctrlbp-block-".concat(i), "side" === e.context ? Object(c.createElement)(P, {
                    block: t,
                    attributes: r,
                    update: a,
                    context: "side"
                }) : Object(c.createElement)(j, {
                    block: t,
                    attributes: r,
                    update: a,
                    context: "normal",
                    mode: e.mode
                })
            },
            save: function() {
                return Object(c.createElement)(l.InnerBlocks.Content, null)
            }
        }))
    }))
}]);