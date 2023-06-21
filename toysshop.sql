PGDMP         7                {            toyshops    15.2    15.2 &    "           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            #           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            $           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            %           1262    17231    toyshops    DATABASE     �   CREATE DATABASE toyshops WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'English_United States.1252';
    DROP DATABASE toyshops;
                postgres    false            �            1259    17238    category    TABLE     �   CREATE TABLE public.category (
    catid integer NOT NULL,
    catname character varying(100) NOT NULL,
    catdes text NOT NULL
);
    DROP TABLE public.category;
       public         heap    postgres    false            �            1259    17237    categories_catid_seq    SEQUENCE     �   CREATE SEQUENCE public.categories_catid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.categories_catid_seq;
       public          postgres    false    216            &           0    0    categories_catid_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.categories_catid_seq OWNED BY public.category.catid;
          public          postgres    false    215            �            1259    17265    product    TABLE     D  CREATE TABLE public.product (
    proid integer NOT NULL,
    proname character varying(50) NOT NULL,
    proquantity integer NOT NULL,
    proprice real NOT NULL,
    prodes text NOT NULL,
    proimage character varying(255) NOT NULL,
    catid integer NOT NULL,
    shopid integer NOT NULL,
    suppid integer NOT NULL
);
    DROP TABLE public.product;
       public         heap    postgres    false            �            1259    17264    product_proid_seq    SEQUENCE     �   CREATE SEQUENCE public.product_proid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.product_proid_seq;
       public          postgres    false    222            '           0    0    product_proid_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.product_proid_seq OWNED BY public.product.proid;
          public          postgres    false    221            �            1259    17256    shop    TABLE     �   CREATE TABLE public.shop (
    shopid integer NOT NULL,
    shopname character varying(50) NOT NULL,
    address text NOT NULL,
    phonenumber character varying(11) NOT NULL
);
    DROP TABLE public.shop;
       public         heap    postgres    false            �            1259    17255    shop_shopid_seq    SEQUENCE     �   CREATE SEQUENCE public.shop_shopid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.shop_shopid_seq;
       public          postgres    false    220            (           0    0    shop_shopid_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.shop_shopid_seq OWNED BY public.shop.shopid;
          public          postgres    false    219            �            1259    17247 	   suppliers    TABLE     �   CREATE TABLE public.suppliers (
    suppid integer NOT NULL,
    suppname character varying(50) NOT NULL,
    suppemail character varying(255) NOT NULL,
    suppaddress text NOT NULL
);
    DROP TABLE public.suppliers;
       public         heap    postgres    false            �            1259    17246    suppliers_suppid_seq    SEQUENCE     �   CREATE SEQUENCE public.suppliers_suppid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.suppliers_suppid_seq;
       public          postgres    false    218            )           0    0    suppliers_suppid_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.suppliers_suppid_seq OWNED BY public.suppliers.suppid;
          public          postgres    false    217            �            1259    17232    users    TABLE     �   CREATE TABLE public.users (
    username character varying(50) NOT NULL,
    email character varying(255) NOT NULL,
    phone character varying(11) NOT NULL,
    pass character varying(100) NOT NULL,
    roles boolean NOT NULL
);
    DROP TABLE public.users;
       public         heap    postgres    false            x           2604    17241    category catid    DEFAULT     r   ALTER TABLE ONLY public.category ALTER COLUMN catid SET DEFAULT nextval('public.categories_catid_seq'::regclass);
 =   ALTER TABLE public.category ALTER COLUMN catid DROP DEFAULT;
       public          postgres    false    216    215    216            {           2604    17268    product proid    DEFAULT     n   ALTER TABLE ONLY public.product ALTER COLUMN proid SET DEFAULT nextval('public.product_proid_seq'::regclass);
 <   ALTER TABLE public.product ALTER COLUMN proid DROP DEFAULT;
       public          postgres    false    222    221    222            z           2604    17259    shop shopid    DEFAULT     j   ALTER TABLE ONLY public.shop ALTER COLUMN shopid SET DEFAULT nextval('public.shop_shopid_seq'::regclass);
 :   ALTER TABLE public.shop ALTER COLUMN shopid DROP DEFAULT;
       public          postgres    false    220    219    220            y           2604    17250    suppliers suppid    DEFAULT     t   ALTER TABLE ONLY public.suppliers ALTER COLUMN suppid SET DEFAULT nextval('public.suppliers_suppid_seq'::regclass);
 ?   ALTER TABLE public.suppliers ALTER COLUMN suppid DROP DEFAULT;
       public          postgres    false    218    217    218                      0    17238    category 
   TABLE DATA           :   COPY public.category (catid, catname, catdes) FROM stdin;
    public          postgres    false    216   l*                 0    17265    product 
   TABLE DATA           q   COPY public.product (proid, proname, proquantity, proprice, prodes, proimage, catid, shopid, suppid) FROM stdin;
    public          postgres    false    222   �*                 0    17256    shop 
   TABLE DATA           F   COPY public.shop (shopid, shopname, address, phonenumber) FROM stdin;
    public          postgres    false    220   �*                 0    17247 	   suppliers 
   TABLE DATA           M   COPY public.suppliers (suppid, suppname, suppemail, suppaddress) FROM stdin;
    public          postgres    false    218   )+                 0    17232    users 
   TABLE DATA           D   COPY public.users (username, email, phone, pass, roles) FROM stdin;
    public          postgres    false    214   k+       *           0    0    categories_catid_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.categories_catid_seq', 1, true);
          public          postgres    false    215            +           0    0    product_proid_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.product_proid_seq', 1, true);
          public          postgres    false    221            ,           0    0    shop_shopid_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.shop_shopid_seq', 1, true);
          public          postgres    false    219            -           0    0    suppliers_suppid_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.suppliers_suppid_seq', 1, true);
          public          postgres    false    217                       2606    17245    category categories_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.category
    ADD CONSTRAINT categories_pkey PRIMARY KEY (catid);
 B   ALTER TABLE ONLY public.category DROP CONSTRAINT categories_pkey;
       public            postgres    false    216            �           2606    17272    product product_pkey 
   CONSTRAINT     U   ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_pkey PRIMARY KEY (proid);
 >   ALTER TABLE ONLY public.product DROP CONSTRAINT product_pkey;
       public            postgres    false    222            �           2606    17263    shop shop_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.shop
    ADD CONSTRAINT shop_pkey PRIMARY KEY (shopid);
 8   ALTER TABLE ONLY public.shop DROP CONSTRAINT shop_pkey;
       public            postgres    false    220            �           2606    17254    suppliers suppliers_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.suppliers
    ADD CONSTRAINT suppliers_pkey PRIMARY KEY (suppid);
 B   ALTER TABLE ONLY public.suppliers DROP CONSTRAINT suppliers_pkey;
       public            postgres    false    218            }           2606    17236    users users_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (username);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    214            �           2606    17273    product product_catid_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_catid_fkey FOREIGN KEY (catid) REFERENCES public.category(catid) ON DELETE CASCADE;
 D   ALTER TABLE ONLY public.product DROP CONSTRAINT product_catid_fkey;
       public          postgres    false    3199    216    222            �           2606    17278    product product_shopid_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_shopid_fkey FOREIGN KEY (shopid) REFERENCES public.shop(shopid) ON DELETE CASCADE;
 E   ALTER TABLE ONLY public.product DROP CONSTRAINT product_shopid_fkey;
       public          postgres    false    220    222    3203            �           2606    17283    product product_suppid_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_suppid_fkey FOREIGN KEY (suppid) REFERENCES public.suppliers(suppid) ON DELETE CASCADE;
 E   ALTER TABLE ONLY public.product DROP CONSTRAINT product_suppid_fkey;
       public          postgres    false    218    222    3201                  x�3�tN,Q0��
.��\1z\\\ @�         @   x�3�(�O)M.Q0�4�45�3�,NMK������, ��idddfdf��U��i�\1z\\\ ;�         3   x�3���/P0�T��Wp��T����PH�,��4��0735162����� ��
�         2   x�3�.-P0�T(.-0tH�M���K���tN�S��WH�,������ �         M   x��;
�  �99������5JA���)�-o��r`�]s˳L{78"�\�Y�-p�*�R�RRKyx;J	
o��cU�     