CREATE DATABASE shopbangiay;

USE shopbangiay;


CREATE TABLE admin (
    id int AUTO_INCREMENT PRIMARY KEY,
    taiKhoan varchar(100) not null,
    matKhau varchar(100) not null,
    username varchar(100) not null,
    dienThoai varchar(20),
    email varchar(100),
    trangThai tinyint
);

CREATE TABLE khach_hang (
    maKH int PRIMARY KEY AUTO_INCREMENT,
    tenKH VARCHAR(200) NOT NULL,
    taiKhoan varchar(200) NOT NULL UNIQUE,  
    matKhau VARCHAR(200) NOT NULL,
    diaChi VARCHAR(200) NOT NULL,
    dienThoai VARCHAR(11) NOT NULL UNIQUE,
    email VARCHAR(200) NOT NULL UNIQUE,
    ngaySinh DATE,
    ngayCapNhat DATETIME,
    gioiTinh tinyint,
    tichDiem int,
    trangThai tinyint
);


CREATE TABLE pt_thanh_toan (
    maPTTT int PRIMARY KEY AUTO_INCREMENT,
    tenPTTT VARCHAR(200),
    trangThai tinyint
);


CREATE TABLE hoa_don (
    maHD int PRIMARY KEY AUTO_INCREMENT,
    ngayHoaDon DATETIME DEFAULT CURDATE() NOT NULL,
    hoTenNguoiNhan varchar(200),
    diaChiNguoiNhan varchar(200),
    dienThoaiNguoiNhan varchar(11),
    diaChiEmail varchar(200),
    tongTien float,
    ngayGiaoHang DATETIME,
    trangThai tinyint,
    maKH int,
    MaPTTT int,
    CONSTRAINT fk_maKH FOREIGN KEY (maKH) REFERENCES khach_hang(maKH),
    CONSTRAINT fk_MaPTTT FOREIGN KEY (MaPTTT) REFERENCES pt_thanh_toan(MaPTTT)
);

CREATE TABLE nhan_hieu (
    maNH int PRIMARY KEY AUTO_INCREMENT,
    tenNH VARCHAR(200) NOT NULL,
    trangThai tinyint
);

CREATE TABLE loai_san_pham (
    maLSP int PRIMARY KEY AUTO_INCREMENT,
    tenLSP VARCHAR(200) NOT NULL,
    trangThai tinyint
);

CREATE TABLE san_pham (
    maSP int PRIMARY KEY AUTO_INCREMENT,
    tenSP VARCHAR(200) NOT NULL,
    anhSP VARCHAR(200),
    moTa TEXT,
    thongTin TEXT,
    giaNhap float NOT NULL,
    giaMoi float,
    luotXem int,
    ngayCapNhat DATE,
    trangThai tinyint,
    maLSP int,
    maNH int,
    CONSTRAINT fk_maLSP FOREIGN KEY (maLSP) REFERENCES loai_san_pham(maLSP),
    CONSTRAINT fk_maNH FOREIGN KEY (maNH) REFERENCES nhan_hieu(maNH)
);

CREATE TABLE hinh_anh (
    maHA int PRIMARY KEY AUTO_INCREMENT,
    tenHA VARCHAR(200) NOT NULL,
    trangThai tinyint,
    maSP int,
    CONSTRAINT fk_maSP_ha FOREIGN KEY (maSP) REFERENCES san_pham(maSP)
);
CREATE TABLE size (
    maSize int PRIMARY KEY AUTO_INCREMENT,
    tenSize VARCHAR(200),
    trangThai tinyint,
    maSP int,
    CONSTRAINT fk_maSP_S FOREIGN KEY (maSP) REFERENCES san_pham(maSP)
);

CREATE TABLE san_pham_ct (
    maSPCT int PRIMARY KEY AUTO_INCREMENT,
    so_luong int NOT NULL,
    maSP int,
    CONSTRAINT fk_maSP_ct FOREIGN KEY (maSP) REFERENCES san_pham(maSP)
);

CREATE TABLE ct_hoa_don (
    maHD int,
    maSPCT int,
    soLuongBan int,
    giaBan float,
    CONSTRAINT pk_ct_hoa_don PRIMARY KEY (maHD,maSPCT),
    CONSTRAINT fk_maHD FOREIGN KEY (maHD) REFERENCES hoa_don(maHD),
    CONSTRAINT fk_maSPCT FOREIGN KEY (maSPCT) REFERENCES san_pham_ct(maSPCT)
);

ALTER TABLE admin
ALTER trangThai SET DEFAULT 0;


INSERT INTO `khach_hang` (`tenKH`, `taiKhoan`, `matKhau`, `diaChi`, `dienThoai`, `email`, `ngaySinh`, `ngayCapNhat`, `gioiTinh`, `tichDiem`, `trangThai`) VALUES
('Trần Văn Tuấn Anh', 'famanh', md5('20002000'), 'Hà Nội', '0385474737', 'juva.tvta@gmail.com', '2004-01-12', NULL, 0, NULL, NULL);

INSERT INTO `nhan_hieu`(`tenNH`) VALUES ('Nike'),('Adidas'),('Jordan');

INSERT INTO `loai_san_pham` ( `tenLSP`) VALUES
('Nike Nam'),
('Nike Nữ'),
('Adidas Nam'),
('Adidas Nữ'),
('AIR Jordan');

INSERT INTO `admin`(`taiKhoan`, `matKhau`, `username`, `email`, `dienThoai`,`trangThai`) 
VALUES ('admin',md5('Admin123456'),'Tran Van Tuan Anh','juva.tvta@gmail.com','0974657361',1);

ALTER TABLE hoa_don
ALTER trangThai SET DEFAULT 1;

ALTER TABLE khach_hang
ALTER ngayCapNhat SET DEFAULT CURRENT_DATE;

INSERT INTO `san_pham` (`maSP`, `tenSP`, `anhSP`, `moTa`, `thongTin`, `giaNhap`, `giaMoi`, `luotXem`, `ngayCapNhat`, `trangThai`, `maLSP`, `maNH`) VALUES
(1, 'AIR FORCE 1', 'AIR FORCE 1.png', '<p><big><code><strong>AIR FORCE 1 </strong>l&agrave; một trong những đ&ocirc;i gi&agrave;y thể thao mang t&iacute;nh biểu tượng nhất tr&ecirc;n thế giới. N&oacute; được giới thiệu lần đầu ti&ecirc;n v&agrave;o năm 1982 như l&agrave; đ&ocirc;i gi&agrave;y b&oacute;ng rổ đầu ti&ecirc;n c&oacute; c&ocirc;ng nghệ Nike Air, đ&atilde; c&aacute;ch mạng h&oacute;a tr&ograve; chơi với đệm v&agrave; hỗ trợ vượt trội. Kể từ đ&oacute;, n&oacute; đ&atilde; vượt qua t&ograve;a &aacute;n v&agrave; trở th&agrave;nh một yếu tố ch&iacute;nh của văn h&oacute;a đường phố, thời trang v&agrave; &acirc;m nhạc. Trong b&agrave;i đăng tr&ecirc;n blog n&agrave;y, ch&uacute;ng ta sẽ kh&aacute;m ph&aacute; lịch sử, thiết kế v&agrave; t&aacute;c động của đ&ocirc;i gi&agrave;y huyền thoại n&agrave;y.</code></big></p>\r\n', NULL, 3000000, 3300000, NULL, '2023-04-20', 1, 1, 1),
(2, 'NIKE AIR MAX SYSTM', 'NIKE_AIR_MAX_SYSTM.png', '<h1>NIKE AIR MAX SYSTM: Một cấp độ mới của sự thoải m&aacute;i v&agrave; hiệu suất</h1>\r\n\r\n<p>Nếu bạn đang t&igrave;m kiếm một đ&ocirc;i gi&agrave;y thể thao c&oacute; thể theo kịp lối sống năng động của m&igrave;nh, bạn c&oacute; thể muốn xem <span style=\"color:#e74c3c\">NIKE AIR MAX SYSTM</span>. Đ&ocirc;i gi&agrave;y s&aacute;ng tạo n&agrave;y kết hợp c&aacute;c t&iacute;nh năng tốt nhất của d&ograve;ng AIR MAX mang t&iacute;nh biểu tượng với hệ thống đệm mới th&iacute;ch ứng với từng bước của bạn.</p>\r\n\r\n<p><span style=\"color:#e74c3c\">NIKE AIR MAX SYSTM</span> c&oacute; đế giữa hai lớp bao gồm một lớp bọt mềm v&agrave; bộ phận kh&ocirc;ng kh&iacute; chắc chắn hơn. Lớp xốp mang lại sự thoải m&aacute;i v&agrave; hỗ trợ, trong khi bộ phận kh&ocirc;ng kh&iacute; hấp thụ sốc v&agrave; mang lại khả năng đ&aacute;p ứng. Kết quả l&agrave; một chuyến đi &ecirc;m &aacute;i v&agrave; ổn định m&agrave; cảm thấy t&ugrave;y chỉnh cho đ&ocirc;i ch&acirc;n của bạn.</p>\r\n\r\n<p><br />\r\nPhần tr&ecirc;n của<span style=\"color:#e74c3c\"> NIKE AIR MAX SYSTM </span>được l&agrave;m bằng lưới tho&aacute;ng kh&iacute; v&agrave; vật liệu tổng hợp mang lại độ bền v&agrave; t&iacute;nh linh hoạt. Gi&agrave;y cũng c&oacute; lưỡi v&agrave; cổ &aacute;o c&oacute; đệm, mấu k&eacute;o g&oacute;t ch&acirc;n v&agrave; đ&oacute;ng ren để vừa vặn an to&agrave;n. Đế ngo&agrave;i được l&agrave;m bằng cao su với hoa văn b&aacute;nh quế cho lực k&eacute;o v&agrave; độ bền.</p>\r\n\r\n<p><span style=\"color:#e74c3c\">NIKE AIR MAX SYSTM</span> c&oacute; nhiều m&agrave;u sắc v&agrave; k&iacute;ch cỡ kh&aacute;c nhau cho nam v&agrave; nữ. Bạn c&oacute; thể t&igrave;m thấy ch&uacute;ng tại c&aacute;c nh&agrave; b&aacute;n lẻ NIKE chọn lọc hoặc trực tuyến tại nike.com. Cho d&ugrave; bạn đang chạy, đi bộ hay tập luyện, <span style=\"color:#e74c3c\">NIKE AIR MAX SYSTM </span>sẽ mang đến cho bạn sự thoải m&aacute;i v&agrave; hiệu suất bạn cần.<br />\r\n&nbsp;</p>\r\n', NULL, 2000000, 2900000, NULL, '2023-02-01', 1, 1, 1),
(3, 'NIKE PEGASUS 40', 'NIKE_PEGASUS_40.png', '<h1><span style=\"color:#e74c3c\">NIKE PEGASUS 40</span></h1>\r\n\r\n<p><span style=\"color:#e74c3c\">NIKE PEGASUS 40</span> l&agrave; phi&ecirc;n bản mới nhất của d&ograve;ng gi&agrave;y chạy bộ nổi tiếng đ&atilde; tồn tại được bốn thập kỷ. Gi&agrave;y được thiết kế để mang lại sự c&acirc;n bằng giữa đệm, khả năng đ&aacute;p ứng v&agrave; độ bền cho người chạy ở mọi cấp độ. Trong b&agrave;i đăng tr&ecirc;n blog n&agrave;y, t&ocirc;i sẽ chia sẻ kinh nghiệm của m&igrave;nh với <span style=\"color:#e74c3c\">NIKE PEGASUS 40</span> v&agrave; c&aacute;ch n&oacute; so s&aacute;nh với c&aacute;c mẫu trước đ&oacute;.</p>\r\n\r\n<p>Điều đầu ti&ecirc;n t&ocirc;i nhận thấy về <span style=\"color:#e74c3c\">NIKE PEGASUS 40</span> l&agrave; phần tr&ecirc;n được cập nhật. Gi&agrave;y c&oacute; chất liệu lưới tho&aacute;ng kh&iacute;, quấn quanh b&agrave;n ch&acirc;n vừa kh&iacute;t v&agrave; thoải m&aacute;i. Hộp ng&oacute;n ch&acirc;n đủ rộng để cho ph&eacute;p chơi ng&oacute;n ch&acirc;n tự nhi&ecirc;n, trong khi bộ đếm g&oacute;t ch&acirc;n mang lại sự vừa vặn an to&agrave;n v&agrave; ngăn ngừa trơn trượt. Gi&agrave;y cũng c&oacute; lưỡi v&agrave; cổ &aacute;o c&oacute; đệm l&agrave;m tăng th&ecirc;m sự thoải m&aacute;i v&agrave; ngăn ngừa k&iacute;ch ứng.</p>\r\n\r\n<p>Đế giữa của<span style=\"color:#e74c3c\"> NIKE PEGASUS 40 </span>l&agrave; nơi điều kỳ diệu xảy ra. Gi&agrave;y sử dụng bọt <span style=\"color:#e67e22\">NIKE REACT</span>, đ&acirc;y l&agrave; một chất liệu nhẹ v&agrave; bền, mang lại một chuyến đi mềm mại v&agrave; đ&agrave;n hồi. Bọt th&iacute;ch ứng với h&igrave;nh dạng v&agrave; chuyển động của b&agrave;n ch&acirc;n, mang lại trải nghiệm đệm được c&aacute; nh&acirc;n h&oacute;a. Gi&agrave;y cũng c&oacute; một bộ phận <span style=\"color:#27ae60\">Zoom Air</span> ở b&agrave;n ch&acirc;n trước, gi&uacute;p tăng th&ecirc;m khả năng phản hồi v&agrave; trả lại năng lượng.&nbsp;Sự kết hợp giữa <span style=\"color:#27ae60\">REACT</span> v&agrave; <span style=\"color:#27ae60\">Zoom Air</span> l&agrave;m cho<span style=\"color:#e74c3c\"> NIKE PEGASUS 40</span> trở th&agrave;nh một đ&ocirc;i gi&agrave;y đa năng c&oacute; thể xử l&yacute; mọi tốc độ v&agrave; khoảng c&aacute;ch.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', NULL, 3000000, 3600000, NULL, '2023-05-20', 1, 1, 1),
(4, 'NIKECOURT AIR ZOOM GP TURBO', 'NIKECOURT_AIR_ZOOM_GP_TURBO.png', '<p>Nếu bạn đang t&igrave;m kiếm một đ&ocirc;i gi&agrave;y tennis kết hợp tốc độ, sự thoải m&aacute;i v&agrave; độ bền, bạn c&oacute; thể muốn xem <span style=\"color:#e74c3c\">NIKECOURT AIR ZOOM GP TURBO</span>. Đ&ocirc;i gi&agrave;y n&agrave;y được thiết kế để gi&uacute;p bạn di chuyển nhanh hơn v&agrave; mượt m&agrave; hơn tr&ecirc;n s&acirc;n, đồng thời cung cấp đệm v&agrave; hỗ trợ cho đ&ocirc;i ch&acirc;n của bạn.</p>\r\n\r\n<p><span style=\"color:#e74c3c\">NIKECOURT AIR ZOOM GP TURBO</span> c&oacute; phần tr&ecirc;n bằng lưới tho&aacute;ng kh&iacute; quấn quanh b&agrave;n ch&acirc;n của bạn để vừa vặn v&agrave; bộ phận <span style=\"color:#27ae60\">Zoom Air </span>ở b&agrave;n ch&acirc;n trước mang lại năng lượng đ&aacute;p ứng. Đế ngo&agrave;i bằng cao su c&oacute; họa tiết xương c&aacute; mang lại lực k&eacute;o v&agrave; độ bền tr&ecirc;n mặt s&acirc;n cứng.&nbsp;</p>\r\n\r\n<p><span style=\"color:#e74c3c\">NIKECOURT AIR ZOOM GP TURBO</span> c&oacute; nhiều m&agrave;u sắc v&agrave; k&iacute;ch cỡ kh&aacute;c nhau, v&agrave; bạn c&oacute; thể t&igrave;m thấy n&oacute; tr&ecirc;n trang web ch&iacute;nh thức của <span style=\"color:#000000\">Nike</span> hoặc tại c&aacute;c nh&agrave; b&aacute;n lẻ được chọn. Cho d&ugrave; bạn l&agrave; người mới bắt đầu hay chuy&ecirc;n nghiệp, <span style=\"color:#e74c3c\">NIKECOURT AIR ZOOM GP TURBO </span>c&oacute; thể gi&uacute;p bạn đưa tr&ograve; chơi của m&igrave;nh l&ecirc;n một tầm cao mới.</p>\r\n', NULL, 3900000, 4200000, NULL, '2023-05-26', 1, 1, 1),
(5, 'NIKE EXPERIENCE RUN 11 NEXT', 'NIKE_EXPERIENCE_RUN_11_NEXT.png', '<h1><span style=\"color:#e74c3c\">NIKE EXPERIENCE RUN 11 NEXT</span></h1>\r\n\r\n<p>Nếu bạn đang t&igrave;m kiếm một đ&ocirc;i gi&agrave;y chạy bộ kết hợp sự thoải m&aacute;i, hiệu suất v&agrave; phong c&aacute;ch, bạn c&oacute; thể muốn xem <span style=\"color:#e74c3c\">NIKE EXPERIENCE RUN 11 NEXT</span>. Đ&acirc;y l&agrave; m&ocirc; h&igrave;nh mới nhất trong d&ograve;ng <span style=\"color:#27ae60\">EXPERIENCE RUN</span> nổi tiếng v&agrave; n&oacute; c&oacute; một số n&acirc;ng cấp s&aacute;ng tạo gi&uacute;p n&oacute; nổi bật giữa đ&aacute;m đ&ocirc;ng.</p>\r\n\r\n<p><span style=\"color:#e74c3c\">NIKE EXPERIENCE RUN 11 NEXT</span> c&oacute; phần tr&ecirc;n bằng lưới tho&aacute;ng kh&iacute; th&iacute;ch ứng với h&igrave;nh dạng v&agrave; chuyển động b&agrave;n ch&acirc;n của bạn, mang lại cảm gi&aacute;c vừa vặn v&agrave; n&acirc;ng đỡ. Gi&agrave;y cũng c&oacute; đế giữa bằng m&uacute;t mềm đệm từng bước v&agrave; đế ngo&agrave;i bằng cao su bền bỉ mang lại lực k&eacute;o v&agrave; độ bền tr&ecirc;n c&aacute;c bề mặt kh&aacute;c nhau. Gi&agrave;y được thiết kế nhẹ v&agrave; linh hoạt, cho ph&eacute;p bạn chạy dễ d&agrave;ng v&agrave; tự tin.</p>\r\n\r\n<p><span style=\"background-color:#dddddd\">Một trong những t&iacute;nh năng đặc biệt nhất của</span><span style=\"color:#e74c3c\"><span style=\"background-color:#dddddd\"> NIKE EXPERIENCE RUN 11 NEXT</span></span> l&agrave; c&ocirc;ng nghệ <span style=\"color:#27ae60\">NEXT%</span>, được lấy cảm hứng từ những đ&ocirc;i gi&agrave;y marathon ưu t&uacute; đ&atilde; ph&aacute; kỷ lục thế giới. C&ocirc;ng nghệ <span style=\"color:#27ae60\">NEXT%</span> bao gồm một tấm sợi carbon nh&uacute;ng trong đế giữa, gi&uacute;p tăng th&ecirc;m độ cứng v&agrave; khả năng phản hồi cho gi&agrave;y, gi&uacute;p bạn tiến về ph&iacute;a trước v&agrave; tiết kiệm năng lượng. Tấm n&agrave;y cũng tạo ra h&igrave;nh dạng bập b&ecirc;nh gi&uacute;p tối ưu h&oacute;a c&uacute; đ&aacute;nh v&agrave; chuyển tiếp bằng ch&acirc;n của bạn, gi&uacute;p bạn chạy hiệu quả v&agrave; mượt m&agrave; hơn.</p>\r\n\r\n<p><span style=\"color:#e74c3c\">NIKE EXPERIENCE RUN 11 NEXT </span>kh&ocirc;ng chỉ l&agrave; một đ&ocirc;i gi&agrave;y tuyệt vời để chạy bộ m&agrave; c&ograve;n để mặc h&agrave;ng ng&agrave;y. N&oacute; c&oacute; kiểu d&aacute;ng đẹp v&agrave; phong c&aacute;ch với nhiều m&agrave;u sắc v&agrave; k&iacute;ch cỡ kh&aacute;c nhau, v&igrave; vậy bạn c&oacute; thể t&igrave;m thấy chiếc ph&ugrave; hợp với sở th&iacute;ch v&agrave; c&aacute; t&iacute;nh của m&igrave;nh. Gi&agrave;y cũng c&oacute; logo phản chiếu v&agrave; c&aacute;c chi tiết gi&uacute;p tăng cường khả năng hiển thị của bạn trong điều kiện &aacute;nh s&aacute;ng yếu, gi&uacute;p bạn an to&agrave;n hơn v&agrave; dễ ch&uacute; &yacute; hơn.</p>\r\n\r\n<p>&nbsp;</p>\r\n', NULL, 1000000, 1800000, NULL, '2023-05-20', 1, 2, 1),
(6, 'NIKE QUEST 4', 'NIKE QUEST 4.png', '<h1><span style=\"color:#e74c3c\"><span style=\"background-color:#ecf0f1\">NIKE QUEST 4</span></span></h1>\r\n\r\n<p><span style=\"color:#000000\"><span style=\"background-color:#ecf0f1\">Nếu bạn đang t&igrave;m kiếm một đ&ocirc;i gi&agrave;y chạy bộ thoải m&aacute;i, nhẹ v&agrave; bền, bạn c&oacute; thể muốn tham khảo </span></span><span style=\"color:#e74c3c\"><span style=\"background-color:#ecf0f1\">NIKE QUEST 4</span></span><span style=\"color:#000000\"><span style=\"background-color:#ecf0f1\">. Đ&acirc;y l&agrave; mẫu mới nhất trong d&ograve;ng </span></span><span style=\"color:#27ae60\"><span style=\"background-color:#ecf0f1\">NIKE QUEST</span></span><span style=\"color:#000000\"><span style=\"background-color:#ecf0f1\">, được thiết kế d&agrave;nh cho những người chạy bộ h&agrave;ng ng&agrave;y muốn cải thiện hiệu suất v&agrave; tận hưởng chạy của họ.</span></span></p>\r\n\r\n<p><span style=\"color:#e74c3c\"><span style=\"background-color:#ecf0f1\">NIKE QUEST 4 </span></span><span style=\"color:#000000\"><span style=\"background-color:#ecf0f1\">c&oacute; mặt tr&ecirc;n bằng lưới tho&aacute;ng kh&iacute; &ocirc;m s&aacute;t b&agrave;n ch&acirc;n của bạn v&agrave; mang lại cảm gi&aacute;c vừa vặn. C&aacute;p Flywire t&iacute;ch hợp với d&acirc;y buộc để hỗ trợ th&ecirc;m v&agrave; ổn định. Lưỡi v&agrave; cổ &aacute;o đệm th&ecirc;m thoải m&aacute;i v&agrave; ngăn ngừa k&iacute;ch ứng.</span></span></p>\r\n\r\n<p><span style=\"color:#000000\"><span style=\"background-color:#ecf0f1\">Đế giữa của </span></span><span style=\"color:#e74c3c\"><span style=\"background-color:#ecf0f1\">NIKE QUEST 4</span></span><span style=\"color:#000000\"><span style=\"background-color:#ecf0f1\"> được l&agrave;m bằng bọt </span></span><span style=\"color:#2ecc71\"><span style=\"background-color:#ecf0f1\">Phylon</span></span><span style=\"color:#000000\"><span style=\"background-color:#ecf0f1\">, c&oacute; khả năng phản hồi v&agrave; giảm chấn. G&oacute;t ch&acirc;n c&oacute; bộ phận</span></span><span style=\"color:#27ae60\"><span style=\"background-color:#ecf0f1\"> Zoom Air</span></span><span style=\"color:#000000\"><span style=\"background-color:#ecf0f1\"> gi&uacute;p hấp thụ sốc v&agrave; mang lại sự chuyển tiếp mượt m&agrave;. B&agrave;n ch&acirc;n trước c&oacute; một miếng đệm cao su gi&uacute;p tăng cường độ bền v&agrave; lực k&eacute;o.</span></span></p>\r\n\r\n<p><span style=\"color:#000000\"><span style=\"background-color:#ecf0f1\">Đế ngo&agrave;i của </span></span><span style=\"color:#e74c3c\"><span style=\"background-color:#ecf0f1\">NIKE QUEST 4</span></span><span style=\"color:#000000\"><span style=\"background-color:#ecf0f1\"> bao gồm cao su c&oacute; hoa văn h&igrave;nh b&aacute;nh quế mang lại độ b&aacute;m v&agrave; t&iacute;nh linh hoạt tr&ecirc;n c&aacute;c bề mặt kh&aacute;c nhau. C&aacute;c r&atilde;nh uốn cong cho ph&eacute;p b&agrave;n ch&acirc;n của bạn di chuyển tự nhi&ecirc;n v&agrave; hiệu quả.</span></span></p>\r\n\r\n<p><span style=\"color:#e74c3c\"><span style=\"background-color:#ecf0f1\">NIKE QUEST 4</span></span><span style=\"color:#000000\"><span style=\"background-color:#ecf0f1\"> l&agrave; sự lựa chọn tuyệt vời cho những người chạy muốn c&oacute; một đ&ocirc;i gi&agrave;y đa năng, đ&aacute;ng tin cậy v&agrave; phong c&aacute;ch c&oacute; thể xử l&yacute; c&aacute;c khoảng c&aacute;ch v&agrave; tốc độ kh&aacute;c nhau. N&oacute; c&oacute; nhiều m&agrave;u sắc v&agrave; k&iacute;ch cỡ kh&aacute;c nhau, v&agrave; bạn c&oacute; thể t&igrave;m thấy n&oacute; ở cửa h&agrave;ng NIKE gần nhất hoặc trực tuyến.</span></span></p>\r\n', NULL, 2000000, 2300000, NULL, '2023-02-04', 1, 2, 1),
(7, 'NIKE STAR RUNNER 3', 'NIKE_STAR_RUNNER_3.png', '<h1><span style=\"color:#e74c3c\"><span style=\"background-color:#dddddd\">NIKE STAR RUNNER 3</span></span></h1>\r\n\r\n<p>Nếu bạn đang t&igrave;m kiếm một đ&ocirc;i gi&agrave;y c&oacute; thể vượt qua mọi địa h&igrave;nh, tốc độ v&agrave; khoảng c&aacute;ch, bạn c&oacute; thể muốn tham khảo<span style=\"font-size:14px\"> <span style=\"color:#e74c3c\">NIKE STAR RUNNER 3</span></span>. Đ&acirc;y l&agrave; mẫu mới nhất của d&ograve;ng <span style=\"color:#27ae60\">STAR RUNNER</span> nổi tiếng, được giới chạy bộ khen ngợi v&agrave; c&aacute;c vận động vi&ecirc;n v&igrave; sự thoải m&aacute;i, độ bền v&agrave; hiệu suất của n&oacute;.</p>\r\n\r\n<p><span style=\"color:#e74c3c\">NIKE STAR RUNNER 3</span> c&oacute; mặt tr&ecirc;n bằng lưới tho&aacute;ng kh&iacute; th&iacute;ch ứng với h&igrave;nh dạng v&agrave; chuyển động của b&agrave;n ch&acirc;n bạn, mang lại cảm gi&aacute;c vừa vặn v&agrave; chắc chắn. Đế giữa được l&agrave;m bằng bọt mềm gi&uacute;p đệm từng bước v&agrave; hấp thụ sốc, trong khi đế ngo&agrave;i c&oacute; vỏ cao su mang lại lực k&eacute;o v&agrave; độ ổn định tr&ecirc;n c&aacute;c bề mặt kh&aacute;c nhau. Gi&agrave;y cũng c&oacute; bộ đếm g&oacute;t ch&acirc;n gi&uacute;p cố định b&agrave;n ch&acirc;n của bạn v&agrave; chống trơn trượt.</p>\r\n\r\n<p><span style=\"color:#e74c3c\">NIKE STAR RUNNER 3 </span>được thiết kế d&agrave;nh cho người chạy ở mọi cấp độ, từ người mới bắt đầu đến chuy&ecirc;n gia. N&oacute; c&oacute; thể được sử dụng cho c&aacute;c buổi chạy b&igrave;nh thường, c&aacute;c buổi huấn luyện hoặc c&aacute;c cuộc đua. Gi&agrave;y nhẹ v&agrave; nhạy, cho ph&eacute;p bạn chạy nhanh hơn v&agrave; l&acirc;u hơn m&agrave; kh&ocirc;ng cảm thấy mệt mỏi. Gi&agrave;y cũng c&oacute; kiểu d&aacute;ng đẹp v&agrave; phong c&aacute;ch c&oacute; thể ph&ugrave; hợp với bất kỳ trang phục n&agrave;o.</p>\r\n', NULL, 2000000, 2200000, NULL, '2023-03-20', 1, 2, 1),
(8, 'AIR JORDAN 1 HI CHICAGO', 'AIR_JORDAN_1_HI_CHICAGO.png', '<h1><span style=\"color:#e74c3c\"><span style=\"background-color:#ecf0f1\">AIR JORDAN 1 HI CHICAGO</span></span></h1>\r\n\r\n<p><span style=\"color:#e74c3c\">AIR JORDAN 1 HI CHICAGO</span> l&agrave; một trong những đ&ocirc;i gi&agrave;y thể thao mang t&iacute;nh biểu tượng nhất mọi thời đại.<span style=\"color:#27ae60\"><span style=\"background-color:#ecf0f1\"> N&oacute; được ra mắt lần đầu ti&ecirc;n v&agrave;o năm 1985, khi Michael Jordan c&ograve;n l&agrave; t&acirc;n binh tại NBA. Gi&agrave;y c&oacute; t&ocirc;ng m&agrave;u đỏ, trắng v&agrave; đen ph&ugrave; hợp với đồng phục của Chicago Bulls</span></span><span style=\"color:#1abc9c\">.</span> Đ&ocirc;i gi&agrave;y n&agrave;y cũng c&oacute; kiểu d&aacute;ng cổ cao, mặt tr&ecirc;n bằng da, đế ngo&agrave;i bằng cao su v&agrave; hệ thống đệm Nike Air. AIR <span style=\"color:#e74c3c\">JORDAN 1 HI CHICAGO</span> kh&ocirc;ng chỉ l&agrave; một phần cổ điển của lịch sử b&oacute;ng rổ, m&agrave; c&ograve;n l&agrave; một tuy&ecirc;n bố thời trang vượt qua thể thao v&agrave; văn h&oacute;a. Cho d&ugrave; bạn l&agrave; fan h&acirc;m mộ của MJ, Bulls hay chỉ l&agrave; những người y&ecirc;u th&iacute;ch gi&agrave;y thể thao n&oacute;i chung, bạn sẽ kh&ocirc;ng thể bỏ qua mẫu gi&agrave;y vượt thời gian n&agrave;y.</p>\r\n', NULL, 10000000, 12000000, NULL, '2023-06-01', 1, 5, 3),
(9, 'AIR JORDAN 1 LOW', 'AIR_JORDAN_1_LOW.png', '<h1><span style=\"color:#e74c3c\"><span style=\"background-color:#ecf0f1\">AIR JORDAN 1 LOW</span></span></h1>\r\n\r\n<p>Nếu bạn l&agrave; một t&iacute;n đồ của gi&agrave;y thể thao, chắc hẳn bạn đ&atilde; biết đến biểu tượng <span style=\"color:#e74c3c\"><span style=\"font-size:14px\">AIR JORDAN 1 LOW</span></span>. Mẫu gi&agrave;y n&agrave;y l&agrave; phi&ecirc;n bản cổ thấp của Air Jordan 1 ban đầu, được ph&aacute;t h&agrave;nh v&agrave;o năm 1985 v&agrave; tạo n&ecirc;n một cuộc c&aacute;ch mạng tr&ecirc;n thị trường gi&agrave;y b&oacute;ng rổ. <span style=\"color:#e74c3c\">AIR JORDAN 1 LOW</span> c&oacute; c&aacute;c yếu tố thiết kế cổ điển giống như gi&agrave;y cao cổ, chẳng hạn như mặt tr&ecirc;n bằng da, Nike Swoosh, logo Wings v&agrave; đế ngo&agrave;i bằng cao su. Tuy nhi&ecirc;n, &aacute;o cổ thấp mang lại sự linh hoạt v&agrave; thoải m&aacute;i hơn cho trang phục h&agrave;ng ng&agrave;y. <span style=\"color:#e74c3c\">AIR JORDAN 1 LOW</span> c&oacute; nhiều m&agrave;u sắc v&agrave; phong c&aacute;ch kh&aacute;c nhau, từ c&aacute;c phi&ecirc;n bản OG b&agrave;y tỏ l&ograve;ng k&iacute;nh trọng đối với sự nghiệp huyền thoại của Michael Jordan, cho đến sự hợp t&aacute;c với c&aacute;c nghệ sĩ v&agrave; thương hiệu như Travis Scott, Dior v&agrave; Off-White. Cho d&ugrave; bạn đang t&igrave;m kiếm một m&oacute;n đồ b&igrave;nh thường hay một m&oacute;n đồ nổi bật, <span style=\"color:#e74c3c\">AIR JORDAN 1 LOW</span> đều c&oacute; thứ d&agrave;nh cho tất cả mọi người.</p>\r\n', NULL, 4000000, 4800000, NULL, '2023-02-02', 1, 5, 3),
(10, 'AIR JORDAN 1 LOW CARDINAL RED', 'AIR_JORDAN_1_LOW_CARDINAL_RED.png', '<h1><span style=\"color:#e74c3c\"><span style=\"background-color:#ecf0f1\">AIR JORDAN 1 LOW CARDINAL RED</span></span></h1>\r\n\r\n<p><span style=\"color:#e74c3c\">AIR JORDAN 1 LOW CARDINAL RED </span>l&agrave; một đ&ocirc;i gi&agrave;y thể thao cổ điển kết hợp giữa phong c&aacute;ch v&agrave; sự thoải m&aacute;i. H&igrave;nh b&oacute;ng cổ thấp c&oacute; phần tr&ecirc;n bằng da m&agrave;u trắng với c&aacute;c điểm nhấn m&agrave;u đỏ tr&ecirc;n Swoosh, g&oacute;t, lưỡi g&agrave; v&agrave; đế ngo&agrave;i. Gi&agrave;y cũng c&oacute; lưỡi nylon m&agrave;u đen với logo Jumpman mang t&iacute;nh biểu tượng v&agrave; cổ gi&agrave;y c&oacute; đệm để hỗ trợ th&ecirc;m. <span style=\"color:#e74c3c\">AIR JORDAN 1 LOW CARDINAL RED</span> l&agrave; một đ&ocirc;i gi&agrave;y linh hoạt c&oacute; thể được mang với trang phục giản dị hoặc trang trọng, v&agrave; l&agrave; m&oacute;n đồ kh&ocirc;ng thể thiếu đối với bất kỳ người y&ecirc;u gi&agrave;y thể thao n&agrave;o.</p>\r\n', NULL, 4000000, 5800000, NULL, '2023-02-20', 1, 5, 3),
(11, 'AIR JORDAN 4 BLACK', 'AIR_JORDAN_4_BLACK.png', '<h1><span style=\"color:#e74c3c\"><span style=\"background-color:#ecf0f1\">AIR JORDAN 4 BLACK: Gi&agrave;y thể thao cổ điển cho thời hiện đại</span></span></h1>\r\n\r\n<p>Nếu bạn đang t&igrave;m kiếm một đ&ocirc;i gi&agrave;y thể thao kết hợp phong c&aacute;ch, sự thoải m&aacute;i v&agrave; hiệu suất, bạn kh&ocirc;ng thể bỏ qua<span style=\"font-size:14px\"><span style=\"color:#e74c3c\"> AIR JORDAN 4 BLACK</span></span>. Đ&ocirc;i gi&agrave;y mang t&iacute;nh biểu tượng n&agrave;y được ph&aacute;t h&agrave;nh lần đầu ti&ecirc;n v&agrave;o năm 1989 v&agrave; đ&atilde; trở th&agrave;nh m&oacute;n đồ y&ecirc;u th&iacute;ch của c&aacute;c sneakerhead kể từ đ&oacute;. <span style=\"color:#e74c3c\">AIR JORDAN 4 BLACK</span> c&oacute; mặt tr&ecirc;n bằng da m&agrave;u đen b&oacute;ng mượt với c&aacute;c tấm lưới để tho&aacute;ng kh&iacute;, đế giữa c&oacute; đệm với c&aacute;c bộ phận Air c&oacute; thể nh&igrave;n thấy để hấp thụ sốc v&agrave; đế ngo&agrave;i bằng cao su c&oacute; hoa văn xương c&aacute; để tạo lực k&eacute;o. Gi&agrave;y cũng c&oacute; một số chi tiết đặc biệt, chẳng hạn như logo &quot;Chuyến bay&quot; tr&ecirc;n lưỡi g&agrave;, kh&oacute;a ren bằng nhựa v&agrave; mấu g&oacute;t c&oacute; logo Jumpman. Cho d&ugrave; bạn đang chơi b&oacute;ng rổ, tập gym hay chỉ đi chơi với bạn b&egrave;, <span style=\"color:#e74c3c\">AIR JORDAN 4 BLACK</span> sẽ khiến bạn nổi bật giữa đ&aacute;m đ&ocirc;ng. Dưới đ&acirc;y l&agrave; một số mẹo về c&aacute;ch tạo kiểu cho đ&ocirc;i gi&agrave;y thể thao cổ điển n&agrave;y cho những dịp kh&aacute;c nhau:</p>\r\n\r\n<p>Để c&oacute; phong c&aacute;ch giản dị, h&atilde;y kết hợp<span style=\"color:#e74c3c\"> AIR JORDAN 4 BLACK</span> với quần jean v&agrave; &aacute;o ph&ocirc;ng hoặc &aacute;o hoodie. Bạn cũng c&oacute; thể th&ecirc;m một số phụ kiện như mũ lưỡi trai, đồng hồ hay ba l&ocirc; để ho&agrave;n thiện bộ trang phục.<br />\r\nĐể c&oacute; phong c&aacute;ch giản dị lịch sự, h&atilde;y kết hợp <span style=\"color:#e74c3c\">AIR JORDAN 4 BLACK</span> với quần chinos v&agrave; &aacute;o sơ mi polo hoặc &aacute;o sơ mi c&agrave;i khuy. Bạn cũng c&oacute; thể kho&aacute;c th&ecirc;m &aacute;o blazer hoặc &aacute;o len để c&oacute; vẻ ngo&agrave;i b&oacute;ng bẩy hơn.</p>\r\n\r\n<p>Để c&oacute; phong c&aacute;ch thể thao, h&atilde;y mặc <span style=\"color:#e74c3c\">AIR JORDAN 4 BLACK</span> với quần đ&ugrave;i v&agrave; &aacute;o ba lỗ hoặc &aacute;o sơ mi. Bạn cũng c&oacute; thể mặc th&ecirc;m &aacute;o kho&aacute;c hoặc &aacute;o nỉ để tăng th&ecirc;m độ ấm hoặc mặc nhiều lớp.</p>\r\n', NULL, 7000000, 9000000, NULL, '2023-04-20', 1, 5, 3),
(12, 'AIR JORDAN 4 BLUE', 'AIR_JORDAN_4_BLUE.png', '<h1><span style=\"color:#e74c3c\"><span style=\"background-color:#ecf0f1\">AIR JORDAN 4 BLUE</span></span></h1>\r\n\r\n<p>Nếu l&agrave; một t&iacute;n đồ của gi&agrave;y thể thao, chắc hẳn bạn cũng biết <span style=\"color:#27ae60\">Air Jordan 4</span> l&agrave; một trong những mẫu gi&agrave;y mang t&iacute;nh biểu tượng v&agrave; phổ biến nhất trong lịch sử gi&agrave;y b&oacute;ng rổ. <span style=\"color:#27ae60\">Air Jordan 4</span> được ph&aacute;t h&agrave;nh lần đầu ti&ecirc;n v&agrave;o năm 1989, v&agrave; n&oacute; l&agrave; chiếc gi&agrave;y thứ hai m&agrave; Michael Jordan mang trong trận chung kết NBA, nơi anh dẫn dắt Chicago Bulls đến chức v&ocirc; địch đầu ti&ecirc;n của họ. <span style=\"color:#27ae60\">Air Jordan 4</span> được biết đến với thiết kế b&oacute;ng bẩy, kh&oacute;a ren đặc trưng v&agrave; bộ phận kh&ocirc;ng kh&iacute; c&oacute; thể nh&igrave;n thấy ở g&oacute;t ch&acirc;n.</p>\r\n\r\n<p>Nhưng bạn c&oacute; biết rằng c&oacute; một phối m&agrave;u mới của Air Jordan 4 sắp ra mắt kh&ocirc;ng? N&oacute; được gọi l&agrave; <strong><span style=\"color:#e74c3c\"><span style=\"font-size:14px\">Air Jordan 4 Blue</span></span></strong>, v&agrave; n&oacute; c&oacute; sự kết hợp tuyệt đẹp giữa m&agrave;u xanh lam, trắng v&agrave; đen ở phần tr&ecirc;n, đế giữa v&agrave; đế ngo&agrave;i. M&agrave;u xanh được lấy cảm hứng từ bầu trời, đại dương v&agrave; tự do ng&ocirc;n luận. <strong><span style=\"font-size:14px\"><span style=\"color:#e74c3c\">Air Jordan 4 Blue </span></span></strong>l&agrave; sự t&ocirc;n vinh di sản của Michael Jordan, niềm đam m&ecirc; của anh ấy với tr&ograve; chơi v&agrave; t&igrave;nh y&ecirc;u của anh ấy d&agrave;nh cho người h&acirc;m mộ.</p>\r\n', NULL, 6000000, 6800000, NULL, '2023-04-29', 1, 5, 3),
(13, 'JORDAN 1 HI RETRO 85', 'JORDAN_1_HI_RETRO_85.png', '<h1><span style=\"color:#e74c3c\"><span style=\"background-color:#ecf0f1\">JORDAN 1 HI RETRO 85</span></span></h1>\r\n\r\n<p>Nếu bạn l&agrave; người y&ecirc;u th&iacute;ch gi&agrave;y thể thao, c&oacute; lẽ bạn sẽ biết đến <span style=\"color:#e74c3c\"><span style=\"font-size:14px\"><strong>JORDAN 1 HI RETRO 85</strong></span></span> mang t&iacute;nh biểu tượng. Đ&ocirc;i gi&agrave;y n&agrave;y l&agrave; sự t&ocirc;n vinh d&agrave;nh cho chiếc <span style=\"color:#27ae60\">Air Jordan 1</span> nguy&ecirc;n bản m&agrave; Michael Jordan đ&atilde; mang trong m&ugrave;a giải t&acirc;n binh của anh ấy v&agrave;o năm 1985. <span style=\"font-size:14px\"><strong><span style=\"color:#e74c3c\">JORDAN 1 HI RETRO 85</span></strong></span> c&oacute; đặc điểm cao -h&igrave;nh b&oacute;ng tr&ecirc;n c&ugrave;ng, phần tr&ecirc;n bằng da cao cấp v&agrave; c&aacute;c đường phối m&agrave;u cổ điển b&agrave;y tỏ l&ograve;ng k&iacute;nh trọng đối với lịch sử v&agrave; di sản của MJ cũng như d&ograve;ng gi&agrave;y thể thao đặc trưng của &ocirc;ng.</p>\r\n\r\n<p><span style=\"color:#e74c3c\"><strong><span style=\"font-size:14px\">JORDAN 1 HI RETRO 85</span></strong></span> kh&ocirc;ng chỉ l&agrave; một đ&ocirc;i gi&agrave;y phong c&aacute;ch v&agrave; thoải m&aacute;i, m&agrave; c&ograve;n l&agrave; một m&oacute;n đồ sưu tầm. Đ&ocirc;i gi&agrave;y n&agrave;y được sản xuất giới hạn chỉ 23.000 đ&ocirc;i tr&ecirc;n to&agrave;n thế giới, khiến n&oacute; trở th&agrave;nh một trong những đ&ocirc;i gi&agrave;y thể thao hiếm v&agrave; được săn l&ugrave;ng nhiều nhất tr&ecirc;n thị trường. Gi&agrave;y cũng đi k&egrave;m với một thẻ treo đặc biệt c&oacute; số s&ecirc;-ri duy nhất, l&agrave;m tăng th&ecirc;m t&iacute;nh độc quyền v&agrave; gi&aacute; trị của n&oacute;.</p>\r\n\r\n<p>JORDAN 1 HI RETRO 85 l&agrave; đ&ocirc;i gi&agrave;y kh&ocirc;ng thể bỏ qua đối với bất kỳ t&iacute;n đồ sneakerhead hoặc người h&acirc;m mộ Jordan n&agrave;o, v&igrave; n&oacute; đại diện cho một phần lịch sử văn h&oacute;a b&oacute;ng rổ v&agrave; gi&agrave;y thể thao.</p>\r\n', NULL, 8000000, 10000000, NULL, '2023-04-03', 1, 5, 3),
(14, 'JORDAN 1 LOW CRAFT', 'JORDAN_1_LOW_CRAFT.png', '<h1><strong><span style=\"color:#e74c3c\"><span style=\"background-color:#ecf0f1\">JORDAN 1 LOW CRAFT</span></span></strong></h1>\r\n\r\n<p>Nếu bạn l&agrave; người h&acirc;m mộ h&igrave;nh b&oacute;ng Air Jordan 1 cổ điển, bạn c&oacute; thể muốn xem qua <strong><span style=\"color:#e74c3c\"><span style=\"font-size:14px\">JORDAN 1 LOW CRAFT</span></span></strong>. Gi&agrave;y thể thao n&agrave;y l&agrave; phi&ecirc;n bản cổ thấp của mẫu gi&agrave;y mang t&iacute;nh biểu tượng, nhưng với một số điểm kh&aacute;c biệt tinh tế khiến n&oacute; trở n&ecirc;n nổi bật.</p>\r\n\r\n<p><span style=\"font-size:14px\"><span style=\"color:#e74c3c\"><strong>JORDAN 1 LOW CRAFT </strong></span></span>c&oacute; phần tr&ecirc;n bằng da cao cấp với c&aacute;c lớp phủ da lộn, mang lại vẻ ngo&agrave;i mượt m&agrave; v&agrave; sang trọng. Đường m&agrave;u chủ yếu l&agrave; trắng v&agrave; đen, với một ch&uacute;t m&agrave;u đỏ tr&ecirc;n lưỡi, g&oacute;t v&agrave; đế ngo&agrave;i. Gi&agrave;y thể thao cũng c&oacute; hộp ng&oacute;n ch&acirc;n đục lỗ để tho&aacute;ng kh&iacute; v&agrave; cổ gi&agrave;y c&oacute; đệm để tạo sự thoải m&aacute;i.</p>\r\n\r\n<p>Một trong những t&iacute;nh năng đ&aacute;ng ch&uacute; &yacute; nhất của <strong><span style=\"font-size:14px\"><span style=\"color:#e74c3c\">JORDAN 1 LOW CRAFT </span></span></strong>l&agrave;<span style=\"color:#27ae60\"> logo Swoosh</span> được kh&acirc;u ở hai b&ecirc;n, bổ sung th&ecirc;m một số kết cấu v&agrave; k&iacute;ch thước cho gi&agrave;y. Đường kh&acirc;u cũng k&eacute;o d&agrave;i đến logo đ&ocirc;i c&aacute;nh ở g&oacute;t ch&acirc;n v&agrave; nh&atilde;n hiệu Nike Air tr&ecirc;n lưỡi gi&agrave;y. Gi&agrave;y thể thao c&oacute; đế bằng cao su với bộ phận Air ở g&oacute;t ch&acirc;n, mang lại khả năng đệm v&agrave; độ bền.</p>\r\n\r\n<p><strong><span style=\"color:#e74c3c\"><span style=\"font-size:14px\">JORDAN 1 LOW CRAFT</span></span></strong> l&agrave; một đ&ocirc;i gi&agrave;y thể thao kiểu d&aacute;ng đẹp v&agrave; phong c&aacute;ch, thể hiện sự t&ocirc;n k&iacute;nh đối với <span style=\"color:#27ae60\">Air Jordan 1</span> nguy&ecirc;n bản, nhưng mang hơi hướng hiện đại.</p>\r\n', NULL, 3500000, 4800000, NULL, '2022-09-08', 1, 5, 3),
(15, 'NIKE AIR JORDAN 4 PINE GREEN', 'NIKE_AIR_JORDAN_4_PINE_GREEN.png', '<h1><strong><span style=\"color:#e74c3c\"><span style=\"background-color:#ecf0f1\">NIKE AIR JORDAN 4 PINE GREEN</span></span></strong></h1>\r\n\r\n<p>Nếu bạn l&agrave; một t&iacute;n đồ của gi&agrave;y thể thao, chắc hẳn bạn cũng biết rằng<strong><span style=\"color:#e74c3c\"><span style=\"font-size:14px\"> NIKE AIR JORDAN 4 PINE GREEN</span></span></strong> l&agrave; một trong những phi&ecirc;n bản được mong đợi nhất trong năm. Mẫu mang t&iacute;nh biểu tượng n&agrave;y, được ra mắt lần đầu ti&ecirc;n v&agrave;o năm 1989, đ&atilde; được cải tiến với m&agrave;u sắc tươi mới để b&agrave;y tỏ l&ograve;ng k&iacute;nh trọng đối với trường cũ của Michael Jordan, Đại học Bắc Carolina. Gi&agrave;y c&oacute; phần tr&ecirc;n bằng da m&agrave;u trắng với c&aacute;c điểm nhấn m&agrave;u xanh l&aacute; th&ocirc;ng ở lỗ xỏ d&acirc;y, lưỡi g&agrave;, g&oacute;t ch&acirc;n v&agrave; đế ngo&agrave;i.<span style=\"color:#27ae60\"> Logo Jumpman</span> đặc trưng cũng được th&ecirc;u bằng m&agrave;u xanh l&aacute; th&ocirc;ng tr&ecirc;n lưỡi g&agrave; v&agrave; g&oacute;t gi&agrave;y. <span style=\"font-size:14px\"><strong><span style=\"color:#e74c3c\">NIKE AIR JORDAN 4 PINE GREEN</span></strong></span> l&agrave; sản phẩm kh&ocirc;ng thể bỏ qua đối với bất kỳ nh&agrave; sưu tập gi&agrave;y thể thao hoặc người đam m&ecirc; b&oacute;ng rổ n&agrave;o. N&oacute; kết hợp phong c&aacute;ch cổ điển, sự thoải m&aacute;i v&agrave; hiệu suất trong một g&oacute;i tuyệt đẹp.</p>\r\n', NULL, 8000000, 9500000, NULL, '2022-12-07', 1, 5, 3),
(16, 'ADIDAS FORUM LOW CL', 'ADIDAS_FORUM_LOW_CL.png', '<h1><strong><span style=\"color:#e74c3c\"><span style=\"background-color:#ecf0f1\">ADIDAS FORUM LOW CL</span></span></strong></h1>\r\n\r\n<p>Nếu bạn đang t&igrave;m kiếm một đ&ocirc;i gi&agrave;y thể thao cổ điển với hơi hướng hiện đại, bạn c&oacute; thể muốn xem <strong><span style=\"font-size:14px\"><span style=\"color:#e74c3c\">ADIDAS FORUM LOW CL</span></span></strong>. Mẫu gi&agrave;y n&agrave;y được lấy cảm hứng từ <span style=\"color:#27ae60\">ADIDAS FORUM</span> ban đầu, ra mắt v&agrave;o năm 1984 dưới dạng gi&agrave;y b&oacute;ng rổ. <strong><span style=\"font-size:14px\"><span style=\"color:#e74c3c\">ADIDAS FORUM LOW CL </span></span></strong>nổi bật với kiểu d&aacute;ng cổ thấp, mặt tr&ecirc;n bằng da với c&aacute;c chi tiết đục lỗ v&agrave; d&acirc;y đeo m&oacute;c v&agrave; v&ograve;ng để vừa vặn chắc chắn. Gi&agrave;y cũng c&oacute; đế ngo&agrave;i bằng cao su với một điểm xoay để tạo lực k&eacute;o v&agrave; độ bền. <strong><span style=\"font-size:14px\"><span style=\"color:#e74c3c\">ADIDAS FORUM LOW CL</span></span></strong> c&oacute; nhiều m&agrave;u kh&aacute;c nhau, chẳng hạn như trắng, đen, xanh nước biển v&agrave; đỏ. Cho d&ugrave; bạn đang t&igrave;m kiếm một phong c&aacute;ch giản dị hay thể thao, <span style=\"font-size:14px\"><strong><span style=\"color:#e74c3c\">ADIDAS FORUM LOW CL</span></strong></span> c&oacute; thể th&ecirc;m một số n&eacute;t tinh tế cổ điển v&agrave;o trang phục của bạn.</p>\r\n', NULL, 2300000, 3200000, NULL, '2023-02-24', 1, 3, 2),
(17, 'ADIDAS GRADAS CLOUD WHITE', 'ADIDAS_GRADAS_CLOUD_WHITE.png', '<h1><strong><span style=\"color:#e74c3c\"><span style=\"background-color:#ecf0f1\">ADIDAS GRADAS CLOUD WHITE</span></span></strong></h1>\r\n\r\n<p>Bạn đang t&igrave;m kiếm những đ&ocirc;i gi&agrave;y thể thao thoải m&aacute;i, đa năng v&agrave; phong c&aacute;ch? Vậy th&igrave; bạn sẽ th&iacute;ch <strong><span style=\"font-size:14px\"><span style=\"color:#e74c3c\">ADIDAS GRADAS CLOUD WHITE</span></span></strong>, mẫu mới của thương hiệu Đức kết hợp những g&igrave; tốt nhất giữa c&ocirc;ng nghệ v&agrave; thiết kế. Những đ&ocirc;i gi&agrave;y n&agrave;y c&oacute; đế cao su linh hoạt th&iacute;ch ứng với bước đi của bạn, mặt tr&ecirc;n bằng lưới tho&aacute;ng kh&iacute; gi&uacute;p bạn lu&ocirc;n m&aacute;t mẻ v&agrave; hệ thống d&acirc;y buộc t&iacute;ch hợp gi&uacute;p bạn vừa vặn ho&agrave;n hảo. Ngo&agrave;i ra, m&agrave;u trắng của n&oacute; với c&aacute;c chi tiết m&agrave;u đen v&agrave; đỏ mang lại n&eacute;t thanh lịch v&agrave; thể thao cho diện mạo của bạn. <span style=\"font-size:14px\"><span style=\"color:#e74c3c\"><strong>ADIDAS GRADAS CLOUD WHITE</strong></span></span> l&yacute; tưởng để sử dụng h&agrave;ng ng&agrave;y, cho d&ugrave; l&agrave; đi l&agrave;m, tập gym hay đi dạo quanh th&agrave;nh phố.</p>\r\n', NULL, 2000000, 2900000, NULL, '2023-04-08', 1, 3, 2),
(18, 'ADIDAS ULTRA4D SUN DEVILS', 'ADIDAS_ULTRA4D_SUN_DEVILS.png', '<h1><strong><span style=\"color:#e74c3c\"><span style=\"background-color:#ecf0f1\">Adidas Ultra4D Sun Devils</span></span></strong></h1>\r\n\r\n<p>Nếu bạn l&agrave; người h&acirc;m mộ Đại học bang Arizona v&agrave; Adidas, bạn c&oacute; thể muốn xem sản phẩm hợp t&aacute;c mới nhất giữa hai b&ecirc;n: <strong><span style=\"color:#e74c3c\"><span style=\"font-size:14px\">Adidas Ultra4D Sun Devils</span></span></strong>. Đ&acirc;y l&agrave; một đ&ocirc;i gi&agrave;y thể thao phi&ecirc;n bản giới hạn c&oacute; m&agrave;u sắc v&agrave; logo của ASU, cũng như c&ocirc;ng nghệ đế giữa 4D cải tiến cung cấp đệm v&agrave; hỗ trợ th&iacute;ch ứng.<strong><span style=\"color:#e74c3c\"><span style=\"font-size:14px\"> Adidas Ultra4D Sun Devils </span></span></strong>l&agrave; một c&aacute;ch ho&agrave;n hảo để thể hiện tinh thần v&agrave; phong c&aacute;ch học đường của bạn, cho d&ugrave; bạn đang ở trong khu&ocirc;n vi&ecirc;n trường, ph&ograve;ng tập thể dục hay tr&ecirc;n đường phố. Dưới đ&acirc;y l&agrave; một số chi tiết v&agrave; t&iacute;nh năng của đ&ocirc;i gi&agrave;y thể thao độc quyền n&agrave;y:<br />\r\n<span class=\"marker\">- Phần tr&ecirc;n được l&agrave;m bằng <span style=\"color:#27ae60\">Primeknit</span>, một chất liệu tho&aacute;ng kh&iacute; v&agrave; linh hoạt th&iacute;ch ứng với h&igrave;nh dạng v&agrave; chuyển động của b&agrave;n ch&acirc;n bạn.<br />\r\n- Bộ đếm g&oacute;t ch&acirc;n được gia cố bằng <span style=\"color:#27ae60\">TPU</span>, một loại nhựa bền v&agrave; nhẹ gi&uacute;p tăng độ ổn định v&agrave; bảo vệ.<br />\r\n- Phần lưỡi g&agrave; v&agrave; g&oacute;t gi&agrave;y lần lượt được th&ecirc;u logo<span style=\"color:#27ae60\"> ASU</span> v&agrave; d&ograve;ng chữ <span style=\"color:#27ae60\">&quot;Sun Devils&quot;</span>.<br />\r\n- D&acirc;y buộc cũng c&oacute; m&agrave;u <span style=\"color:#27ae60\">ASU</span>, với c&aacute;c điểm nhấn phản quang để dễ nh&igrave;n thấy.<br />\r\n- Đế giữa l&agrave; điểm nổi bật của gi&agrave;y thể thao, v&igrave; n&oacute; được l&agrave;m bằng 4D, một cấu tr&uacute;c lưới in 3D được thiết kế để đ&aacute;p ứng với &aacute;p lực v&agrave; chuyển động của b&agrave;n ch&acirc;n, mang lại khả năng đệm v&agrave; hỗ trợ t&ugrave;y chỉnh.<br />\r\n- Đế ngo&agrave;i được l&agrave;m bằng cao su <span style=\"color:#27ae60\">Continental</span>, một loại vật liệu hiệu suất cao mang lại độ b&aacute;m v&agrave; độ bền vượt trội tr&ecirc;n c&aacute;c bề mặt kh&aacute;c nhau.<br />\r\n<span style=\"font-size:14px\"><strong><span style=\"color:#e74c3c\">Adidas Ultra4D Sun Devils</span></strong></span> l&agrave; một đ&ocirc;i gi&agrave;y thể thao đặc biệt v&agrave; hiếm c&oacute; nhằm kỷ niệm mối quan hệ hợp t&aacute;c giữa <span style=\"color:#27ae60\">ASU</span> v&agrave; <span style=\"color:#27ae60\">Adidas</span>, cũng như sự đổi mới v&agrave; xuất sắc của cả hai.</span></p>\r\n', NULL, 3000000, 4800000, NULL, '2023-02-07', 1, 3, 2),
(19, 'ADIDAS ZNCHILL LIGHTMOTION', 'ADIDAS_ZNCHILL_LIGHTMOTION.png', '<h1><strong><span style=\"color:#e74c3c\"><span style=\"background-color:#ecf0f1\">ADIDAS ZNCHILL LIGHTMOTION</span></span></strong></h1>\r\n\r\n<p>Nếu bạn đang t&igrave;m kiếm một đ&ocirc;i gi&agrave;y c&oacute; thể bắt kịp lối sống năng động của m&igrave;nh, bạn c&oacute; thể muốn xem qua <strong><span style=\"color:#e74c3c\"><span style=\"font-size:14px\">ADIDAS ZNCHILL LIGHTMOTION</span></span></strong>. Những đ&ocirc;i gi&agrave;y n&agrave;y được thiết kế để mang lại sự thoải m&aacute;i, hỗ trợ v&agrave; tho&aacute;ng kh&iacute; cho bất kỳ loại chuyển động n&agrave;o. Cho d&ugrave; bạn đang chạy, nhảy hay khi&ecirc;u vũ, <span style=\"font-size:14px\"><span style=\"color:#e74c3c\"><strong>ADIDAS ZNCHILL LIGHTMOTION</strong></span></span> sẽ khiến bạn cảm thấy nhẹ nh&agrave;ng tr&ecirc;n đ&ocirc;i ch&acirc;n v&agrave; m&aacute;t lạnh tr&ecirc;n da. Đ&ocirc;i gi&agrave;y n&agrave;y c&oacute; mặt tr&ecirc;n bằng lưới cho ph&eacute;p kh&ocirc;ng kh&iacute; lưu th&ocirc;ng, đế giữa c&oacute; đệm gi&uacute;p hấp thụ sốc v&agrave; giảm mỏi, v&agrave; đế ngo&agrave;i bằng cao su mang lại lực k&eacute;o v&agrave; độ bền.<strong><span style=\"font-size:14px\"><span style=\"color:#e74c3c\"> ADIDAS ZNCHILL LIGHTMOTION</span></span></strong> cũng c&oacute; nhiều m&agrave;u sắc v&agrave; k&iacute;ch cỡ kh&aacute;c nhau để ph&ugrave; hợp với sở th&iacute;ch v&agrave; phong c&aacute;ch c&aacute; nh&acirc;n của bạn. Nếu bạn muốn trải nghiệm hiệu suất đỉnh cao v&agrave; sự thoải m&aacute;i trong một đ&ocirc;i gi&agrave;y, đừng bỏ lỡ cơ hội sở hữu <span style=\"font-size:14px\"><span style=\"color:#e74c3c\"><strong>ADIDAS ZNCHILL LIGHTMOTION</strong></span></span> ngay h&ocirc;m nay.</p>\r\n', NULL, 2000000, 2900000, NULL, '2023-09-04', 1, 3, 2),
(20, 'ADIDAS FORUM LOW CL', 'ADIDAS_FORUM_LOW_CL.png', '<h1><strong><span style=\"color:#e74c3c\"><span style=\"background-color:#ecf0f1\">ADIDAS FORUM LOW CL</span></span></strong></h1>\r\n\r\n<p>Nếu bạn đang t&igrave;m kiếm một đ&ocirc;i gi&agrave;y thể thao cổ điển với hơi hướng hiện đại, bạn c&oacute; thể muốn xem <strong><span style=\"font-size:14px\"><span style=\"color:#e74c3c\">ADIDAS FORUM LOW CL</span></span></strong>. Mẫu gi&agrave;y n&agrave;y được lấy cảm hứng từ h&igrave;nh b&oacute;ng b&oacute;ng rổ mang t&iacute;nh biểu tượng từ những năm 80, nhưng được cập nhật với phần tr&ecirc;n bằng da b&oacute;ng mượt, cổ &aacute;o c&oacute; đệm v&agrave; kh&oacute;a đ&oacute;ng bằng d&acirc;y đeo để vừa vặn an to&agrave;n. <span style=\"font-size:14px\"><span style=\"color:#e74c3c\"><strong>ADIDAS FORUM LOW CL</strong></span></span> cũng c&oacute; đế bằng cao su để tăng độ bền v&agrave; lực k&eacute;o, cũng như nh&atilde;n hiệu 3 Sọc đặc trưng ở hai b&ecirc;n. Cho d&ugrave; bạn đang ra s&acirc;n hay tr&ecirc;n đường phố, <strong><span style=\"font-size:14px\"><span style=\"color:#e74c3c\">ADIDAS FORUM LOW CL </span></span></strong>sẽ gi&uacute;p bạn lu&ocirc;n thoải m&aacute;i v&agrave; phong c&aacute;ch.</p>\r\n', NULL, 2800000, 3200000, NULL, '2023-04-07', 1, 4, 2),
(21, 'ADIDAS GRADAS CLOUD WHITE', 'ADIDAS_GRADAS_CLOUD_WHITE.png', '<h1><strong><span style=\"color:#e74c3c\">ADIDAS GRADAS CLOUD WHITE</span></strong></h1>\r\n\r\n<p>Nếu bạn đang t&igrave;m kiếm một đ&ocirc;i gi&agrave;y thể thao kết hợp sự thoải m&aacute;i, phong c&aacute;ch v&agrave; hiệu suất, bạn c&oacute; thể muốn xem qua <span style=\"font-size:14px\"><strong><span style=\"color:#e74c3c\">ADIDAS GRADAS CLOUD WHITE</span></strong></span>. Những đ&ocirc;i gi&agrave;y n&agrave;y được thiết kế với mặt tr&ecirc;n bằng lưới tho&aacute;ng kh&iacute;, đế giữa c&oacute; đệm v&agrave; đế ngo&agrave;i bằng cao su bền. Ch&uacute;ng cũng c&oacute; ba sọc mang t&iacute;nh biểu tượng ở hai b&ecirc;n v&agrave; <span style=\"color:#27ae60\">logo ADIDAS</span> tr&ecirc;n lưỡi g&agrave; v&agrave; g&oacute;t ch&acirc;n. <span style=\"font-size:14px\"><strong><span style=\"color:#e74c3c\">ADIDAS GRADAS CLOUD WHITE</span></strong></span> ho&agrave;n hảo cho trang phục thường ng&agrave;y, tập gym hoặc chạy việc vặt. Ch&uacute;ng c&oacute; kiểu d&aacute;ng đẹp v&agrave; tối giản ph&ugrave; hợp với mọi trang phục. Cho d&ugrave; bạn đang đến văn ph&ograve;ng, c&ocirc;ng vi&ecirc;n hay trung t&acirc;m thương mại, bạn c&oacute; thể diện những đ&ocirc;i gi&agrave;y thể thao n&agrave;y một c&aacute;ch tự tin v&agrave; tinh tế.</p>\r\n', NULL, 2000000, 2900000, NULL, '2022-08-09', 1, 4, 2),
(22, 'ADIDAS NMD R1 REFINED', 'ADIDAS_NMD_R1_REFINED.png', '<h1><span style=\"color:#e74c3c\"><strong><span style=\"background-color:#ecf0f1\">ADIDAS NMD R1 REFINED</span></strong></span></h1>\r\n\r\n<p>Nếu bạn đang t&igrave;m kiếm một đ&ocirc;i gi&agrave;y thể thao linh hoạt v&agrave; thoải m&aacute;i, c&oacute; thể bắt kịp lối sống năng động của m&igrave;nh, bạn c&oacute; thể muốn xem qua<span style=\"font-size:14px\"><span style=\"color:#e74c3c\"><strong> Adidas NMD R1 Refined</strong></span></span>. Đ&acirc;y l&agrave; phi&ecirc;n bản mới của mẫu NMD R1 nổi tiếng với một số n&acirc;ng cấp v&agrave; cải tiến tinh tế. Dưới đ&acirc;y l&agrave; một số l&yacute; do khiến <strong><span style=\"color:#e74c3c\"><span style=\"font-size:14px\">Adidas NMD R1 Refined</span></span></strong> đ&aacute;ng để bạn quan t&acirc;m.</p>\r\n\r\n<p><span style=\"color:#7f8c8d\"><span class=\"marker\">- Phần tr&ecirc;n được l&agrave;m bằng chất liệu dệt nhẹ v&agrave; tho&aacute;ng kh&iacute;, th&iacute;ch ứng với h&igrave;nh dạng v&agrave; chuyển động của b&agrave;n ch&acirc;n bạn. N&oacute; cũng c&oacute; kiểu d&aacute;ng vừa vặn giống như một chiếc tất v&agrave; một tab k&eacute;o ở g&oacute;t ch&acirc;n để dễ d&agrave;ng mang v&agrave; cởi ra.<br />\r\n- Đế giữa được trang bị c&ocirc;ng nghệ Boost đặc trưng cung cấp khả năng giảm chấn nhạy v&agrave; ho&agrave;n trả năng lượng. N&oacute; cũng c&oacute; c&aacute;c ph&iacute;ch cắm EVA gi&uacute;p tăng th&ecirc;m độ ổn định v&agrave; độ tương phản cho thiết kế.<br />\r\n- Đế ngo&agrave;i được l&agrave;m bằng cao su bền cung cấp lực k&eacute;o v&agrave; độ b&aacute;m tr&ecirc;n c&aacute;c bề mặt kh&aacute;c nhau. N&oacute; cũng c&oacute; một miếng v&aacute; g&oacute;t đ&uacute;c để tăng th&ecirc;m sự hỗ trợ v&agrave; bảo vệ.<br />\r\n- M&agrave;u sắc l&agrave; đen v&agrave; trắng b&oacute;ng bẩy v&agrave; tối giản, ph&ugrave; hợp với mọi trang phục. N&oacute; cũng c&oacute; c&aacute;c chi tiết phản chiếu tr&ecirc;n d&acirc;y buộc v&agrave; mấu g&oacute;t gi&uacute;p tăng cường khả năng hiển thị trong điều kiện &aacute;nh s&aacute;ng yếu.</span></span></p>\r\n\r\n<p><strong><span style=\"color:#e74c3c\"><span style=\"font-size:14px\">Adidas NMD R1 Refined</span></span></strong> l&agrave; sự lựa chọn tuyệt vời cho bất kỳ ai muốn c&oacute; một đ&ocirc;i gi&agrave;y thể thao phong c&aacute;ch v&agrave; chức năng c&oacute; thể vượt qua mọi thử th&aacute;ch.</p>\r\n', NULL, 2000000, 2800000, NULL, '2023-03-31', 1, 2, 2),
(23, 'ADIDAS RUN FALCON 3.0', 'ADIDAS_RUN_FALCON_3.0.png', '<h1><strong><span style=\"color:#e74c3c\"><span style=\"background-color:#ecf0f1\">ADIDAS RUN FALCON 3.0</span></span></strong></h1>\r\n\r\n<p>Nếu bạn đang t&igrave;m kiếm một đ&ocirc;i gi&agrave;y chạy bộ thoải m&aacute;i, bền bỉ v&agrave; phong c&aacute;ch, bạn c&oacute; thể muốn tham khảo<span style=\"font-size:14px\"><strong><span style=\"color:#e74c3c\"> ADIDAS RUN FALCON 3.0</span></strong></span>. Đ&acirc;y l&agrave; phi&ecirc;n bản mới nhất của d&ograve;ng<span style=\"color:#27ae60\"> Run Falcon</span> nổi tiếng, được thiết kế để cung cấp hỗ trợ v&agrave; giảm chấn tối ưu cho người chạy ở mọi cấp độ. <strong><span style=\"color:#e74c3c\"><span style=\"font-size:14px\">ADIDAS RUN FALCON 3.0 </span></span></strong>c&oacute; mặt tr&ecirc;n bằng lưới tho&aacute;ng kh&iacute;, lưỡi g&agrave; v&agrave; cổ gi&agrave;y c&oacute; đệm, kh&oacute;a buộc d&acirc;y v&agrave; đế ngo&agrave;i bằng cao su. Gi&agrave;y cũng c&oacute; đế giữa <span style=\"color:#27ae60\">Cloudfoam</span>, mang lại cảm gi&aacute;c &ecirc;m &aacute;i v&agrave; nhạy b&eacute;n dưới ch&acirc;n. <span style=\"font-size:14px\"><strong><span style=\"color:#e74c3c\">ADIDAS RUN FALCON 3.0</span></strong></span> c&oacute; nhiều m&agrave;u sắc v&agrave; k&iacute;ch cỡ kh&aacute;c nhau, đồng thời bạn c&oacute; thể t&igrave;m mua tại cửa h&agrave;ng <span style=\"color:#27ae60\">ADIDAS</span> gần nhất hoặc trực tuyến. Cho d&ugrave; bạn đang luyện tập cho một cuộc chạy marathon hay chỉ chạy bộ quanh khu nh&agrave;, <strong><span style=\"font-size:14px\"><span style=\"color:#e74c3c\">ADIDAS RUN FALCON 3.0 </span></span></strong>sẽ gi&uacute;p bạn đạt được mục ti&ecirc;u chạy bộ với sự thoải m&aacute;i v&agrave; phong c&aacute;ch.</p>\r\n', NULL, 1500000, 2200000, NULL, '2023-02-22', 1, 4, 2),
(24, 'NIKE REVOLUTION 6 NN', 'NIKE_REVOLUTION_6_NN.png', '<h1><strong><span style=\"color:#e74c3c\"><span style=\"background-color:#ecf0f1\">NIKE REVOLUTION 6 NN: Gi&agrave;y thể thao cho tương lai</span></span></strong></h1>\r\n\r\n<p><span style=\"color:#27ae60\">Nike</span> lu&ocirc;n đi đầu trong đổi mới v&agrave; thiết kế trong ng&agrave;nh c&ocirc;ng nghiệp sneaker. Sự bổ sung mới nhất cho d&ograve;ng sản phẩm của họ l&agrave;<strong><span style=\"color:#e74c3c\"><span style=\"font-size:14px\"> NIKE REVOLUTION 6 NN</span></span></strong>, một đ&ocirc;i gi&agrave;y tương lai kết hợp phong c&aacute;ch, sự thoải m&aacute;i v&agrave; hiệu suất.</p>\r\n\r\n<p><strong><span style=\"color:#e74c3c\"><span style=\"font-size:14px\">NIKE REVOLUTION 6 NN </span></span></strong>c&oacute; kiểu d&aacute;ng đẹp, thu&ocirc;n gọn được lấy cảm hứng từ h&igrave;nh dạng của động cơ phản lực. Phần tr&ecirc;n được l&agrave;m bằng chất liệu lưới tho&aacute;ng kh&iacute; th&iacute;ch ứng với h&igrave;nh dạng b&agrave;n ch&acirc;n của bạn, trong khi phần đế giữa được l&agrave;m bằng bọt phản ứng nhanh mang lại khả năng đệm v&agrave; ho&agrave;n trả năng lượng. Đế ngo&agrave;i được trang bị một m&ocirc; h&igrave;nh lực k&eacute;o cao su mang lại độ bền v&agrave; độ b&aacute;m tr&ecirc;n c&aacute;c bề mặt kh&aacute;c nhau.</p>\r\n\r\n<p><strong><span style=\"color:#e74c3c\"><span style=\"font-size:14px\">NIKE REVOLUTION 6 NN </span></span></strong>cũng c&oacute; một t&iacute;nh năng độc đ&aacute;o:<span style=\"background-color:#ecf0f1\"> </span><span style=\"color:#27ae60\"><em><span style=\"background-color:#ecf0f1\">chip mạng thần kinh (NN) kết nối với điện thoại th&ocirc;ng minh của bạn qua Bluetooth</span></em></span>. Con chip n&agrave;y ph&acirc;n t&iacute;ch dữ liệu chạy của bạn, chẳng hạn như tốc độ, khoảng c&aacute;ch, nhịp v&agrave; lượng calo được đốt ch&aacute;y, đồng thời cung cấp cho bạn c&aacute;c mẹo huấn luyện v&agrave; phản hồi được c&aacute; nh&acirc;n h&oacute;a. Bạn cũng c&oacute; thể t&ugrave;y chỉnh m&agrave;u sắc v&agrave; độ s&aacute;ng của <span style=\"color:#27ae60\">đ&egrave;n LED </span>tr&ecirc;n gi&agrave;y, cũng như hiệu ứng &acirc;m thanh ph&aacute;t khi bạn bắt đầu v&agrave; dừng chạy.</p>\r\n\r\n<p><span style=\"font-size:14px\"><strong><span style=\"color:#e74c3c\">NIKE REVOLUTION 6 NN</span></strong></span> kh&ocirc;ng chỉ l&agrave; một đ&ocirc;i gi&agrave;y thể thao. Đ&acirc;y l&agrave; một thiết bị th&ocirc;ng minh gi&uacute;p n&acirc;ng cao trải nghiệm chạy bộ của bạn v&agrave; gi&uacute;p bạn đạt được mục ti&ecirc;u của m&igrave;nh. Cho d&ugrave; bạn l&agrave; người chạy bộ th&ocirc;ng thường hay vận động vi&ecirc;n chuy&ecirc;n nghiệp, <span style=\"color:#e74c3c\"><strong><span style=\"font-size:14px\">NIKE REVOLUTION 6 NN</span></strong></span> sẽ c&aacute;ch mạng h&oacute;a tr&ograve; chơi của bạn.</p>\r\n', NULL, 1000000, 1900000, NULL, '2022-02-12', 1, 2, 1);

INSERT INTO `hinh_anh` (`tenHA`, `trangThai`, `maSP`) VALUES
('AIR FORCE 11.png', NULL, 1),
('AIR FORCE 12.png', NULL, 1),
('AIR FORCE 13.png', NULL, 1),
('AIR FORCE 14.png', NULL, 1),
('NIKE AIR MAX SYSTM1.png', NULL, 2),
('NIKE AIR MAX SYSTM2.png', NULL, 2),
('NIKE AIR MAX SYSTM3.png', NULL, 2),
('NIKE AIR MAX SYSTM4.png', NULL, 2),
('NIKE PEGASUS 401.png', NULL, 3),
('NIKE PEGASUS 402.png', NULL, 3),
('NIKE PEGASUS 403.png', NULL, 3),
('NIKE PEGASUS 404.png', NULL, 3),
('NIKECOURT AIR ZOOM GP TURBO1.png', NULL, 4),
('NIKECOURT AIR ZOOM GP TURBO2.png', NULL, 4),
('NIKECOURT AIR ZOOM GP TURBO3.png', NULL, 4),
('NIKECOURT AIR ZOOM GP TURBO4.png', NULL, 4),
('NIKE EXPERIENCE RUN 11 NEXT1.png', NULL, 5),
('NIKE EXPERIENCE RUN 11 NEXT2.png', NULL, 5),
('NIKE EXPERIENCE RUN 11 NEXT3.png', NULL, 5),
('NIKE EXPERIENCE RUN 11 NEXT4.png', NULL, 5),
('NIKE QUEST 41.png', NULL, 6),
('NIKE QUEST 42.png', NULL, 6),
('NIKE QUEST 43.png', NULL, 6),
('NIKE QUEST 44.png', NULL, 6),
('NIKE STAR RUNNER 31.png', NULL, 7),
('NIKE STAR RUNNER 32.png', NULL, 7),
('NIKE STAR RUNNER 33.png', NULL, 7),
('NIKE STAR RUNNER 34.png', NULL, 7),
('AIR JORDAN 1 HI CHICAGO1.png', NULL, 8),
('AIR JORDAN 1 HI CHICAGO2.png', NULL, 8),
('AIR JORDAN 1 HI CHICAGO3.png', NULL, 8),
('AIR JORDAN 1 HI CHICAGO4.png', NULL, 8),
('AIR JORDAN 1 LOW1.png', NULL, 9),
('AIR JORDAN 1 LOW2.png', NULL, 9),
('AIR JORDAN 1 LOW3.png', NULL, 9),
('AIR JORDAN 1 LOW4.png', NULL, 9),
('AIR JORDAN 1 LOW CARDINAL RED1.png', NULL, 10),
('AIR JORDAN 1 LOW CARDINAL RED2.png', NULL, 10),
('AIR JORDAN 1 LOW CARDINAL RED3.png', NULL, 10),
('AIR JORDAN 1 LOW CARDINAL RED4.png', NULL, 10),
('AIR JORDAN 4 BLACK1.png', NULL, 11),
('AIR JORDAN 4 BLACK2.png', NULL, 11),
('AIR JORDAN 4 BLACK3.png', NULL, 11),
('AIR JORDAN 4 BLACK4.png', NULL, 11),
('AIR JORDAN 4 BLUE1.png', NULL, 12),
('AIR JORDAN 4 BLUE2.png', NULL, 12),
('AIR JORDAN 4 BLUE3.png', NULL, 12),
('AIR JORDAN 4 BLUE4.png', NULL, 12),
('JORDAN 1 HI RETRO 851.png', NULL, 13),
('JORDAN 1 HI RETRO 852.png', NULL, 13),
('JORDAN 1 HI RETRO 853.png', NULL, 13),
('JORDAN 1 HI RETRO 854.png', NULL, 13),
('JORDAN 1 LOW CRAFT1.png', NULL, 14),
('JORDAN 1 LOW CRAFT2.png', NULL, 14),
('JORDAN 1 LOW CRAFT3.png', NULL, 14),
('JORDAN 1 LOW CRAFT4.png', NULL, 14),
('NIKE AIR JORDAN 4 PINE GREEN1.png', NULL, 15),
('NIKE AIR JORDAN 4 PINE GREEN2.png', NULL, 15),
('NIKE AIR JORDAN 4 PINE GREEN3.png', NULL, 15),
('NIKE AIR JORDAN 4 PINE GREEN4.png', NULL, 15),
('ADIDAS FORUM LOW CL1.png', NULL, 16),
('ADIDAS FORUM LOW CL2.png', NULL, 16),
('ADIDAS FORUM LOW CL3.png', NULL, 16),
('ADIDAS FORUM LOW CL4.png', NULL, 16),
('ADIDAS GRADAS CLOUD WHITE1.png', NULL, 17),
('ADIDAS GRADAS CLOUD WHITE2.png', NULL, 17),
('ADIDAS GRADAS CLOUD WHITE3.png', NULL, 17),
('ADIDAS GRADAS CLOUD WHITE4.png', NULL, 17),
('ADIDAS ULTRA4D SUN DEVILS1.png', NULL, 18),
('ADIDAS ULTRA4D SUN DEVILS2.png', NULL, 18),
('ADIDAS ULTRA4D SUN DEVILS3.png', NULL, 18),
('ADIDAS ULTRA4D SUN DEVILS4.png', NULL, 18),
('ADIDAS ZNCHILL LIGHTMOTION1.png', NULL, 19),
('ADIDAS ZNCHILL LIGHTMOTION2.png', NULL, 19),
('ADIDAS ZNCHILL LIGHTMOTION3.png', NULL, 19),
('ADIDAS ZNCHILL LIGHTMOTION4.png', NULL, 19),
('ADIDAS FORUM LOW CL1.png', NULL, 20),
('ADIDAS FORUM LOW CL2.png', NULL, 20),
('ADIDAS FORUM LOW CL3.png', NULL, 20),
('ADIDAS FORUM LOW CL4.png', NULL, 20),
('ADIDAS GRADAS CLOUD WHITE1.png', NULL, 21),
('ADIDAS GRADAS CLOUD WHITE2.png', NULL, 21),
('ADIDAS GRADAS CLOUD WHITE3.png', NULL, 21),
('ADIDAS GRADAS CLOUD WHITE4.png', NULL, 21),
('ADIDAS NMD R1 REFINED1.png', NULL, 22),
('ADIDAS NMD R1 REFINED2.png', NULL, 22),
('ADIDAS NMD R1 REFINED3.png', NULL, 22),
('ADIDAS NMD R1 REFINED4.png', NULL, 22),
('ADIDAS RUN FALCON 3.01.png', NULL, 23),
('ADIDAS RUN FALCON 3.02.png', NULL, 23),
('ADIDAS RUN FALCON 3.03.png', NULL, 23),
('ADIDAS RUN FALCON 3.04.png', NULL, 23),
('NIKE REVOLUTION 6 NN1.png', NULL, 24),
('NIKE REVOLUTION 6 NN2.png', NULL, 24);


INSERT INTO `size`(`tenSize`, `maSP`) 
VALUES ( 38 , 1),
( 39 , 1),
( 40 , 1),
( 38 , 2),
( 39 , 2),
( 40 , 2),
( 38 , 3),
( 39 , 3),
( 40 , 3),
( 38 , 4),
( 39 , 4),
( 40 , 4),
( 38 , 5),
( 39 , 5),
( 40 , 5),
( 38 , 6),
( 39 , 6),
( 40 , 6),
( 38 , 7),
( 39 , 7),
( 40 , 7),
( 38 , 8),
( 39 , 8),
( 40 , 8),
( 38 , 9),
( 39 , 9),
( 40 , 9),
( 38 , 10),
( 39 , 10),
( 40 , 10),
( 38 , 11),
( 39 , 11),
( 40 , 11),
( 38 , 12),
( 39 , 12),
( 40 , 12),
( 38 , 13),
( 39 , 13),
( 40 , 13),
( 38 , 14),
( 39 , 14),
( 40 , 14),
( 38 , 15),
( 39 , 15),
( 40 , 15),
( 38 , 16),
( 39 , 16),
( 40 , 16),
( 38 , 17),
( 39 , 17),
( 40 , 17),
( 38 , 18),
( 39 , 18),
( 40 , 18),
( 38 , 19),
( 39 , 19),
( 40 , 19),
( 38 , 20),
( 39 , 20),
( 40 , 20),
( 38 , 21),
( 39 , 21),
( 40 , 21),
( 38 , 22),
( 39 , 22),
( 40 , 22),
( 38 , 23),
( 39 , 23),
( 40 , 23),
( 38 , 24),
( 39 , 24),
( 40 , 24);

