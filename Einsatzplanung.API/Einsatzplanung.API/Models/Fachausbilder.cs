using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Web;

namespace Einsatzplanung.API.Models
{
    [Table("fachausbilder")]
    public class Fachausbilder
    {
        [Key]
        [Column ("fachausbilderID")]
        public int FachausbilderID { get; set;}

        [Column("vorname")]
        public string Vorname { get; set;}

        [Column("nachname")]
        public string Nachname { get; set;}

        [Column("abteilungID")]
        public int abteilungID { get; set;}

        [Column("persNr")]
        public int PersNr { get; set;}
    }

}