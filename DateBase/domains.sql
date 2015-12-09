--emial
CREATE DOMAIN email AS TEXT CONSTRAINT valid_value CHECK (VALUE ~ '.+@.+');

--numer telefonu
CREATE DOMAIN phoneNumber AS TEXT CONSTRAINT valid_value CHECK (VALUE ~ '^[0-9]*$');

--rok 1812-3048
CREATE DOMAIN year AS TEXT CONSTRAINT valid_value CHECK (VALUE ~ '^(181[2-9]|18[2-9]\d|19\d\d|2\d{3}|30[0-3]\d|304[0-8])$');

--isbn
CREATE DOMAIN isbn AS TEXT CONSTRAINT valid_value CHECK (VALUE ~ '^(?:ISBN(?:-1[03])?:?\ )?(?=[0-9X]{10}$|(?=(?:[0-9]+[-\ ]){3})[-\ 0-9X]{13}$|97[89][0-9]{10}$|(?=(?:[0-9]+[-\ ]){4})[-\ 0-9]{17}$)(?:97[89][-\ ]?)?[0-9]{1,5}[-\ ]?[0-9]+[-\ ]?[0-9]+[-\ ]?[0-9X]$');

--url
CREATE DOMAIN url AS TEXT CONSTRAINT valid_value CHECK (VALUE ~ '[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)');

--gwiazdka
CREATE DOMAIN star AS int CONSTRAINT valid_value CHECK (VALUE >= 0 AND VALUE <=5);