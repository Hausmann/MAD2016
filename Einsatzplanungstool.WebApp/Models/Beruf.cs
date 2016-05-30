using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Web;

namespace Einsatzplanungstool.WebApp.Models
{
    [Table("berufe")]
    public class Beruf
    {
        [Key]
        [Column("berufID")]
        public int BerufID { get; set; }

        [Column("beschreibung")]
        public string Beschreibung { get; set; }
    }
}