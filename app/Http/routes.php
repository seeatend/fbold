<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
use Illuminate\Support\Str;
Route::get('update-user-avatar', function() {
    $objects = 
        '{
            "888": "https://ucarecdn.com/62215590-8c52-437e-9bb7-f56f7e98e84e/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "927": null,
            "942": null,
            "921": null,
            "946": "https://followback.com/assets/images/default-userpic.svg",
            "954": null,
            "922": "https://followback.com/assets/images/default-userpic.svg",
            "931": "https://ucarecdn.com/7108248e-c478-4d26-89bc-27dfef1c8439/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "928": null,
            "972": "https://ucarecdn.com/e942e962-cc65-42ce-b58a-d619189b69df/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "991": "https://followback.com/assets/images/default-userpic.svg",
            "1063": null,
            "983": null,
            "985": "https://followback.com/assets/images/default-userpic.svg",
            "1008": null,
            "1030": "https://followback.com/assets/images/default-userpic.svg",
            "1040": null,
            "1086": null,
            "1072": "https://ucarecdn.com/9c849c04-a6bc-48d7-bb04-26a1dfc31284/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1090": null,
            "1075": null,
            "1096": "https://followback.com/assets/images/default-userpic.svg",
            "1070": null,
            "1068": null,
            "1081": null,
            "1120": null,
            "1143": null,
            "1110": "https://followback.com/assets/images/default-userpic.svg",
            "1138": null,
            "1141": "https://followback.com/assets/images/default-userpic.svg",
            "1131": "https://ucarecdn.com/0c3ba059-2b9f-4ca7-be77-b92f20671c11/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1144": null,
            "1137": null,
            "1185": null,
            "1158": "https://followback.com/assets/images/default-userpic.svg",
            "1147": "https://ucarecdn.com/05b5973f-c0bc-428f-bf2d-2b417d955f41/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1177": null,
            "1189": null,
            "1182": null,
            "1187": "https://followback.com/assets/images/default-userpic.svg",
            "1164": null,
            "1224": null,
            "1204": null,
            "1230": null,
            "1233": null,
            "1226": "https://followback.com/assets/images/default-userpic.svg",
            "1229": null,
            "1206": null,
            "1215": "https://ucarecdn.com/02e2ced1-039f-4d51-b7c2-9c4a88434192/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1238": "https://followback.com/assets/images/default-userpic.svg",
            "1246": null,
            "1255": null,
            "1240": null,
            "1245": "https://followback.com/assets/images/default-userpic.svg",
            "1252": null,
            "1256": "https://followback.com/assets/images/default-userpic.svg",
            "1249": null,
            "1448": null,
            "1357": "https://followback.com/assets/images/default-userpic.svg",
            "1258": "https://followback.com/assets/images/default-userpic.svg",
            "1403": null,
            "1269": "https://ucarecdn.com/02072dfe-fea1-44ad-b9c3-3451b7e7e5e4/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1329": null,
            "1277": null,
            "1419": null,
            "1498": null,
            "1454": "https://followback.com/assets/images/default-userpic.svg",
            "1590": null,
            "1595": null,
            "1485": "https://ucarecdn.com/216283ea-4728-454c-ba3b-d08c2869fe47/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1593": null,
            "1592": "https://ucarecdn.com/332826fb-6c20-405a-a4ed-09978e7082a5/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1594": null,
            "1602": null,
            "1596": "https://followback.com/assets/images/default-userpic.svg",
            "1600": null,
            "1597": null,
            "1599": null,
            "1601": null,
            "1598": null,
            "1603": null,
            "1606": null,
            "1604": "https://followback.com/assets/images/default-userpic.svg",
            "1609": null,
            "1607": null,
            "1611": null,
            "1605": null,
            "1608": null,
            "1610": null,
            "1618": "https://followback.com/assets/images/default-userpic.svg",
            "1615": null,
            "1616": "https://followback.com/assets/images/default-userpic.svg",
            "1612": null,
            "1613": null,
            "1614": null,
            "1617": null,
            "1619": null,
            "1624": "https://followback.com/assets/images/default-userpic.svg",
            "1622": null,
            "1628": "https://followback.com/assets/images/default-userpic.svg",
            "1623": null,
            "1625": null,
            "1621": "https://followback.com/assets/images/default-userpic.svg",
            "1626": "https://followback.com/assets/images/default-userpic.svg",
            "1627": "https://followback.com/assets/images/default-userpic.svg",
            "1634": null,
            "1629": "https://followback.com/assets/images/default-userpic.svg",
            "1630": null,
            "1636": null,
            "1632": "https://followback.com/assets/images/default-userpic.svg",
            "1633": null,
            "1631": null,
            "1635": null,
            "1644": null,
            "1640": null,
            "1637": null,
            "1638": null,
            "1639": "https://followback.com/assets/images/default-userpic.svg",
            "1642": null,
            "1641": null,
            "1643": "https://followback.com/assets/images/default-userpic.svg",
            "1649": null,
            "1645": null,
            "1652": null,
            "1651": null,
            "1646": null,
            "1650": "https://followback.com/assets/images/default-userpic.svg",
            "1648": "https://followback.com/assets/images/default-userpic.svg",
            "1647": null,
            "1656": null,
            "1659": "https://followback.com/assets/images/default-userpic.svg",
            "1657": "https://ucarecdn.com/a79ca1fa-f9d9-4ed3-99b7-e2ca39088596/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1653": "https://followback.com/assets/images/default-userpic.svg",
            "1660": "https://followback.com/assets/images/default-userpic.svg",
            "1655": null,
            "1661": null,
            "1658": "https://ucarecdn.com/28a84ee2-de1b-4fcd-80b7-d83d30c5e234/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1666": null,
            "1664": "https://followback.com/assets/images/default-userpic.svg",
            "1662": null,
            "1669": null,
            "1665": "https://followback.com/assets/images/default-userpic.svg",
            "1663": null,
            "1667": null,
            "1668": null,
            "1671": null,
            "1672": null,
            "1673": null,
            "1675": null,
            "1676": "https://followback.com/assets/images/default-userpic.svg",
            "1670": null,
            "1677": null,
            "1674": null,
            "1678": null,
            "1685": null,
            "1682": null,
            "1680": null,
            "1683": null,
            "1684": "https://ucarecdn.com/c1d1c77d-0b64-4ae3-9711-e48158b0aa79/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1681": null,
            "1686": null,
            "1692": null,
            "1687": "https://ucarecdn.com/d8072ccc-fbde-4bf7-95c6-6d196771876b/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1689": null,
            "1690": null,
            "1694": null,
            "1688": "https://followback.com/assets/images/default-userpic.svg",
            "1693": null,
            "1691": null,
            "1696": null,
            "1697": null,
            "1695": null,
            "1698": null,
            "1700": null,
            "1701": null,
            "1702": null,
            "1699": null,
            "1706": null,
            "1703": "https://followback.com/assets/images/default-userpic.svg",
            "1708": null,
            "1707": "https://followback.com/assets/images/default-userpic.svg",
            "1704": null,
            "1710": null,
            "1705": "https://ucarecdn.com/fd6a26e4-649e-4bfc-b6bc-90e027710082/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1709": null,
            "1711": null,
            "1714": null,
            "1718": null,
            "1713": "https://ucarecdn.com/e75540b8-f37c-4599-aca8-98c9ed32d723/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1712": null,
            "1716": null,
            "1715": null,
            "1717": null,
            "1720": null,
            "1725": "https://followback.com/assets/images/default-userpic.svg",
            "1719": null,
            "1721": "https://followback.com/assets/images/default-userpic.svg",
            "1722": null,
            "1723": null,
            "1726": "https://followback.com/assets/images/default-userpic.svg",
            "1727": null,
            "1731": null,
            "1733": "https://followback.com/assets/images/default-userpic.svg",
            "1730": null,
            "1728": null,
            "1735": "https://followback.com/assets/images/default-userpic.svg",
            "1729": null,
            "1732": "https://ucarecdn.com/db38600c-5f79-4582-a1e4-959a133d28d0/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1734": "https://followback.com/assets/images/default-userpic.svg",
            "1736": null,
            "1737": null,
            "1738": null,
            "1740": "https://ucarecdn.com/0445089d-ad07-4df2-91db-b3306358eebf/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1739": null,
            "1743": null,
            "1741": null,
            "1742": null,
            "1751": null,
            "1744": null,
            "1750": "https://followback.com/assets/images/default-userpic.svg",
            "1747": null,
            "1752": null,
            "1748": null,
            "1749": "https://ucarecdn.com/596a32d9-8dde-486a-8057-e79b0edadfbb/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1746": null,
            "1755": "https://ucarecdn.com/12319317-1337-4690-8333-0808318ff353/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1759": "https://followback.com/assets/images/default-userpic.svg",
            "1753": null,
            "1757": null,
            "1758": null,
            "1756": "https://followback.com/assets/images/default-userpic.svg",
            "1754": "https://ucarecdn.com/3e4e83eb-ab8f-4383-ae71-2407e7bdc242/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1760": null,
            "1764": null,
            "1768": null,
            "1767": null,
            "1763": null,
            "1766": null,
            "1761": "https://followback.com/assets/images/default-userpic.svg",
            "1762": "https://followback.com/assets/images/default-userpic.svg",
            "1765": null,
            "1784": null,
            "1783": null,
            "1777": null,
            "1781": null,
            "1779": null,
            "1782": null,
            "1780": "https://followback.com/assets/images/default-userpic.svg",
            "1785": null,
            "1776": null,
            "1769": null,
            "1770": null,
            "1771": "https://followback.com/assets/images/default-userpic.svg",
            "1774": null,
            "1772": null,
            "1773": null,
            "1775": null,
            "1790": null,
            "1789": null,
            "1794": null,
            "1788": null,
            "1787": null,
            "1792": "https://followback.com/assets/images/default-userpic.svg",
            "1793": "https://followback.com/assets/images/default-userpic.svg",
            "1786": null,
            "1802": null,
            "1799": null,
            "1798": null,
            "1795": "https://ucarecdn.com/5be4bb9f-d32a-46af-b97e-523f27a378b4/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1801": null,
            "1797": null,
            "1800": null,
            "1796": null,
            "1806": null,
            "1807": null,
            "1808": null,
            "1805": null,
            "1803": null,
            "1809": "https://ucarecdn.com/8b827f7d-2578-48ef-8739-6aadb14a75da/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1804": "https://followback.com/assets/images/default-userpic.svg",
            "1810": null,
            "1812": null,
            "1813": null,
            "1814": null,
            "1811": null,
            "1815": "https://ucarecdn.com/002693eb-68e9-4c7b-8319-bc0707fe3a53/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1818": null,
            "1816": null,
            "1817": null,
            "1826": null,
            "1824": null,
            "1819": "https://followback.com/assets/images/default-userpic.svg",
            "1823": null,
            "1825": "https://ucarecdn.com/f5e07a1d-fd58-4e85-ae45-e3adba8418e6/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1820": null,
            "1821": "https://followback.com/assets/images/default-userpic.svg",
            "1822": null,
            "1834": null,
            "1830": null,
            "1829": null,
            "1827": null,
            "1833": null,
            "1828": null,
            "1832": null,
            "1835": null,
            "1843": null,
            "1838": null,
            "1840": null,
            "1836": null,
            "1839": null,
            "1841": null,
            "1837": "https://followback.com/assets/images/default-userpic.svg",
            "1842": null,
            "1848": "https://ucarecdn.com/92abd50a-adca-453f-9e50-f2c67f4bdcc9/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1849": null,
            "1846": "https://followback.com/assets/images/default-userpic.svg",
            "1847": null,
            "1845": null,
            "1850": "https://ucarecdn.com/a603721f-c179-4201-9c72-846c49610acb/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1844": null,
            "1851": null,
            "1860": null,
            "1852": null,
            "1856": "https://followback.com/assets/images/default-userpic.svg",
            "1858": null,
            "1855": null,
            "1854": null,
            "1857": null,
            "1853": "https://ucarecdn.com/4b5883ed-70cf-43d7-98a2-0087a8910a02/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1862": "https://followback.com/assets/images/default-userpic.svg",
            "1865": null,
            "1864": null,
            "1863": null,
            "1868": null,
            "1861": null,
            "1867": null,
            "1866": null,
            "1874": null,
            "1870": null,
            "1875": null,
            "1871": null,
            "1872": null,
            "1876": null,
            "1873": null,
            "1869": null,
            "1882": null,
            "1878": null,
            "1880": null,
            "1879": null,
            "1877": null,
            "1884": null,
            "1881": null,
            "1883": null,
            "1888": null,
            "1885": "https://followback.com/assets/images/default-userpic.svg",
            "1890": "https://ucarecdn.com/d4aae591-079f-4171-9cb0-bdb47bbbeb3b/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1887": null,
            "1889": null,
            "1893": "https://followback.com/assets/images/default-userpic.svg",
            "1891": null,
            "1894": null,
            "1900": null,
            "1899": null,
            "1901": null,
            "1895": null,
            "1902": null,
            "1896": "https://followback.com/assets/images/default-userpic.svg",
            "1897": null,
            "1898": null,
            "1903": null,
            "1906": null,
            "1905": null,
            "1907": null,
            "1908": null,
            "1909": null,
            "1904": null,
            "1910": null,
            "1911": null,
            "1918": null,
            "1916": null,
            "1912": null,
            "1913": "https://followback.com/assets/images/default-userpic.svg",
            "1917": null,
            "1914": "https://followback.com/assets/images/default-userpic.svg",
            "1915": null,
            "1921": null,
            "1926": null,
            "1927": null,
            "1925": null,
            "1920": "https://ucarecdn.com/cbf761e2-ee56-47fa-83a8-0a0b47c463a2/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1923": null,
            "1924": null,
            "1922": null,
            "1933": null,
            "1931": null,
            "1932": null,
            "1934": null,
            "1929": "https://ucarecdn.com/622e0931-7957-474a-9992-028528fd66f8/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1930": "https://ucarecdn.com/a71cba3b-a37d-4de1-b231-1fb71d16e9ab/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1935": null,
            "1928": null,
            "1944": null,
            "1941": null,
            "1936": "https://ucarecdn.com/ab1cb367-f06e-45b1-a773-c41de3f8bba0/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1938": null,
            "1942": null,
            "1937": null,
            "1939": "https://followback.com/assets/images/default-userpic.svg",
            "1943": null,
            "1947": null,
            "1950": null,
            "1946": null,
            "1949": null,
            "1948": null,
            "1945": null,
            "1951": null,
            "1952": null,
            "1953": null,
            "1954": null,
            "1955": null,
            "1962": null,
            "1960": null,
            "1961": null,
            "1958": null,
            "1956": null,
            "1967": null,
            "1964": null,
            "1965": null,
            "1963": null,
            "1969": null,
            "1966": null,
            "1970": null,
            "1968": null,
            "1974": null,
            "1978": "https://followback.com/assets/images/default-userpic.svg",
            "1972": "https://ucarecdn.com/bfb32335-eb3f-45a6-b5bb-88b7711413c6/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1973": "https://followback.com/assets/images/default-userpic.svg",
            "1971": "https://followback.com/assets/images/default-userpic.svg",
            "1975": null,
            "1976": null,
            "1977": null,
            "1979": null,
            "1988": null,
            "1986": null,
            "1983": null,
            "1982": null,
            "1981": null,
            "1984": null,
            "1987": null,
            "1989": "https://ucarecdn.com/60e39b82-f888-43c2-8332-2d527622b4e3/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1997": "https://ucarecdn.com/5392e120-841d-44c6-a7f1-558ce1279d36/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "1990": "https://followback.com/assets/images/default-userpic.svg",
            "1996": null,
            "1995": null,
            "1991": null,
            "1994": "https://followback.com/assets/images/default-userpic.svg",
            "1992": null,
            "1998": null,
            "1999": "https://ucarecdn.com/59e4e924-f005-4684-ba4d-b1acd9e33220/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2002": null,
            "2001": null,
            "2003": "https://followback.com/assets/images/default-userpic.svg",
            "2005": null,
            "2004": "https://followback.com/assets/images/default-userpic.svg",
            "2000": null,
            "2007": null,
            "2010": null,
            "2015": null,
            "2012": null,
            "2011": null,
            "2006": null,
            "2009": null,
            "2013": null,
            "2019": null,
            "2021": "https://followback.com/assets/images/default-userpic.svg",
            "2018": null,
            "2017": "https://followback.com/assets/images/default-userpic.svg",
            "2016": "https://ucarecdn.com/a4575b81-f1aa-4806-b1bf-bb1ef10eed34/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2020": "https://ucarecdn.com/4c166e1e-3c7d-476c-bdf8-0ff37a06ecd1/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2022": "https://followback.com/assets/images/default-userpic.svg",
            "2023": null,
            "2025": "https://followback.com/assets/images/default-userpic.svg",
            "2030": null,
            "2029": null,
            "2027": "https://ucarecdn.com/dcc67ea1-65f3-447c-ae12-1d12e04b9b12/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2031": null,
            "2032": null,
            "2028": null,
            "2024": "https://ucarecdn.com/29ebde5a-e544-4e43-8e94-b5840a157a0e/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2038": null,
            "2036": null,
            "2034": null,
            "2033": null,
            "2037": "https://followback.com/assets/images/default-userpic.svg",
            "2040": null,
            "2039": null,
            "2035": null,
            "2043": "https://followback.com/assets/images/default-userpic.svg",
            "2042": "https://followback.com/assets/images/default-userpic.svg",
            "2041": "https://ucarecdn.com/e261ee81-5bbb-42e0-b877-884b6cd3f005/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2044": "https://ucarecdn.com/9460bf09-6979-44dc-9470-09c47f94b9e4/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2048": null,
            "2047": null,
            "2045": null,
            "2046": null,
            "2050": null,
            "2053": null,
            "2055": null,
            "2049": null,
            "2054": null,
            "2058": "https://followback.com/assets/images/default-userpic.svg",
            "2057": null,
            "2056": null,
            "2060": "https://followback.com/assets/images/default-userpic.svg",
            "2067": null,
            "2068": null,
            "2069": null,
            "2061": null,
            "2062": "https://followback.com/assets/images/default-userpic.svg",
            "2059": null,
            "2065": null,
            "2072": null,
            "2077": null,
            "2070": null,
            "2074": null,
            "2076": null,
            "2071": null,
            "2075": null,
            "2073": null,
            "2081": "https://followback.com/assets/images/default-userpic.svg",
            "2082": null,
            "2084": null,
            "2083": null,
            "2078": null,
            "2085": null,
            "2087": null,
            "2086": null,
            "2088": null,
            "2097": null,
            "2091": null,
            "2090": null,
            "2092": null,
            "2094": "https://ucarecdn.com/3857d520-b80b-4352-8e09-0696ee8eec18/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2095": null,
            "2093": null,
            "2104": null,
            "2106": null,
            "2105": null,
            "2103": null,
            "2099": "https://followback.com/assets/images/default-userpic.svg",
            "2101": null,
            "2102": "https://followback.com/assets/images/default-userpic.svg",
            "2100": "https://ucarecdn.com/c4842b94-25a8-483c-bd51-f1478ed91e7c/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2108": null,
            "2115": null,
            "2111": null,
            "2107": null,
            "2112": null,
            "2109": null,
            "2114": "https://ucarecdn.com/206a4a19-c817-497f-a5e5-d0f3417c2e64/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2113": null,
            "2123": null,
            "2117": null,
            "2118": null,
            "2119": null,
            "2121": null,
            "2122": null,
            "2116": null,
            "2120": "https://ucarecdn.com/d7b8150a-99a9-4126-8306-7c054ca02ada/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2125": null,
            "2128": null,
            "2124": "https://ucarecdn.com/03032f65-f72b-49b3-97eb-303334bbb209/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2126": "https://followback.com/assets/images/default-userpic.svg",
            "2132": null,
            "2131": null,
            "2127": "https://followback.com/assets/images/default-userpic.svg",
            "2129": null,
            "2134": null,
            "2135": null,
            "2136": null,
            "2139": null,
            "2138": "https://followback.com/assets/images/default-userpic.svg",
            "2140": null,
            "2137": "https://followback.com/assets/images/default-userpic.svg",
            "2133": "https://followback.com/assets/images/default-userpic.svg",
            "2146": null,
            "2141": null,
            "2142": "https://ucarecdn.com/9023a52f-e9fe-4457-b0c2-6cfe2b2965c0/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2147": null,
            "2145": null,
            "2144": null,
            "2143": null,
            "2148": null,
            "2151": null,
            "2150": null,
            "2156": null,
            "2152": "https://ucarecdn.com/6cd52fba-3816-4fec-b6bb-5c189925e582/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2153": "https://followback.com/assets/images/default-userpic.svg",
            "2155": null,
            "2149": "https://ucarecdn.com/c9c6b7bd-036b-4bce-a4f6-a350c7c36882/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2154": "https://ucarecdn.com/5ef9faed-5a1d-4b3c-9976-f48b6196b128/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2165": null,
            "2167": null,
            "2166": null,
            "2158": "https://ucarecdn.com/748ee666-50b1-46e1-b03b-264274b2054f/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2163": "https://ucarecdn.com/b23542d4-8c1e-42ce-99e1-d0ae8c567233/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2168": null,
            "2161": "https://ucarecdn.com/45f7f18f-800d-456f-9097-d5dcd0e2b4ab/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2164": null,
            "2174": null,
            "2169": "https://ucarecdn.com/90f3594d-2f0b-4cb8-bf05-272e8b05488c/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2173": null,
            "2171": null,
            "2176": null,
            "2175": null,
            "2172": null,
            "2170": null,
            "2181": "https://ucarecdn.com/dd6ec944-4d13-448c-b7d0-1d04c44eda25/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2184": null,
            "2185": null,
            "2180": null,
            "2183": null,
            "2178": null,
            "2177": null,
            "2182": null,
            "2190": null,
            "2191": null,
            "2194": null,
            "2187": "https://ucarecdn.com/32221db0-0c7a-4dc8-9a48-898458d65bc9/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2188": null,
            "2192": null,
            "2186": null,
            "2189": null,
            "2195": null,
            "2200": null,
            "2205": null,
            "2198": null,
            "2196": null,
            "2201": null,
            "2204": null,
            "2203": null,
            "2206": null,
            "2208": "https://ucarecdn.com/b81559d9-4d76-4e23-8594-a8a6edad166e/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2210": null,
            "2207": "https://followback.com/assets/images/default-userpic.svg",
            "2213": null,
            "2209": null,
            "2211": null,
            "2212": null,
            "2214": null,
            "2215": null,
            "2216": null,
            "2218": null,
            "2219": null,
            "2222": "https://followback.com/assets/images/default-userpic.svg",
            "2220": null,
            "2223": null,
            "2226": null,
            "2229": null,
            "2225": "https://followback.com/assets/images/default-userpic.svg",
            "2224": null,
            "2227": null,
            "2230": null,
            "2228": null,
            "2231": null,
            "2239": null,
            "2232": null,
            "2234": "https://followback.com/assets/images/default-userpic.svg",
            "2238": "https://followback.com/assets/images/default-userpic.svg",
            "2241": null,
            "2235": null,
            "2240": null,
            "2237": null,
            "2242": null,
            "2244": null,
            "2243": null,
            "2245": null,
            "2249": null,
            "2248": null,
            "2246": null,
            "2247": "https://ucarecdn.com/60b0e58b-fbc0-4dd1-9e28-51b4b995ea96/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2250": "https://ucarecdn.com/bab5e53a-889f-47a7-83f7-acab6ee61fb6/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2251": null,
            "2254": null,
            "2255": null,
            "2252": null,
            "2257": null,
            "2253": null,
            "2256": null,
            "2263": null,
            "2258": "https://followback.com/assets/images/default-userpic.svg",
            "2260": "https://ucarecdn.com/9694c269-e082-4fa7-84d4-4e1241799cad/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2259": null,
            "2262": null,
            "2264": null,
            "2265": null,
            "2261": null,
            "2266": null,
            "2269": null,
            "2267": null,
            "2273": "https://ucarecdn.com/9903978e-3d9a-4049-9b07-32746734caa6/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2272": null,
            "2268": null,
            "2270": "https://ucarecdn.com/99b8a5f4-a330-49d2-913c-0db665472178/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2271": "https://ucarecdn.com/0eaf9352-123e-4fa3-983c-04964326b892/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2276": "https://ucarecdn.com/2ba5d203-d6f4-40de-a5b6-a0d949710272/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2279": null,
            "2274": null,
            "2277": "https://followback.com/assets/images/default-userpic.svg",
            "2275": "https://ucarecdn.com/ce3046f0-7983-41a6-8396-6711a6a39293/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2278": "https://followback.com/assets/images/default-userpic.svg",
            "2280": null,
            "2281": null,
            "2285": null,
            "2282": null,
            "2284": null,
            "2286": "https://followback.com/assets/images/default-userpic.svg",
            "2287": null,
            "2283": null,
            "2289": null,
            "2292": null,
            "2293": "https://followback.com/assets/images/default-userpic.svg",
            "2291": null,
            "2290": "https://ucarecdn.com/7ef7c4e1-1c0f-4e02-9f95-31e2565c9c12/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2298": null,
            "2296": "https://followback.com/assets/images/default-userpic.svg",
            "2295": null,
            "2297": null,
            "2302": null,
            "2305": null,
            "2299": null,
            "2304": null,
            "2303": "https://ucarecdn.com/77b2b065-8947-482c-866e-0cb47a8deca4/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2307": null,
            "2301": null,
            "2306": null,
            "2311": null,
            "2309": "https://followback.com/assets/images/default-userpic.svg",
            "2314": null,
            "2310": null,
            "2313": null,
            "2312": null,
            "2308": null,
            "2315": null,
            "2319": "https://followback.com/assets/images/default-userpic.svg",
            "2320": null,
            "2317": null,
            "2316": "https://ucarecdn.com/42474106-1931-4fe4-8bdf-4324bdfc2739/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2322": null,
            "2321": "https://followback.com/assets/images/default-userpic.svg",
            "2318": "https://ucarecdn.com/ec5c7cad-7893-4edb-8213-08e749840281/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2323": "https://followback.com/assets/images/default-userpic.svg",
            "2325": "https://ucarecdn.com/ed8e13aa-e5e0-47a5-81f6-0eff3bd5fc80/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2329": null,
            "2324": null,
            "2327": null,
            "2328": null,
            "2330": "https://ucarecdn.com/cb60d53e-e7b6-40ad-89de-b16bb6885416/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2331": null,
            "2332": null,
            "2334": "https://ucarecdn.com/0c1055e5-782b-4750-93f3-df22a23183bc/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2338": null,
            "2333": null,
            "2335": "https://ucarecdn.com/224d32fe-98d4-472f-9424-9fa805baa252/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2337": null,
            "2339": null,
            "2340": null,
            "2341": "https://ucarecdn.com/c446a854-6168-494b-8e8c-e8216cb30a1f/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2342": null,
            "2347": null,
            "2348": "https://ucarecdn.com/c79a9ee4-99e2-4a08-bc27-da51c30e48f6/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2346": null,
            "2349": "https://ucarecdn.com/6276800b-69f6-42f7-bcef-26054453d24e/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2345": "https://followback.com/assets/images/default-userpic.svg",
            "2351": "https://followback.com/assets/images/default-userpic.svg",
            "2354": null,
            "2352": null,
            "2358": "https://ucarecdn.com/5fb28df5-9b94-4a7a-8761-e6d3a34cbf7b/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2357": null,
            "2355": "https://ucarecdn.com/fb5c527e-82aa-413b-907e-272f6d284ccb/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2350": "https://ucarecdn.com/4f650be6-8a86-46ee-9e9b-c8cc3d375748/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2356": null,
            "2359": "https://ucarecdn.com/8f28b3cb-eb29-4ff4-b7c8-594e1a27dfa4/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2362": "https://ucarecdn.com/c85b0293-8781-472e-bcdf-20f8cc5be488/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2360": null,
            "2361": null,
            "2366": null,
            "2364": "https://ucarecdn.com/c8418a80-3c27-48d7-b24b-73b3324f99d0/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2365": null,
            "2363": "https://followback.com/assets/images/default-userpic.svg",
            "2368": null,
            "2367": null,
            "2373": null,
            "2371": null,
            "2370": null,
            "2372": null,
            "2375": null,
            "2374": null,
            "2378": null,
            "2380": null,
            "2379": null,
            "2376": null,
            "2382": null,
            "2381": "https://followback.com/assets/images/default-userpic.svg",
            "2383": null,
            "2377": null,
            "2390": "https://followback.com/assets/images/default-userpic.svg",
            "2385": "https://ucarecdn.com/1b668f06-3808-4e1e-91a5-c488e5a73f28/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2386": null,
            "2387": null,
            "2384": null,
            "2389": null,
            "2392": null,
            "2388": "https://ucarecdn.com/7749a933-0e2e-4c58-8df6-408379a20c68/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2404": null,
            "2397": "https://ucarecdn.com/73a875ad-db82-4ab7-bac2-ca59f89be547/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2395": "https://ucarecdn.com/36e312ae-f175-450b-94ea-442c435786a1/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2398": null,
            "2403": null,
            "2400": "https://ucarecdn.com/1ef668b4-0208-4c78-96c7-b7c6a80cdd98/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2399": null,
            "2401": null,
            "2410": null,
            "2408": null,
            "2406": "https://ucarecdn.com/e8e1f28c-67a0-4d11-a112-766c2777b52e/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2412": "https://ucarecdn.com/d951e11b-911e-4eb8-99af-5699710f21c8/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2409": "https://followback.com/assets/images/default-userpic.svg",
            "2405": null,
            "2407": "https://followback.com/assets/images/default-userpic.svg",
            "2411": null,
            "2413": "https://ucarecdn.com/be5de025-bbec-460a-a20c-373966fc5cc4/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2416": null,
            "2415": "https://ucarecdn.com/ab35e25b-fb1e-4942-b809-6e0025a370ae/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2414": "https://ucarecdn.com/865602e2-18cd-4403-8822-93f816c99bee/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2418": null,
            "2419": null,
            "2417": null,
            "2420": null,
            "2421": null,
            "2422": null,
            "2429": null,
            "2425": null,
            "2423": null,
            "2427": null,
            "2424": null,
            "2428": null,
            "2432": null,
            "2436": null,
            "2434": null,
            "2437": null,
            "2435": null,
            "2431": null,
            "2438": null,
            "2433": null,
            "2444": null,
            "2445": null,
            "2439": "https://ucarecdn.com/b6abbf9c-9fbe-48f1-986b-bcb9a3ea8198/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2441": null,
            "2442": null,
            "2443": "https://ucarecdn.com/0571854c-1624-49e0-96c1-a8f3cd5f7e78/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2446": null,
            "2440": null,
            "2448": "https://ucarecdn.com/d4d3a815-b7fc-43b4-97e3-2687624e4bb0/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2453": "https://followback.com/assets/images/default-userpic.svg",
            "2447": null,
            "2449": null,
            "2452": "https://ucarecdn.com/81619ae0-5c82-42eb-b42f-f956568e9323/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2451": "https://followback.com/assets/images/default-userpic.svg",
            "2450": "https://ucarecdn.com/a8e4fec9-4290-47ca-a1db-72fb878d795d/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2454": null,
            "2462": null,
            "2455": "https://ucarecdn.com/3490b193-5d35-4325-99d0-8780056fc5c3/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2458": null,
            "2459": null,
            "2456": null,
            "2460": null,
            "2457": null,
            "2461": null,
            "2467": null,
            "2464": null,
            "2468": "https://followback.com/assets/images/default-userpic.svg",
            "2463": "https://followback.com/assets/images/default-userpic.svg",
            "2466": "https://ucarecdn.com/b20c17cd-f10f-4711-9481-37b1ad9610fc/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2469": "https://ucarecdn.com/073d3209-cb88-405c-8f07-111a5d565146/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2470": null,
            "2471": null,
            "2473": null,
            "2474": "https://ucarecdn.com/9cda062e-1e27-4f67-aa81-882055e5d2a9/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2477": null,
            "2475": null,
            "2476": null,
            "2478": null,
            "2472": null,
            "2479": null,
            "2484": null,
            "2480": null,
            "2486": null,
            "2482": null,
            "2481": null,
            "2483": "https://ucarecdn.com/26c58f08-7995-498b-b316-4feb59d3dae7/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2485": null,
            "2487": null,
            "2489": null,
            "2494": null,
            "2493": null,
            "2496": "https://ucarecdn.com/cc328d6f-fd23-48e0-a744-6c213c71b866/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2495": null,
            "2490": "https://followback.com/assets/images/default-userpic.svg",
            "2491": null,
            "2492": null,
            "2498": null,
            "2500": "https://ucarecdn.com/a60ef0fc-b8da-4350-9c5b-62235062a454/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2499": "https://ucarecdn.com/5b950809-b302-4859-ada2-c0418d533fd5/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2497": null,
            "2503": null,
            "2502": "https://followback.com/assets/images/default-userpic.svg",
            "2501": "https://followback.com/assets/images/default-userpic.svg",
            "2504": null,
            "2508": null,
            "2512": null,
            "2513": null,
            "2510": "https://followback.com/assets/images/default-userpic.svg",
            "2505": null,
            "2507": null,
            "2506": "https://ucarecdn.com/343ae3ba-c81d-44fd-908f-dee1ce20b469/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2511": "https://followback.com/assets/images/default-userpic.svg",
            "2515": null,
            "2520": "https://followback.com/assets/images/default-userpic.svg",
            "2522": null,
            "2514": null,
            "2519": null,
            "2517": "https://ucarecdn.com/c4c8956f-e0e3-4228-ba5b-a394716ad6fd/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2518": null,
            "2521": null,
            "2525": "https://ucarecdn.com/575f8bc8-a18e-46be-80fa-34811f6145ab/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2529": null,
            "2531": null,
            "2524": null,
            "2533": null,
            "2527": null,
            "2532": null,
            "2526": null,
            "2535": null,
            "2539": null,
            "2538": "https://ucarecdn.com/acf2aa77-dd56-4dc3-af01-88a09800c268/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2534": null,
            "2542": null,
            "2540": null,
            "2536": "https://ucarecdn.com/e9476a5f-44e3-4a6c-a704-1f946ddbe2c0/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2541": null,
            "2547": null,
            "2544": null,
            "2545": "https://followback.com/assets/images/default-userpic.svg",
            "2549": null,
            "2546": null,
            "2543": "https://ucarecdn.com/5001ccdc-035a-4397-b307-569bf0c82721/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2548": null,
            "2551": null,
            "2552": null,
            "2558": null,
            "2557": null,
            "2559": null,
            "2560": "https://ucarecdn.com/97635126-3296-4351-845d-42d6a6b4419a/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2556": "https://followback.com/assets/images/default-userpic.svg",
            "2554": "https://followback.com/assets/images/default-userpic.svg",
            "2555": null,
            "2562": null,
            "2561": null,
            "2567": null,
            "2564": "https://followback.com/assets/images/default-userpic.svg",
            "2566": "https://followback.com/assets/images/default-userpic.svg",
            "2568": null,
            "2565": null,
            "2563": null,
            "2570": "https://followback.com/assets/images/default-userpic.svg",
            "2573": null,
            "2571": null,
            "2569": null,
            "2576": null,
            "2572": null,
            "2574": null,
            "2575": null,
            "2583": null,
            "2578": null,
            "2581": null,
            "2577": null,
            "2582": null,
            "2579": null,
            "2584": "https://ucarecdn.com/bcabca84-cb7a-48cd-a3ed-cfd56ba40aec/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2585": "https://ucarecdn.com/29fd5e92-1044-4b84-88e2-f770e1b59144/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2591": null,
            "2593": null,
            "2588": "https://ucarecdn.com/0ce6d59c-02ce-4d2c-96af-96f5d175dad0/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2590": null,
            "2587": "https://ucarecdn.com/d374606a-fdc5-4969-89dd-980a225b8828/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2592": null,
            "2589": "https://ucarecdn.com/c7380806-6e2c-4558-8052-12d19b78c1ea/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2586": null,
            "2600": null,
            "2601": null,
            "2599": null,
            "2598": "https://ucarecdn.com/871625e1-2bc5-4736-b06a-30419cfeed19/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2597": null,
            "2595": null,
            "2596": null,
            "2594": null,
            "2607": null,
            "2603": null,
            "2606": null,
            "2609": null,
            "2604": null,
            "2608": null,
            "2602": null,
            "2605": null,
            "2611": "https://ucarecdn.com/f8ad5988-2af0-4d99-b038-440f80275ee8/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2610": null,
            "2613": null,
            "2616": "https://ucarecdn.com/9768450f-5203-4b43-a01d-a80b94dd337d/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2612": "https://followback.com/assets/images/default-userpic.svg",
            "2617": "https://followback.com/assets/images/default-userpic.svg",
            "2614": null,
            "2615": "https://ucarecdn.com/52b0a365-2a64-4318-a9c7-00807d21bc57/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2618": "https://ucarecdn.com/b5508dc3-fa62-453c-93c7-caa8753272ad/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2621": null,
            "2622": "https://followback.com/assets/images/default-userpic.svg",
            "2623": "https://followback.com/assets/images/default-userpic.svg",
            "2627": null,
            "2619": "https://ucarecdn.com/3b4001b5-5a76-4d3d-ae85-81fccf00f57a/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2620": "https://followback.com/assets/images/default-userpic.svg",
            "2625": null,
            "2629": null,
            "2634": "https://followback.com/assets/images/default-userpic.svg",
            "2630": null,
            "2635": "https://followback.com/assets/images/default-userpic.svg",
            "2628": "https://ucarecdn.com/a4c5543a-cb79-49e5-a39f-ddc188d25244/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2631": "https://pbs.twimg.com/profile_images/675660688866545664/9r8YYbMN.jpg",
            "2636": "https://ucarecdn.com/eec0f2c6-c97f-40e2-93bd-8ed4149784be/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2632": null,
            "2641": null,
            "2642": null,
            "2645": null,
            "2640": null,
            "2643": null,
            "2639": null,
            "2644": null,
            "2638": "https://followback.com/assets/images/default-userpic.svg",
            "2651": null,
            "2652": null,
            "2646": "https://ucarecdn.com/27040ea1-1db0-492e-8697-b4329a17f5e0/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2649": null,
            "2648": "https://followback.com/assets/images/default-userpic.svg",
            "2647": null,
            "2650": null,
            "2653": null,
            "2656": null,
            "2658": null,
            "2657": null,
            "2661": null,
            "2654": null,
            "2660": null,
            "2655": null,
            "2659": null,
            "2670": null,
            "2668": null,
            "2663": null,
            "2664": null,
            "2662": null,
            "2667": null,
            "2666": null,
            "2665": null,
            "2679": null,
            "2680": null,
            "2674": null,
            "2671": null,
            "2676": "https://ucarecdn.com/7568c143-4ecb-4cc6-9e2a-a86bff2545d0/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2678": "https://followback.com/assets/images/default-userpic.svg",
            "2673": null,
            "2675": null,
            "2681": null,
            "2682": null,
            "2688": null,
            "2683": null,
            "2684": null,
            "2685": null,
            "2687": null,
            "2686": null,
            "2692": null,
            "2697": null,
            "2695": null,
            "2689": "https://followback.com/assets/images/default-userpic.svg",
            "2691": null,
            "2690": null,
            "2698": null,
            "2694": null,
            "2700": null,
            "2703": null,
            "2701": "https://followback.com/assets/images/default-userpic.svg",
            "2707": "https://ucarecdn.com/b500c88b-96cc-4942-a0d3-54724bfbd9e9/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2706": null,
            "2699": "https://followback.com/assets/images/default-userpic.svg",
            "2705": null,
            "2702": null,
            "2710": null,
            "2711": null,
            "2715": null,
            "2708": null,
            "2714": null,
            "2716": "https://ucarecdn.com/c07b1aea-432c-40b3-b449-d38ef2cf0245/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2709": null,
            "2713": null,
            "2717": "https://ucarecdn.com/162c6a0b-7808-47f8-8829-1faaf896d9a8/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2724": null,
            "2721": null,
            "2718": "https://followback.com/assets/images/default-userpic.svg",
            "2725": null,
            "2719": null,
            "2722": null,
            "2720": null,
            "2734": null,
            "2728": null,
            "2729": null,
            "2736": null,
            "2735": null,
            "2730": null,
            "2727": null,
            "2726": null,
            "2737": null,
            "2738": null,
            "2744": null,
            "2739": null,
            "2740": null,
            "2743": null,
            "2742": null,
            "2741": "https://ucarecdn.com/40842876-2758-4985-bafc-842f9be0b78e/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2753": null,
            "2748": null,
            "2751": "https://followback.com/assets/images/default-userpic.svg",
            "2752": null,
            "2747": null,
            "2749": null,
            "2745": null,
            "2746": null,
            "2758": null,
            "2757": "https://ucarecdn.com/749ea098-3895-4758-aa20-727dad793186/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2756": null,
            "2754": null,
            "2760": null,
            "2761": null,
            "2755": "https://ucarecdn.com/ab043851-6405-4a24-99e7-ee11936d67ef/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2759": null,
            "2764": null,
            "2768": "https://ucarecdn.com/eb70e25c-6a6b-4897-8ec6-024bb77dfb76/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2762": null,
            "2763": null,
            "2767": "https://ucarecdn.com/8af42716-b297-4f74-a7ec-e882fec8342f/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2766": "https://followback.com/assets/images/default-userpic.svg",
            "2769": null,
            "2765": null,
            "2776": null,
            "2777": null,
            "2773": null,
            "2775": null,
            "2774": null,
            "2770": "https://ucarecdn.com/9ab4c67d-8dfb-4d33-84c5-bd83d1afb1d2/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2772": null,
            "2771": null,
            "2778": null,
            "2782": null,
            "2783": "https://ucarecdn.com/9769e4e0-34d7-40e8-9267-f3a4cdf10d93/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2785": null,
            "2780": null,
            "2779": null,
            "2781": "https://ucarecdn.com/d8e9b7fc-b682-4c96-8e55-543560469dbc/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2786": null,
            "2789": null,
            "2788": null,
            "2787": null,
            "2791": null,
            "2794": null,
            "2792": null,
            "2790": null,
            "2793": null,
            "2800": null,
            "2795": "https://followback.com/assets/images/default-userpic.svg",
            "2802": "https://ucarecdn.com/03df6f7a-a26e-4a4c-8598-9d72515469bf/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2798": null,
            "2796": null,
            "2799": "https://ucarecdn.com/2fd69eef-f5b0-4db7-a045-14c975aa3956/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2803": "https://ucarecdn.com/78679dc5-f60d-486a-b152-f43c56bf41e9/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2801": null,
            "2806": null,
            "2811": null,
            "2804": null,
            "2812": null,
            "2808": null,
            "2807": null,
            "2810": "https://followback.com/assets/images/default-userpic.svg",
            "2805": null,
            "2813": null,
            "2818": null,
            "2814": null,
            "2816": null,
            "2815": null,
            "2819": null,
            "2820": null,
            "2817": null,
            "2823": null,
            "2829": null,
            "2821": "https://followback.com/assets/images/default-userpic.svg",
            "2824": null,
            "2828": null,
            "2825": null,
            "2827": "https://followback.com/assets/images/default-userpic.svg",
            "2826": null,
            "2834": null,
            "2839": null,
            "2836": null,
            "2830": "https://followback.com/assets/images/default-userpic.svg",
            "2831": null,
            "2835": null,
            "2838": null,
            "2837": "https://followback.com/assets/images/default-userpic.svg",
            "2848": null,
            "2843": null,
            "2846": null,
            "2849": null,
            "2847": null,
            "2845": null,
            "2842": "https://ucarecdn.com/ba98bb8a-efad-4331-9f0c-6d3688e06f77/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2841": null,
            "2855": null,
            "2850": null,
            "2854": "https://followback.com/assets/images/default-userpic.svg",
            "2851": null,
            "2856": "https://ucarecdn.com/b89b0201-92d5-4a01-9cc6-edf8fb8eb2d5/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2858": null,
            "2857": null,
            "2859": null,
            "2860": null,
            "2866": "https://followback.com/assets/images/default-userpic.svg",
            "2867": "https://followback.com/assets/images/default-userpic.svg",
            "2862": null,
            "2863": null,
            "2865": "https://ucarecdn.com/22c870ec-95a0-40ec-976f-7c1140372e30/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2864": null,
            "2861": null,
            "2873": null,
            "2875": null,
            "2868": "https://followback.com/assets/images/default-userpic.svg",
            "2871": "https://ucarecdn.com/634d4063-567e-4c73-b7d5-fb373814cb5e/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2870": null,
            "2876": null,
            "2869": null,
            "2874": null,
            "2883": null,
            "2880": null,
            "2885": null,
            "2878": null,
            "2884": null,
            "2882": null,
            "2886": null,
            "2881": null,
            "2891": null,
            "2894": null,
            "2889": null,
            "2887": "https://followback.com/assets/images/default-userpic.svg",
            "2892": null,
            "2895": null,
            "2893": null,
            "2888": null,
            "2902": null,
            "2896": null,
            "2901": null,
            "2897": "https://followback.com/assets/images/default-userpic.svg",
            "2898": "https://followback.com/assets/images/default-userpic.svg",
            "2900": null,
            "2899": "https://followback.com/assets/images/default-userpic.svg",
            "2903": null,
            "2904": "https://ucarecdn.com/2f87761d-8280-4140-bb95-3c54296861b0/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2906": "https://ucarecdn.com/1ab48b56-0b3b-456a-a18c-4c3d6fed2a7e/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2910": "https://ucarecdn.com/49f3f5bc-875c-4e3e-b6c9-9599039e4115/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2907": null,
            "2908": null,
            "2905": null,
            "2909": null,
            "2912": null,
            "2919": null,
            "2920": null,
            "2914": "https://ucarecdn.com/9301160a-0aec-4789-a6ec-a17b3b1e4ac5/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2916": null,
            "2917": null,
            "2913": "https://ucarecdn.com/b6110fdd-7f09-4f16-8898-d348f39e9bb5/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2915": null,
            "2918": null,
            "2922": null,
            "2924": "https://ucarecdn.com/bda519d5-f3a0-4be4-8f1f-20b92429de00/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2926": null,
            "2925": null,
            "2928": null,
            "2927": null,
            "2923": null,
            "2921": "https://ucarecdn.com/101e8672-a98a-44ab-b943-583f66556d46/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2929": null,
            "2932": null,
            "2931": null,
            "2936": null,
            "2930": null,
            "2934": null,
            "2937": null,
            "2933": "https://ucarecdn.com/ab0cef51-f1fb-43ff-bfc6-167b450c38ea/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2940": null,
            "2941": null,
            "2938": "https://followback.com/assets/images/default-userpic.svg",
            "2939": null,
            "2945": null,
            "2942": "https://followback.com/assets/images/default-userpic.svg",
            "2944": "https://followback.com/assets/images/default-userpic.svg",
            "2943": null,
            "2949": null,
            "2948": null,
            "2951": null,
            "2952": null,
            "2947": null,
            "2950": null,
            "2946": "https://followback.com/assets/images/default-userpic.svg",
            "2954": null,
            "2958": "https://ucarecdn.com/bc911222-0b7b-498b-9d99-38d37b3cbd80/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2961": null,
            "2955": "https://followback.com/assets/images/default-userpic.svg",
            "2962": null,
            "2959": null,
            "2957": null,
            "2963": "https://followback.com/assets/images/default-userpic.svg",
            "2969": null,
            "2964": "https://followback.com/assets/images/default-userpic.svg",
            "2971": null,
            "2967": "https://ucarecdn.com/e36111ab-038a-443b-a85f-247c0a1ce6e3/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2966": null,
            "2965": "https://ucarecdn.com/7d12f4d2-3b42-4604-becf-b6d9edff497f/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2970": null,
            "2972": "https://ucarecdn.com/2b8435e1-3284-468e-b660-369d37534bda/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2980": null,
            "2977": null,
            "2979": null,
            "2973": null,
            "2975": "https://followback.com/assets/images/default-userpic.svg",
            "2978": null,
            "2974": null,
            "2976": null,
            "2984": null,
            "2992": null,
            "2986": "https://ucarecdn.com/5d62403a-97ce-4336-aa80-1077f975af9f/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2983": null,
            "2985": null,
            "2993": "https://followback.com/assets/images/default-userpic.svg",
            "2989": "https://ucarecdn.com/0a5ce528-c8ee-4a20-9eb1-ae057e5cdb01/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2987": null,
            "2994": null,
            "2995": null,
            "2999": null,
            "3001": null,
            "3000": null,
            "2998": null,
            "2996": "https://ucarecdn.com/ab0c0f54-855e-4b43-9cf1-98442aabccb1/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "2997": null,
            "3005": null,
            "3007": null,
            "3002": "https://ucarecdn.com/a27bf112-74af-4ee0-8251-b52b4fbffa44/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3006": null,
            "3003": "https://followback.com/assets/images/default-userpic.svg",
            "3004": null,
            "3008": "https://followback.com/assets/images/default-userpic.svg",
            "3009": null,
            "3012": null,
            "3018": null,
            "3010": null,
            "3014": null,
            "3017": null,
            "3013": "https://ucarecdn.com/64231bfa-eef9-47db-aedf-76b2f9095971/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3016": null,
            "3015": null,
            "3020": null,
            "3026": null,
            "3021": null,
            "3025": null,
            "3024": null,
            "3019": "https://ucarecdn.com/51ecaf71-4775-425b-b39b-c54bd1038c7a/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3027": "https://followback.com/assets/images/default-userpic.svg",
            "3028": null,
            "3031": null,
            "3032": "https://ucarecdn.com/831a235f-9df5-4615-9787-5d51c23444f1/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3029": null,
            "3035": null,
            "3036": null,
            "3034": null,
            "3033": null,
            "3037": null,
            "3039": null,
            "3038": null,
            "3044": null,
            "3045": null,
            "3040": "https://followback.com/assets/images/default-userpic.svg",
            "3041": "https://followback.com/assets/images/default-userpic.svg",
            "3042": null,
            "3043": null,
            "3047": null,
            "3050": null,
            "3049": null,
            "3052": null,
            "3048": null,
            "3051": null,
            "3046": null,
            "3053": null,
            "3061": null,
            "3056": "https://followback.com/assets/images/default-userpic.svg",
            "3060": null,
            "3059": null,
            "3057": null,
            "3058": null,
            "3055": null,
            "3054": "https://followback.com/assets/images/default-userpic.svg",
            "3065": null,
            "3064": null,
            "3069": "https://ucarecdn.com/f5da8ed7-c856-4a12-bc32-3dceba04bb00/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3062": "https://followback.com/assets/images/default-userpic.svg",
            "3071": null,
            "3068": null,
            "3070": "https://ucarecdn.com/2a035a25-6eb7-4d9a-9e5d-5ebf9058e9a2/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3067": null,
            "3078": null,
            "3073": "https://ucarecdn.com/2b4c4e0f-35ef-4851-8a46-6ff51650bd2b/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3074": "https://followback.com/assets/images/default-userpic.svg",
            "3077": null,
            "3075": "https://ucarecdn.com/1f8df69b-6671-4f42-870a-75925a550a47/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3076": null,
            "3072": null,
            "3079": null,
            "3081": null,
            "3083": null,
            "3080": null,
            "3086": null,
            "3084": null,
            "3085": "https://ucarecdn.com/78da3db7-7c02-4e06-bbb9-3f713443fadd/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3088": "https://ucarecdn.com/15f427c2-f2b2-47af-8b9d-3aa11fa1dabf/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3087": null,
            "3090": null,
            "3095": "https://followback.com/assets/images/default-userpic.svg",
            "3091": null,
            "3099": null,
            "3094": null,
            "3092": "https://followback.com/assets/images/default-userpic.svg",
            "3089": null,
            "3093": null,
            "3107": null,
            "3103": null,
            "3104": "https://followback.com/assets/images/default-userpic.svg",
            "3102": null,
            "3106": "https://followback.com/assets/images/default-userpic.svg",
            "3100": null,
            "3105": "https://followback.com/assets/images/default-userpic.svg",
            "3101": null,
            "3108": null,
            "3112": null,
            "3113": null,
            "3116": "https://ucarecdn.com/a4e9bb3a-e5f5-457a-ba36-084eef2b2afc/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3111": "https://followback.com/assets/images/default-userpic.svg",
            "3109": null,
            "3110": "https://ucarecdn.com/d868da71-b4e5-4f38-8362-b45d24f6888f/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3114": "https://followback.com/assets/images/default-userpic.svg",
            "3118": "https://ucarecdn.com/04542fe3-e7cb-4c7f-9c25-740fa4e9bf73/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3119": "https://followback.com/assets/images/default-userpic.svg",
            "3124": null,
            "3120": null,
            "3121": null,
            "3117": null,
            "3122": null,
            "3123": null,
            "3128": null,
            "3127": "https://followback.com/assets/images/default-userpic.svg",
            "3131": null,
            "3132": null,
            "3129": null,
            "3126": null,
            "3133": "https://followback.com/assets/images/default-userpic.svg",
            "3125": null,
            "3134": null,
            "3140": null,
            "3135": "https://ucarecdn.com/ca6bc1f3-d720-4e28-b76e-0ed75be16304/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3137": null,
            "3136": null,
            "3139": null,
            "3138": "https://followback.com/assets/images/default-userpic.svg",
            "3141": null,
            "3146": null,
            "3150": null,
            "3148": null,
            "3142": null,
            "3149": null,
            "3147": null,
            "3144": "https://ucarecdn.com/e9476a5f-44e3-4a6c-a704-1f946ddbe2c0/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3143": null,
            "3152": null,
            "3157": "https://followback.com/assets/images/default-userpic.svg",
            "3153": null,
            "3156": null,
            "3155": null,
            "3151": null,
            "3158": null,
            "3154": null,
            "3159": null,
            "3162": null,
            "3160": "https://followback.com/assets/images/default-userpic.svg",
            "3165": null,
            "3164": "https://ucarecdn.com/aba06140-a7c1-4d49-bce9-5b1cafae3c26/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3166": null,
            "3163": null,
            "3161": null,
            "3167": null,
            "3168": null,
            "3171": null,
            "3170": null,
            "3169": null,
            "3173": "https://followback.com/assets/images/default-userpic.svg",
            "3172": null,
            "3174": null,
            "3175": "https://ucarecdn.com/7fa66064-b310-47b3-8cee-a4e7395d6a34/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3179": null,
            "3176": null,
            "3178": null,
            "3180": "https://followback.com/assets/images/default-userpic.svg",
            "3183": null,
            "3181": "https://ucarecdn.com/7eb1dd96-9f17-4859-bc80-c2738fb2c469/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3182": "https://ucarecdn.com/9776c257-6dc4-4dc1-b749-f798d059ec10/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3190": null,
            "3192": null,
            "3184": null,
            "3189": null,
            "3187": null,
            "3186": null,
            "3191": null,
            "3188": null,
            "3195": null,
            "3199": null,
            "3194": null,
            "3197": null,
            "3196": null,
            "3198": null,
            "3200": "https://ucarecdn.com/12248f06-4741-4794-8713-7b25db6d97ff/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3193": null,
            "3203": "https://followback.com/assets/images/default-userpic.svg",
            "3204": null,
            "3206": null,
            "3201": null,
            "3210": null,
            "3209": null,
            "3205": null,
            "3202": "https://followback.com/assets/images/default-userpic.svg",
            "3214": null,
            "3217": "https://ucarecdn.com/a3a27e49-0b3c-46a5-95bc-335f34550d7b/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3216": null,
            "3211": null,
            "3213": null,
            "3218": null,
            "3212": null,
            "3215": null,
            "3219": null,
            "3220": null,
            "3224": "https://followback.com/assets/images/default-userpic.svg",
            "3221": null,
            "3222": null,
            "3223": null,
            "3225": null,
            "3226": null,
            "3233": null,
            "3232": null,
            "3229": null,
            "3230": null,
            "3231": null,
            "3235": null,
            "3228": null,
            "3227": null,
            "3236": null,
            "3238": null,
            "3237": null,
            "3244": "https://ucarecdn.com/52d553c6-c338-4acc-8077-28c0f5c70ef1/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3243": "https://ucarecdn.com/25309e89-5146-4c4d-ab75-38a3bb92ce33/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3242": null,
            "3245": "https://followback.com/assets/images/default-userpic.svg",
            "3246": "https://followback.com/assets/images/default-userpic.svg",
            "3247": null,
            "3248": "https://ucarecdn.com/c08af86d-00ee-4e94-bd24-8066acb404a7/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3252": "https://ucarecdn.com/b5be81f5-e97b-491d-a8ce-76dae2aa378e/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3250": null,
            "3251": "https://followback.com/assets/images/default-userpic.svg",
            "3254": null,
            "3249": null,
            "3253": null,
            "3255": null,
            "3259": "https://ucarecdn.com/80c3cb8f-00db-4a17-b3ec-ed4d1293cd1b/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3256": null,
            "3262": null,
            "3260": "https://ucarecdn.com/8129a4a3-6ee8-4206-9546-90ed6207dcc5/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3258": "https://followback.com/assets/images/default-userpic.svg",
            "3261": null,
            "3257": null,
            "3263": null,
            "3266": null,
            "3264": "https://ucarecdn.com/5316339e-8cef-481b-94be-699f87175a43/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3269": null,
            "3268": null,
            "3267": null,
            "3270": null,
            "3265": "https://ucarecdn.com/6a020b7e-af39-474e-ac47-d71cf74a21bf/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3275": null,
            "3276": null,
            "3277": null,
            "3271": null,
            "3272": "https://followback.com/assets/images/default-userpic.svg",
            "3273": "https://ucarecdn.com/dea5fa5f-bfbe-4429-826d-2a9a642eea2a/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3278": null,
            "3274": null,
            "3286": null,
            "3280": null,
            "3284": null,
            "3285": null,
            "3281": null,
            "3279": null,
            "3283": null,
            "3282": null,
            "3290": null,
            "3287": "https://followback.com/assets/images/default-userpic.svg",
            "3293": "https://ucarecdn.com/37b9593c-4ad5-472f-af74-b106b055495b/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3292": "https://ucarecdn.com/b1c8d056-93a6-46e7-8289-43635f057ffa/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3291": null,
            "3289": "https://ucarecdn.com/7e513ca8-00fe-4633-8567-fdbf8a7f1785/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3294": "https://ucarecdn.com/45f49c4e-2eaa-4897-968c-b6e6c20b4ebe/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3296": null,
            "3297": null,
            "3301": null,
            "3295": null,
            "3299": null,
            "3298": null,
            "3300": null,
            "3302": null,
            "3304": null,
            "3305": null,
            "3303": null,
            "3306": null,
            "3307": null,
            "3308": null,
            "3309": null,
            "3312": null,
            "3313": null,
            "3318": "https://ucarecdn.com/e15d6c5a-6871-4ef6-96ce-30736112b5c1/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3314": null,
            "3315": null,
            "3316": null,
            "3319": "https://followback.com/assets/images/default-userpic.svg",
            "3320": null,
            "3324": null,
            "3325": null,
            "3321": null,
            "3326": null,
            "3322": "https://ucarecdn.com/ba03fcf1-ead2-46ea-a9f7-f06d08c2fcef/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3323": null,
            "3327": null,
            "3329": null,
            "3331": null,
            "3335": null,
            "3332": "https://followback.com/assets/images/default-userpic.svg",
            "3333": null,
            "3334": null,
            "3330": null,
            "3337": null,
            "3342": null,
            "3340": null,
            "3336": null,
            "3338": "https://followback.com/assets/images/default-userpic.svg",
            "3343": null,
            "3339": null,
            "3341": null,
            "3346": null,
            "3350": null,
            "3345": null,
            "3348": null,
            "3349": null,
            "3351": null,
            "3347": null,
            "3344": null,
            "3357": null,
            "3352": null,
            "3353": "https://followback.com/assets/images/default-userpic.svg",
            "3359": null,
            "3354": null,
            "3356": "https://ucarecdn.com/0c4f74d3-5362-4458-8194-32673995d113/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3355": null,
            "3360": null,
            "3365": null,
            "3366": null,
            "3363": null,
            "3362": null,
            "3367": null,
            "3368": "https://followback.com/assets/images/default-userpic.svg",
            "3369": null,
            "3364": "https://followback.com/assets/images/default-userpic.svg",
            "3374": "https://ucarecdn.com/2acb4017-cb72-48e8-b6ad-602ffb4e5500/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3371": null,
            "3377": null,
            "3372": "https://followback.com/assets/images/default-userpic.svg",
            "3370": null,
            "3376": null,
            "3375": "https://ucarecdn.com/d2121956-bd2f-4daa-9340-da441cd1917a/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3378": null,
            "3379": null,
            "3381": null,
            "3380": null,
            "3383": null,
            "3385": null,
            "3386": null,
            "3384": null,
            "3382": null,
            "3394": null,
            "3391": null,
            "3388": null,
            "3393": null,
            "3387": null,
            "3392": null,
            "3390": null,
            "3389": null,
            "3397": null,
            "3396": null,
            "3401": "https://ucarecdn.com/b2b80ede-99f8-4e07-85c8-e035b134659b/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3395": null,
            "3402": "https://ucarecdn.com/d62dbc1e-e934-446a-8cd6-b22645dbdc5e/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3399": null,
            "3398": null,
            "3400": null,
            "3410": "https://ucarecdn.com/0869ff93-d698-429d-b23e-ca4978ad15ee/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3403": "https://ucarecdn.com/f660cf2a-5e3c-48f8-a096-0e0f9745a041/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3406": "https://ucarecdn.com/fb4078e5-9bea-4289-b35e-cb296cc46d28/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3407": "https://ucarecdn.com/e2f161d8-adeb-4bf3-a90b-d383932e521f/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3405": null,
            "3409": null,
            "3404": null,
            "3408": null,
            "3412": "https://ucarecdn.com/66396bed-7d3d-43d9-ae14-9a6e41344999/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3411": null,
            "3415": null,
            "3413": null,
            "3418": null,
            "3416": null,
            "3417": null,
            "3414": "https://ucarecdn.com/1011bfcf-7563-499d-b9d8-b5f90397b8af/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3421": null,
            "3427": null,
            "3419": null,
            "3423": null,
            "3425": null,
            "3426": "https://ucarecdn.com/884f2cde-14e8-44db-a291-a0aff381bf37/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3422": null,
            "3420": null,
            "3432": null,
            "3430": null,
            "3431": "https://ucarecdn.com/e3eb20c0-cf5d-4bfa-a79c-d162087f51d5/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3429": null,
            "3433": "https://followback.com/assets/images/default-userpic.svg",
            "3437": "https://ucarecdn.com/b784d884-3cec-4229-8c60-10e77a402d0e/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3428": null,
            "3436": null,
            "3443": null,
            "3441": "https://followback.com/assets/images/default-userpic.svg",
            "3442": "https://ucarecdn.com/80cf6e11-a281-4063-ad70-36b91c26e5fa/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3440": "https://followback.com/assets/images/default-userpic.svg",
            "3438": "https://ucarecdn.com/359b282f-6879-4696-b9f9-fde197c8509a/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3445": null,
            "3439": null,
            "3446": null,
            "3447": null,
            "3450": "https://ucarecdn.com/7bd82663-9cdf-4b03-b6fa-0622432ef7de/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3453": null,
            "3452": null,
            "3451": null,
            "3454": null,
            "3448": null,
            "3449": null,
            "3455": null,
            "3456": null,
            "3458": null,
            "3461": null,
            "3457": "https://ucarecdn.com/bd3923ff-008a-4250-a212-a5d9f75e86c3/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3462": null,
            "3460": null,
            "3459": null,
            "3470": "https://ucarecdn.com/b66f9b81-41d3-40b7-b9f5-91bef1f44779/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3463": "https://followback.com/assets/images/default-userpic.svg",
            "3467": "https://ucarecdn.com/b4da616d-e5d2-41b7-999d-14297ea5c163/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3465": "https://ucarecdn.com/d3564577-80d3-4809-9934-105929266a7d/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3464": null,
            "3468": "https://followback.com/assets/images/default-userpic.svg",
            "3466": null,
            "3469": null,
            "3480": null,
            "3472": null,
            "3478": null,
            "3477": null,
            "3471": null,
            "3476": null,
            "3474": "https://followback.com/assets/images/default-userpic.svg",
            "3473": "https://ucarecdn.com/63353c24-aa3a-4e3b-844c-c6d7129c5c40/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3489": "https://followback.com/assets/images/default-userpic.svg",
            "3482": null,
            "3486": "https://ucarecdn.com/cb497ae1-e62b-4b1a-8646-0dd79a66e504/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3488": null,
            "3483": "https://followback.com/assets/images/default-userpic.svg",
            "3481": "https://ucarecdn.com/0b068570-5b1d-48a1-8ad2-f0b693ead984/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3484": null,
            "3485": null,
            "3491": "https://ucarecdn.com/2bfbefe5-4235-43ee-a39f-cadbb352ab5b/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3495": null,
            "3498": "https://followback.com/assets/images/default-userpic.svg",
            "3490": "https://followback.com/assets/images/default-userpic.svg",
            "3496": "https://ucarecdn.com/561b1b89-2f58-4648-90dd-1748bfb3fc35/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3493": "https://ucarecdn.com/ef85f68b-0d42-4160-a418-356446e9f3f5/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3494": null,
            "3497": null,
            "3500": "https://ucarecdn.com/5eea9f41-b55b-4892-afdb-3720afc380cf/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3507": null,
            "3504": null,
            "3502": null,
            "3501": null,
            "3505": null,
            "3503": null,
            "3506": "https://ucarecdn.com/1f478d35-ffe1-4596-9565-27a031d5449b/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3511": null,
            "3510": null,
            "3513": "https://ucarecdn.com/3ddc9def-9818-492c-869f-0a77fa7bb739/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3512": null,
            "3514": "https://followback.com/assets/images/default-userpic.svg",
            "3508": "https://followback.com/assets/images/default-userpic.svg",
            "3509": null,
            "3515": null,
            "3517": "https://ucarecdn.com/b46ce31e-0dd7-4353-8f44-cec0652fb91a/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3522": null,
            "3521": null,
            "3520": "https://ucarecdn.com/f7b174b3-9c0b-4c5e-9f71-730d312c4a08/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3525": null,
            "3523": "https://followback.com/assets/images/default-userpic.svg",
            "3518": null,
            "3524": null,
            "3527": "https://followback.com/assets/images/default-userpic.svg",
            "3526": "https://ucarecdn.com/9cfcbe08-26b6-4951-b239-d65826fbdfef/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3529": "https://followback.com/assets/images/default-userpic.svg",
            "3528": null,
            "3531": "https://ucarecdn.com/b908fef7-a986-4e36-8e26-3b38c82185ed/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3533": "https://followback.com/assets/images/default-userpic.svg",
            "3534": null,
            "3532": "https://followback.com/assets/images/default-userpic.svg",
            "3535": null,
            "3541": null,
            "3536": "https://followback.com/assets/images/default-userpic.svg",
            "3537": null,
            "3538": null,
            "3540": null,
            "3539": null,
            "3542": null,
            "3548": null,
            "3543": null,
            "3544": null,
            "3547": null,
            "3546": null,
            "3549": null,
            "3551": null,
            "3550": null,
            "3555": null,
            "3558": null,
            "3559": null,
            "3557": null,
            "3554": null,
            "3556": null,
            "3553": null,
            "3552": null,
            "3560": null,
            "3567": null,
            "3563": "https://ucarecdn.com/d8e9057a-cc6d-4c35-95a5-25d4a0f5f7ad/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3564": null,
            "3561": null,
            "3565": null,
            "3566": "https://ucarecdn.com/5ada6059-aeac-4073-858e-374446e336a2/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3562": "https://ucarecdn.com/bc992a07-5e61-41e1-87a0-6d0139e8a4a5/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3575": "https://followback.com/assets/images/default-userpic.svg",
            "3571": null,
            "3574": null,
            "3573": null,
            "3568": null,
            "3570": "https://ucarecdn.com/2904341d-b5fb-4ee6-95d5-00f9c51cf81b/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3569": "https://ucarecdn.com/1e6d1247-b544-4074-90fe-8157e0af2895/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3572": "https://followback.com/assets/images/default-userpic.svg",
            "3582": null,
            "3580": null,
            "3576": null,
            "3578": null,
            "3577": null,
            "3581": null,
            "3579": null,
            "3591": null,
            "3585": null,
            "3584": null,
            "3587": null,
            "3586": "https://followback.com/assets/images/default-userpic.svg",
            "3593": null,
            "3592": null,
            "3589": "https://ucarecdn.com/b13c50ff-9d41-4b3e-840f-4cf851c512e8/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3594": null,
            "3600": null,
            "3595": null,
            "3596": null,
            "3599": null,
            "3598": null,
            "3597": null,
            "3601": null,
            "3602": null,
            "3610": null,
            "3603": null,
            "3609": null,
            "3604": null,
            "3606": null,
            "3611": null,
            "3608": null,
            "3618": "https://followback.com/assets/images/default-userpic.svg",
            "3613": "https://followback.com/assets/images/default-userpic.svg",
            "3614": "https://followback.com/assets/images/default-userpic.svg",
            "3617": null,
            "3615": "https://ucarecdn.com/5817f48f-7205-49a1-9daf-a2b5d708b1f0/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3620": null,
            "3619": null,
            "3616": null,
            "3621": null,
            "3622": null,
            "3625": null,
            "3623": null,
            "3628": null,
            "3631": null,
            "3629": "https://followback.com/assets/images/default-userpic.svg",
            "3630": null,
            "3638": "https://followback.com/assets/images/default-userpic.svg",
            "3633": null,
            "3636": "https://ucarecdn.com/d1ab3bd2-a2c7-4ff9-8977-f37df12278b7/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3632": null,
            "3639": null,
            "3635": null,
            "3634": null,
            "3640": null,
            "3641": null,
            "3643": null,
            "3646": null,
            "3649": "https://followback.com/assets/images/default-userpic.svg",
            "3642": null,
            "3647": null,
            "3644": null,
            "3645": null,
            "3654": null,
            "3653": null,
            "3650": null,
            "3656": null,
            "3652": null,
            "3651": null,
            "3655": null,
            "3657": null,
            "3663": null,
            "3659": "https://followback.com/assets/images/default-userpic.svg",
            "3660": "https://followback.com/assets/images/default-userpic.svg",
            "3658": "https://followback.com/assets/images/default-userpic.svg",
            "3664": null,
            "3666": null,
            "3665": null,
            "3662": null,
            "3674": null,
            "3675": null,
            "3672": null,
            "3671": null,
            "3670": null,
            "3668": null,
            "3669": null,
            "3676": null,
            "3677": null,
            "3683": null,
            "3680": null,
            "3681": null,
            "3678": null,
            "3682": null,
            "3679": null,
            "3688": null,
            "3687": null,
            "3686": null,
            "3691": null,
            "3684": null,
            "3690": null,
            "3689": "https://ucarecdn.com/80d22af8-a377-4c06-889c-1e44c68cf494/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3692": "https://ucarecdn.com/44df060d-71e2-4a66-844a-a35f043b1b94/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3699": null,
            "3701": null,
            "3693": null,
            "3700": null,
            "3697": null,
            "3696": null,
            "3694": null,
            "3695": "https://followback.com/assets/images/default-userpic.svg",
            "3706": null,
            "3702": "https://followback.com/assets/images/default-userpic.svg",
            "3705": null,
            "3703": null,
            "3707": "https://ucarecdn.com/c55e5a5d-0e75-4e9c-b825-def15c0f559b/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3708": null,
            "3704": "https://followback.com/assets/images/default-userpic.svg",
            "3709": "https://followback.com/assets/images/default-userpic.svg",
            "3712": null,
            "3715": "https://followback.com/assets/images/default-userpic.svg",
            "3710": null,
            "3711": "https://ucarecdn.com/547fe5aa-0e2a-40e5-b24a-63b06d07f984/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3716": null,
            "3713": "https://ucarecdn.com/eb20024c-e7dc-49bf-b79f-7ef28c1f8fba/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3714": null,
            "3717": "https://ucarecdn.com/d3828b2a-6da5-4889-b97a-7d13a801ff7c/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3719": null,
            "3723": null,
            "3720": null,
            "3721": null,
            "3724": "https://followback.com/assets/images/default-userpic.svg",
            "3722": null,
            "3725": null,
            "3726": null,
            "3729": null,
            "3731": null,
            "3728": null,
            "3727": null,
            "3730": null,
            "3733": null,
            "3732": "https://followback.com/assets/images/default-userpic.svg",
            "3734": null,
            "3740": null,
            "3738": null,
            "3739": null,
            "3735": null,
            "3741": null,
            "3742": null,
            "3737": null,
            "3736": null,
            "3746": null,
            "3748": null,
            "3744": null,
            "3745": null,
            "3743": null,
            "3747": null,
            "3749": null,
            "3750": null,
            "3754": null,
            "3753": null,
            "3751": "https://ucarecdn.com/365569a5-4e3c-4132-a26d-5bfec6caf8ea/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3758": null,
            "3755": null,
            "3757": "https://ucarecdn.com/a3cc6bc8-5123-415c-89c8-965fae1c363a/-/scale_crop/200x140/center/-/quality/better/-/enhance/40/-/sharp/",
            "3756": null,
            "3752": null,
            "3763": null,
            "3760": null,
            "5687": null,
            "3759": null,
            "3761": null,
            "3762": "https://followback.com/assets/images/default-userpic.svg"
        }'
    ;

    // Convert to array
    $data = json_decode($objects, true);

    $results = [
        'success' => 0,
        'error' => 0,
        'error_image' => 0,
        'add_username' => 0
    ];

    // Update data
    foreach ($data as $user_id => $avatar) {
        // Make sure valid info
        if (is_null($avatar) OR (!$user = Followback\User::find($user_id))) {
            $results['error']++;
            continue;
        }

        // Handle update
        if (is_null($user->username) OR $user->username == '') {
            $results['add_username']++;
            $user->username = str_replace(' ', '', $user->name);
        }

        // Create file name
        $user->avatar = '/bids_images/' . $user->username . '-' . Str::random(24) . '.png';

        try {
            if (copy($avatar, public_path() . $user->avatar)) {
                $user->update();
                $results['success']++;
            } else {
                $results['error_image']++;
            }
        } catch (\Exception $e) {
            $results['error_image']++;
            continue;
        }
        // Go get actaul image and save
        
        
    }

    dd($results);
});

Route::group(
    ['prefix' => 'admin'],
    function () {
        Route::get(
            '/',
            array(
                'as' => 'admin_dashboard',
                'uses' => 'Admin\DashboardController@getDashboard'
            )
        );
        Route::get(
            'verfied/{type}',
            array(
                'as' => 'admin_user_verfied',
                'uses' => 'Admin\UserController@verfiedUser'
            )
        );
        Route::post(
            'change-username',
            array(
                'as' => 'do_admin_change_username',
                'uses' => 'Admin\UserController@postAdminChangeUsername'
            )
        );
     	 Route::post(
            'change-reach',
            array(
                'as' => 'do_change_reach',
                'uses' => 'Admin\UserController@postChangeReach'
            )
        );
        Route::post(
            'change-category',
            array(
                'as' => 'do_change_category',
                'uses' => 'Admin\UserController@postChangeCategory'
            )
        );
        Route::post(
            'change-tags',
            array(
                'as' => 'do_change_tags',
                'uses' => 'Admin\UserController@postChangeTags'
            )
        );

        Route::get(
            'change-password',
            array(
                'as' => 'admin_change_password',
                'uses' => 'Admin\UserController@getAdminChangePassword'
            )
        );
        Route::post(
            'change-password',
            array(
                'as' => 'do_admin_change_password',
                'uses' => 'Admin\UserController@postAdminChangePassword'
            )
        );
        Route::post(
            'change-profile-image',
            array(
                'as' => 'do_update_profile_image',
                'uses' => 'Admin\UserController@saveFollowbackProfileImage'
            )
        );

        Route::get(
            'users',
            array(
                'as' => 'admin_users_index',
                'uses' => 'Admin\UserController@getIndex'
            )
        );
        Route::get(
            'user/delete/{id}',
            array(
                'as' => 'admin_user_delete',
                'uses' => 'Admin\UserController@getDelete'
            )
        );

        Route::get(
            'bids',
            array(
                'as' => 'admin_bids_index',
                'uses' => 'Admin\BidController@getIndex'
            )
        );
        Route::get(
            'settings',
            array(
                'as' => 'admin_settings_index',
                'uses' => 'Admin\SettingsController@getIndex'
            )
        );
        Route::get(
            'bids-delete/{id}',
            array(
                'as' => 'admin_bid_delete',
                'uses' => 'Admin\BidController@doDeleteBid'
            )
        );

        Route::get(
            'most-search-user-settings',
            array(
                'as' => 'admin_most_search_user_settings_index',
                'uses' => 'Admin\MostSearchUserController@getIndex'
            )
        );
        Route::get(
            'most-search-user',
            array(
                'as' => 'admin_most_search_user',
                'uses' => 'Admin\MostSearchUserController@getMostSearchUser'
            )
        );
        Route::post(
            'post-search-user',
            array(
                'as' => 'admin_post_most_search_user',
                'uses' => 'Admin\MostSearchUserController@postSearchUser'
            )
        );
        Route::get(
            'delete-most-search-user/{id}',
            array(
                'as' => 'admin_delete_most_search_user',
                'uses' => 'Admin\MostSearchUserController@deleteUser'
            )
        );
        Route::get(
            'add-most-search-user',
            array(
                'as' => 'admin_most_search_user_add',
                'uses' => 'Admin\MostSearchUserController@addUser'
            )
        );
        Route::post(
            'rename-most-search-user',
            array(
                'as' => 'admin_most_search_user_rename',
                'uses' => 'Admin\MostSearchUserController@renameUser'
            )
        );

        //Admin Verify Users
        Route::get(
            'verified-users',
            array(
                'as' => 'admin_verified_users_index',
                'uses' => 'Admin\VerifyUserController@getIndex'
            )
        );
        Route::get(
            'verify-users',
            array(
                'as' => 'admin_verify_user',
                'uses' => 'Admin\VerifyUserController@getVerifyUser'
            )
        );
        Route::post(
            'post-verify-user',
            array(
                'as' => 'admin_post_verify_user',
                'uses' => 'Admin\VerifyUserController@postVerifyUser'
            )
        );
        Route::get(
            'remove-verified-user/{id}',
            array(
                'as' => 'remove_verify_most_search_user',
                'uses' => 'Admin\VerifyUserController@removeVerifyUser'
            )
        );
        Route::get(
            'add-verify-user',
            array(
                'as' => 'admin_add_verify_user',
                'uses' => 'Admin\VerifyUserController@addVerifyUser'
            )
        );

        //Admin Bind Users
        /*
        Route::get(
            'link-users',
            array(
                'as' => 'admin_link_users_index',
                'uses' => 'Admin\LinkUserController@getIndex'
            )
        );
        Route::get(
            'add-email',
            array(
                'as' => 'admin_add_link_email',
                'uses' => 'Admin\LinkUserController@getEmail'
            )
        );
        Route::post(
            'post-email',
            array(
                'as' => 'admin_post_email',
                'uses' => 'Admin\LinkUserController@doPostEmail'
            )
        );
        Route::get(
            'add-link-user/{type}',
            array(
                'as' => 'admin_add_link_user',
                'uses' => 'Admin\LinkUserController@getAddUserLink'
            )
        );
        //  Route::get('post-link-user',array('as'=>'admin_post_link_user','uses'=>'Admin\LinkUserController@getSocialSearchUser'));
        Route::post(
            'post-link-user',
            array(
                'as' => 'admin_post_link_user',
                'uses' => 'Admin\LinkUserController@postLinkUser'
            )
        );
*/
        Route::group(
            ['middleware' => 'Followback\Http\Middleware\VerifyCsrfToken'],
            function () {
                Route::post(
                    'settings/payments/save',
                    array(
                        'as' => 'do_admin_settings_payment_save',
                        'uses' => 'Admin\SettingsController@postPaymentSave'
                    )
                );
                Route::post(
                    'settings/bid/save',
                    array(
                        'as' => 'do_admin_settings_bid_save',
                        'uses' => 'Admin\SettingsController@postBidSave'
                    )
                );
            }
        );
    }
);

Route::get(
    'encode-status',
    array(
        'as' => 'encode_status',
        'uses' => 'BidController@getEncodeStatus'
    )
);

/* CATEGORIES */
Route::get(
    'sort/{category}',
    array(
        'as' => 'sort',
        'uses' => 'UserController@getSorted'
    )
);

/* FOLLOWERS */
Route::get(
    'followers/{followers}',
    array(
        'as' => 'sort',
        'uses' => 'UserController@getFollowers'
    )
);


/* SOCIAL CONNECT
----------------------------*/
Route::get(
    'auth/social-login/{type}',
    array(
        'as' => 'auth_social_login',
        'middleware' => 'oauth_token',
        'uses' => 'AuthController@getSocialLogin'
    )
);
Route::get(
    'about',
    array(
        'as' => 'static_about_us_page',
        'uses' => 'StaticPageController@getAboutPage'
    )
);
Route::get(
    'how-it-works',
    array(
        'as' => 'static_how_it_work_page',
        'uses' => 'StaticPageController@getHowItWorkPage'
    )
);
Route::get(
    'support',
    array(
        'as' => 'static_support_page',
        'uses' => 'StaticPageController@getSupportPage'
    )
);
Route::get(
    'view-all-users',
    array(
        'as' => 'view_all_users',
        'uses' => 'MostSearchUserController@getIndex'
    )
);
Route::any(
    'privacy-policy',
    array(
        'as' => 'static_privacy_policy_page',
        'uses' => 'StaticPageController@getPrivacyPolicy'
    )
);
Route::get(
    'terms-of-service',
    array(
        'as' => 'static_terms_of_service',
        'uses' => 'StaticPageController@getTermsService'
    )
);
Route::get(
    'sitemap',
    array(
        'as' => 'static_sitemap_page',
        'uses' => 'StaticPageController@getSitemap'
    )
);
Route::get(
    'social_auth/other-social-login/{type}',
    array(
        'as' => 'social_login_custom_vine_form',
        'uses' => 'AuthController@getCustomSocialVineLogin'
    )
);
Route::post(
    'social_auth/custom_social_login',
    array(
        'as' => 'do_custom_social_vine_login',
        'uses' => 'AuthController@postVineLogin'
    )
);
Route::get(
    'loginPopup',
    array('as' => 'get_login_popup', 'uses' => 'AuthController@getLoginPopup')
);
Route::get(
    'registerPopup',
    array(
        'as' => 'get_register_popup',
        'uses' => 'AuthController@getRegisterPopup'
    )
);

// Route::group(['prefix' =>'social_auth'], function(){

// 	Route::get('vine', array('as'=>'social_login_custom_vine_form', 'uses'=>'AuthController@getCustomSocialVineLogin'));
// 	Route::post('custom_social_login', array('as' => 'do_custom_social_vine_login', 'uses' => 'AuthController@postVineLogin'));
// 	// Route::post('custom_social_vine_login', array('as' => 'do_custom_social_vine_login', 'uses' => 'AuthController@postVineLogin'));

// });

/* REGISTRATION
----------------------------*/
Route::get(
    'register-success',
    array(
        'as' => 'register_success',
        'uses' => 'RegistrationController@getRegisterSuccess'
    )
);
Route::group(
    [],
    function () {
        Route::get(
            'login',
            array('as' => 'auth_login', 'uses' => 'AuthController@getLogin')
        );
        Route::get(
            'register',
            array(
                'as' => 'register',
                'uses' => 'RegistrationController@getIndex'
            )
        );
        Route::post(
            'register/upload-reg-profile-pic',
            array(
                'as' => 'upload_reg_profile_pic',
                'uses' => 'RegistrationController@uploadRegProfilePic'
            )
        );
        Route::post(
            'register/save-reg-profile-image',
            array(
                'as' => 'save_reg_profile_image',
                'uses' => 'RegistrationController@saveRegProfileImage'
            )
        );
        //Route::get('register-success',array('as'=>'register_success','uses'=>'RegistrationController@getRegisterSuccess'));
        Route::get(
            'remind-password',
            array(
                'as' => 'remind_password',
                'uses' => 'RemindPasswordController@getRemindPassword'
            )
        );
        Route::get(
            'remind-password-complete',
            array(
                'as' => 'remind_password_complete',
                'uses' => 'RemindPasswordController@getRemindPasswordComplete'
            )
        );
        Route::get(
            'reset-password',
            array(
                'as' => 'reset_password',
                'uses' => 'RemindPasswordController@getResetPassword'
            )
        );
        Route::group(
        /*['middleware' => 'csrf'],*/
            [],
            function () {
                //Both(remind-password and change-password) route having same functionality but use in different place
                Route::post(
                    'remind-password',
                    array(
                        'as' => 'do_remind_password',
                        'uses' => 'RemindPasswordController@postRemindPassword'
                    )
                );
                Route::post(
                    'change-password',
                    array(
                        'as' => 'do_change_password',
                        'uses' => 'RemindPasswordController@postChangePassword'
                    )
                );
                Route::post(
                    'change-notification',
                    array(
                        'as' => 'do_change_notification',
                        'uses' => 'ProfileController@postChangeNotification'
                    )
                );
                Route::post(
                    'settings/upload-profile-pic',
                    array(
                        'as' => 'upload_profile_pic',
                        'uses' => 'ProfileController@uploadProfilePic'
                    )
                );
                Route::post(
                    'settings/upload-save-profile-pic',
                    array(
                        'as' => 'upload_and_save_profile_pic',
                        'uses' => 'ProfileController@uploadAndSaveProfilePic'
                    )
                );
                Route::post(
                    'settings/update-profile-pic',
                    array(
                        'as' => 'do_update_profile_pic',
                        'uses' => 'ProfileController@postUpdateProfilePic'
                    )
                );
                Route::post(
                    'settings/update-twitter',
                    array(
                        'as' => 'do_update_twitter',
                        'uses' => 'ProfileController@updateTwitter'
                    )
                );
                Route::post(
                    'settings/update-facebook',
                    array(
                        'as' => 'do_update_facebook',
                        'uses' => 'ProfileController@updateFacebook'
                    )
                );   
                Route::post(
                    'settings/update-linkedin',
                    array(
                        'as' => 'do_update_linkedin',
                        'uses' => 'ProfileController@updateLinkedin'
                    )
                );
                 Route::post(
                    'settings/update-soundcloud',
                    array(
                        'as' => 'do_update_soundcloud',
                        'uses' => 'ProfileController@updateSoundcloud'
                    )
                );   
                Route::post(
                    'settings/update-youtube',
                    array(
                        'as' => 'do_update_youtube',
                        'uses' => 'ProfileController@updateYoutube'
                    )
                );
                Route::post(
                    'settings/update-googleplus',
                    array(
                        'as' => 'do_update_googleplus',
                        'uses' => 'ProfileController@updateGoogleplus'
                    )
                );  
                Route::post(
                    'settings/update-instagram',
                    array(
                        'as' => 'do_update_instagram',
                        'uses' => 'ProfileController@updateInstagram'
                    )
                );         
                Route::post(
                    'settings/update-web',
                    array(
                        'as' => 'do_update_web',
                        'uses' => 'ProfileController@updateWeb'
                    )
                );   
                 Route::post(
                    'settings/update-about',
                    array(
                        'as' => 'do_update_about',
                        'uses' => 'ProfileController@updateAbout'
                    )
                );   
                 Route::post(
                    'settings/update-reach',
                    array(
                        'as' => 'do_update_reach',
                        'uses' => 'ProfileController@updateReach'
                    )
                );                                           
                Route::get(
                    'profile/delete-profile-image/{id}',
                    array(
                        'as' => 'delete_profile_image',
                        'uses' => 'AuthController@deleteProfileImage'
                    )
                );
                Route::post(
                    'reset-password',
                    array(
                        'as' => 'do_reset_password',
                        'uses' => 'RemindPasswordController@postResetPassword'
                    )
                );
                Route::post(
                    'register',
                    array(
                        'as' => 'do_register',
                        'uses' => 'RegistrationController@postRegister'
                    )
                );
                Route::post(
                    'login',
                    array(
                        'as' => 'do_auth_login',
                        'uses' => 'AuthController@postLogin'
                    )
                );
            }
        );
        /* USER SEARCH */
        Route::get(
            '/',
            array('as' => 'index', 'uses' => 'StaticPageController@getIndex')
        );
    }
);

/* USER SEARCH WITHOUT AUTHENTICATION
---------------------------------------------*/
Route::get(
    'search-social-users',
    array(
        'as' => 'search_users_without_auth',
        'uses' => 'SearchController@getSocialSearch'
    )
);

Route::group(
    ['middleware' => 'auth'],
    function () {
        //For Bubble for ajax request
        Route::get(
            'count-bubble',
            array(
                'as' => 'count_bubble',
                'uses' => 'BaseController@countBubble'
            )
        );

        /*Route::get('profile/dashboard',array('as'=>'profile_dashboard','uses'=>'ProfileController@getDashboard'));*/
        Route::get(
            'profile/dashboard',
            array(
                'as' => 'profile_dashboard',
                'uses' => 'ProfileController@getFollowbackProfile'
            )
        );
        Route::get(
            'my-prices',
            array(
                'as' => 'profile_services_prices',
                'uses' => 'ProfileController@getServicesPrices'
            )
        );
        Route::get(
            'settings',
            array(
                'as' => 'profile_followback_profile',
                'uses' => 'ProfileController@getFollowbackProfile'
            )
        );
        Route::get(
            'settings/connect',
            array(
                'as' => 'profile_connect',
                'uses' => 'ProfileController@getConnect'
            )
        );
        //for payments
        Route::get(
            'settings/receiving-payments',
            array(
                'as' => 'profile_payment',
                'uses' => 'ProfileController@getReceivingPayments'
            )
        );
        Route::get(
            'settings/followback-profile',
            array(
                'as' => 'profile_followback_profile',
                'uses' => 'ProfileController@getFollowbackProfile'
            )
        );
        Route::get(
            'profile/post-followback-profile',
            array(
                'as' => 'do_followback_profile',
                'uses' => 'ProfileController@postUserProfie'
            )
        );

        //Change Email
        //Route::get('profile/change-email',array('as'=>'change_email','uses'=>'AuthController@getChangeEmail'));
        //Route::post('profile/change-email',array('as'=>'do_change_email','uses'=>'UserController@doChangeEmail'));

        // Route::get('profile/block-users',array('as'=>'profile_block_users','uses'=>'ProfileController@getBlockUsers'));
        Route::post(
            'profile/change-email',
            array(
                'as' => 'do_change_email',
                'uses' => 'UserController@doChangeEmail'
            )
        );
        Route::post(
            'profile/change-name',
            array(
                'as' => 'do_change_name',
                'uses' => 'UserController@doChangeName'
            )
        );
        
         Route::post(
            'profile/change-paypal',
            array(
                'as' => 'do_change_paypal',
                'uses' => 'UserController@doChangePaypal'
            )
        );
        
        
        Route::get(
            'profile/resend-confirmation-email',
            array(
                'as' => 'do_resend_confirmation_email',
                'uses' => 'UserController@doResendConfirmationMail'
            )
        );
        Route::get(
            'profile/delete-followback-account/{id}',
            array(
                'as' => 'delete_followback_account',
                'uses' => 'AuthController@deletefollowbackProfile'
            )
        );

        Route::post(
            'profile/change-username',
            array(
                'as' => 'do_change_username',
                'uses' => 'UserController@doChangeUsername'
            )
        );

        Route::get(
            'profile/display-public-profile/{id}',
            array(
                'as' => 'display_public_profile',
                'uses' => 'ProfileController@displayPublicProfile'
            )
        );
        Route::get(
            'profile/hide-public-profile/{id}',
            array(
                'as' => 'hide_public_profile',
                'uses' => 'ProfileController@hidePublicProfile'
            )
        );

        Route::get(
            'profile/as-it-happen/{id}',
            array(
                'as' => 'do_as_it_happen',
                'uses' => 'ProfileController@doAsItHappen'
            )
        );
        Route::get(
            'profile/daily-email/{id}',
            array(
                'as' => 'do_daily_email',
                'uses' => 'ProfileController@doDailyEmail'
            )
        );
        Route::get(
            'profile/never-email/{id}',
            array(
                'as' => 'do_never_email',
                'uses' => 'ProfileController@doNeverEmail'
            )
        );

        Route::post(
            'profile/services-prices',
            array(
                'as' => 'do_profile_services_prices',
                'uses' => 'ProfileController@postServicesPrices'
            )
        );
        Route::post(
            'profile/paypal-email',
            array(
                'as' => 'do_paypal_email',
                'uses' => 'ProfileController@postPaypalEmail'
            )
        );

        Route::get(
            'disconnect/{type}',
            array(
                'as' => 'auth_disconnect',
                'uses' => 'AuthController@getDisconnect'
            )
        );
        Route::get(
            'connect/{type}',
            array('as' => 'auth_connect', 'uses' => 'AuthController@getConnect')
        );
        Route::get(
            'acc-reset/{type}',
            array(
                'as' => 'social_acc_disconnect',
                'uses' => 'AuthController@getAccountReset'
            )
        );

        Route::get(
            'search-users',
            array(
                'as' => 'search_users',
                'uses' => 'SearchController@getSocialSearch'
            )
        );

        Route::get(
            'service/create',
            array(
                'as' => 'add_service',
                'uses' => 'ServiceController@addService'
            )
        );
        Route::post(
            'service/create',
            array(
                'as' => 'create_service',
                'uses' => 'ServiceController@createService'
            )
        );
        Route::get(
            'service/edit/{id}',
            array(
                'as' => 'edit_service',
                'uses' => 'ServiceController@editService'
            )
        );

        Route::get(
            'my-services',
            array(
                'as' => 'service_list',
                'uses' => 'ServiceController@getServiceList'
            )
        );
        Route::any(
            'socialtasks',
            array('as' => 'bid_list', 'uses' => 'BidController@myBids')
        );

        Route::get(
            'received',
            array('as' => 'bids_for_me', 'uses' => 'BidController@getAllBids')
        );

        Route::get(
            'sent',
            array('as' => 'bids_for_me', 'uses' => 'BidController@getAllBids')
        );

        Route::get(
            'settings/blocked-users',
            array(
                'as' => 'blocked_users',
                'uses' => 'UserController@getBlockedUsers'
            )
        );
        Route::get(
            'block-bids/{userId}',
            array('as' => 'block_bids', 'uses' => 'BidController@getBlockBids')
        );
        Route::get(
            'unblock-bids/{userId}',
            array(
                'as' => 'unblock_bids',
                'uses' => 'BidController@getUnblockBids'
            )
        );

        Route::get(
            'socialtasks',
            //array('as' => 'bids_for_me', 'uses' => 'BidController@getBidsForMe')
            array('as' => 'bids_for_me', 'uses' => 'BidController@getAllBids')
        );
        Route::get(
            'bid-accepted',
            array('as' => 'bid_accepted', 'uses' => 'BidController@getAccepted')
        );
        Route::get(
            'socialtasks/accept/{id}',
            array(
                'as' => 'accept_bid_for_me',
                'uses' => 'BidController@getAcceptBidForMe'
            )
        );
        Route::get(
            'socialtasks/deny/{id}',
            array(
                'as' => 'deny_bid_for_me',
                'uses' => 'BidController@getDenyBidForMe'
            )
        );
        Route::get(
            'socialtasks/hide/{id}',
            array(
                'as' => 'hide_bid_for_me',
                'uses' => 'BidController@getHideBidForMe'
            )
        );
        Route::get(
            'socialtasks/hide/{id}',
            array(
                'as' => 'hide_bid_for_sender',
                'uses' => 'BidController@getHideBidForSender'
            )
        );
        Route::get(
            'socialtasks/set-as-completed/{id}',
            array(
                'as' => 'set_bid_as_completed',
                'uses' => 'BidController@getSetAsCompleted'
            )
        );

        //Route::get('profile/get-username-by-email/{id}',array('as'=>'get_username_by_email','uses'=>'AuthController@getUsernameByEmail'));

        Route::get(
            'bid/cancel/{id}',
            array('as' => 'cancel_bid', 'uses' => 'BidController@getCancel')
        );
        Route::get(
            'bid/task-not-completed/{id}',
            array(
                'as' => 'task_not_completed',
                'uses' => 'BidController@getTaskNotCompleted'
            )
        );
        Route::get(
            'socialtasks/task-completed/{id}',
            array(
                'as' => 'task_completed',
                'uses' => 'BidController@getTaskCompleted'
            )
        );

        Route::post(
            'bid/counter-by-receiver/{id}',
            array(
                'as' => 'bid_counter_by_receiver',
                'middleware' => ['counterBidsLeft'],
                'uses' => 'CounterBidController@postCounterByReceiver'
            )
        );
        Route::post(
            'bid/counter-by-creator/{id}',
            array(
                'as' => 'bid_counter_by_creator',
                'middleware' => ['counterBidsLeft'],
                'uses' => 'CounterBidController@postCounterByCreator'
            )
        );

        //COUNTERBIDS
        Route::group(
            ['prefix' => 'counterbid/{bidId}', 'middleware' => 'counterBid'],
            function () {
                Route::get(
                    'accept',
                    array(
                        'as' => 'counterbid_accept',
                        'uses' => 'CounterBidController@getAccept'
                    )
                );
                Route::get(
                    'deny',
                    array(
                        'as' => 'counterbid_deny',
                        'uses' => 'CounterBidController@getDeny'
                    )
                );
                Route::get(
                    'counter',
                    array(
                        'as' => 'counterbid_counter',
                        'uses' => 'CounterBidController@getCounter'
                    )
                );
            }
        );

        Route::group(
            [
                'prefix' => '/{service}/{identifier}',
                'middleware' => 'auth'

            ],
            function () {

                Route::get(
                    'step-2',
                    array(
                        'as' => 'bid_upload',
                        'uses' => 'BidController@getUpload'
                    )
                );
                // Route::get('/',array('as'=>'bid_create','middleware'=>'blockedBid|bidsLeft','uses'=>'BidController@getCreate'));

                //Route::group(['middleware'=>'csrf'], function(){
                Route::post(
                    'make',
                    array(
                        'as' => 'bid_make',
                        'uses' => 'BidController@postMake',
                        'middleware' => [
                            'blockedBid',
                            'bidsLeft',
                            'bidAllowedByType'
                        ]
                    )
                );
                Route::post(
                    'upload',
                    array(
                        'as' => 'do_bid_upload',
                        'uses' => 'BidController@postBidUpload'
                    )
                );
                //});
            }
        );

        Route::get(
            'checkout',
            array('as' => 'checkout', 'uses' => 'PaymentController@getCheckout')
        );

        Route::get(
            'payment/make',
            array('as' => 'payment_make', 'uses' => 'PaymentController@getMake')
        );
        Route::get(
            'payment/return',
            array(
                'as' => 'payment_paypal_return',
                'uses' => 'PaymentController@getReturn'
            )
        );

        Route::get(
            'payment/confirmation-paid',
            array(
                'as' => 'confirmation_paid',
                'uses' => 'PaymentController@getConfirmationPaid'
            )
        );
        Route::get(
            'payment/confirmation-authorized',
            array(
                'as' => 'confirmation_authorized',
                'uses' => 'PaymentController@getConfirmationAuthorized'
            )
        );

        Route::get(
            'users/user-socail-account',
            array(
                'as' => 'chk_user_socail_account',
                'uses' => 'UserController@checkUserSocialAcc'
            )
        );

    }
);

Route::get(
    'sync-account/{service}/{identifier}',
    array('as' => 'sync_accoount', 'uses' => 'UserController@getSyncAccount')
);
Route::get(
    'min-bid-price/{service}/{identifier}/{serviceType}',
    array('as' => 'min_bid_price', 'uses' => 'UserController@getMinBidPrice')
);

Route::get(
    'confirm-email/{token}',
    array(
        'as' => 'confirm_email',
        'uses' => 'RegistrationController@getConfirmEmail'
    )
);
Route::get(
    'auth/logout',
    array('as' => 'auth_logout', 'uses' => 'AuthController@getLogout')
);
Route::get(
    'faq',
    array('as' => 'static_faq', 'uses' => 'StaticPageController@getFaq')
);
Route::get(
    'privacy-policy',
    array(
        'as' => 'static_privacy_policy',
        'uses' => 'StaticPageController@getPrivacyPolicy'
    )
);
Route::get(
    'terms-of-service',
    array(
        'as' => 'static_terms_of_service',
        'uses' => 'StaticPageController@getTermsService'
    )
);

Route::post(
    'paypal/preapproval-callback',
    array(
        'as' => 'paypal_preapproval_callback',
        'uses' => 'PreapprovalController@postPreapprovalCallback'
    )
);
Route::post(
    'paypal/payment-callback',
    array(
        'as' => 'paypal_payment_callback',
        'uses' => 'PaymentController@getPaypalCallback'
    )
);

Route::group(
    [
        'prefix' => '{service}/{username}',
        'middleware' => 'auth'
    ],
    function () {

        //Route::get('/',array('as'=>'bid_create' , 'middleware'=>'blockedBid|bidsLeft', 'uses'=>'BidController@getCreate'));
        Route::get(
            '/',
            array('as' => 'bid_create', 'uses' => 'BidController@getCreate', 'middleware' => 'auth')
        );
        Route::post(
            '/',
            array('as' => 'bid_create', 'uses' => 'BidController@postCreate')
        );

        Route::get(
            'step-2',
            array('as' => 'bid_upload', 'uses' => 'BidController@getUpload')
        );
        Route::get(
            'redirect/otherSocialAcc',
            array(
                'as' => 'redirect_other_social_profile',
                'uses' => 'BidController@redirectOtherSocialProfile'
            )
        );
    }
);
Route::get(
    'get-instructions',
    array('as' => 'get_instruction', 'uses' => 'BidController@getInstructions')
);
Route::group(
    ['prefix' => '{username}'],
    function () {

        //Route::get('/',array('as'=>'bid_create' , 'middleware'=>'blockedBid|bidsLeft', 'uses'=>'BidController@getCreate'));
        Route::get(
            '/',
            array('as' => 'bid_create', 'uses' => 'BidController@getCreate')
        );
        Route::post(
            '/',
            array('as' => 'bid_create', 'uses' => 'BidController@postCreate')
        );
        Route::get(
            'step-2',
            array('as' => 'bid_upload', 'uses' => 'BidController@getUpload')
        );
        Route::get(
            'redirect/FollowbackAcc',
            array(
                'as' => 'redirect_followback_profile',
                'uses' => 'BidController@redirectFollowbackProfile'
            )
        );
    }
);
